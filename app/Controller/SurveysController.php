<?php
App::uses('AppController', 'Controller');
/**
 * Surveys Controller
 *
 * @property Survey $Survey
 */
class SurveysController extends AppController {
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->set('totalFb', $this->Survey->getTotalFb());
        $this->set('pack3gUser', $this->Survey->parcent3gPackUser());
        $this->set('smartPhoneUser', $this->Survey->parcentSmartPhoneUser());
        $this->set('todayFbTotal', $this->Survey->getTodaysFbTotal());
    }
    
    public function dashboard(){
        $this->loadModel('Region');
        $this->set('regions', $this->Region->find('list'));
    }
    
    public function report(){
        $this->_set_request_data_from_params();
//                pr($this->request->data);//exit;        
        $locationsIds = $this->Survey->Location->getLocationIds($this->request->data['Survey']);
        
        $this->_initialise_form_values($locationsIds);
        
        $this->Survey->Behaviors->load('Containable');

        $this->paginate = array(
            'contain' => $this->Survey->get_contain_array(),
            'conditions' => $this->Survey->set_conditions($locationsIds, $this->request->data),
            'order' => array('Survey.created' => 'DESC'),
            'limit' => 4,
        );
        $Surveys = $this->paginate();
        //pr($Surveys);exit;
        $this->set('Surveys', $Surveys);
        if( !empty($this->request->query)){
            $this->set('data',$this->request->query);
        }
    }
    
    /**
     * 
     */
    protected function _set_request_data_from_params(){
        
        if( !$this->request->is('post') && !empty($this->request->params['named'])){
            if( isset($this->request->params['named']['region_id']) ){
                $this->request->data['Region']['id'] = $this->request->params['named']['region_id'];
            }
            if( isset($this->request->params['named']['area_id']) ){
                $this->request->data['Area']['id'] = $this->request->params['named']['area_id'];
            }            
            if( isset($this->request->params['named']['location_id']) ){
                $this->request->data['Location']['id'] = $this->request->params['named']['location_id'];
            }            
            
            if( isset($this->request->params['named']['age']) ){
                $this->request->data['age'] = $this->request->params['named']['age_limit'];
            }
            if( isset($this->request->params['named']['start_date']) ){
                $this->request->data['start_date'] = $this->request->params['named']['start_date'];
            }
            if( isset($this->request->params['named']['end_date']) ){
                $this->request->data['end_date'] = $this->request->params['named']['end_date'];
            }
            if( isset($this->request->params['named']['occupation_id']) ){
                $this->request->data['occupation_id'] = $this->request->params['named']['occupation_id'];
            }
            
            if( isset($this->request->params['named']['is_3g']) ){
                $this->request->data['Survey']['is_3g'] = $this->request->params['named']['is_3g']=='Yes'?1:0;
            }
        } 
    } 
    
    /**
     * For the filtering form
     */
    protected function _initialise_form_values($locationIds = array()){
        $this->set('locations', $this->Survey->Location->find('list', array(
            'Location.id' => $locationIds
        )));
        $this->set('occupations', $this->Survey->Occupation->find('list'));
        $this->set('packages', $this->Survey->Package->find('list'));
    }
    
    public function export_report(){
        $this->layout = 'ajax';        
            
        ini_set('memory_limit', '1024M');
        
        if( !empty($this->request->data) ){
            $locationsIds = $this->Survey->Location->getLocationIds($this->request->data['Survey']);            
        }else{
            $locationsIds = $this->Survey->Location->getLocationIds();
        }
//            $houseList = $this->Survey->House->house_list($this->request->data);
//
//            if( isset($this->request->data['House']['id']) && !empty($this->request->data['House']['id']) ){
//                $houseIds[] = $this->request->data['House']['id'];
//            }else{
//                $houseIds = $this->Survey->House->id_from_list($houseList);                
//            }

//                $SurveyIds = $this->Survey->find('list',array('fields' => 'id','conditions' => 
//                    array('Survey.campaign_id' => $this->current_campaign_detail['Campaign']['id'],
//                        'Survey.house_id' => $houseIds)));    

//            $this->Survey->unbindModel(array('belongsTo' => 
//                array('Campaign','MoLog'),
//                'hasOne' => array('Feedback')));

        $Surveys = $this->Survey->find('all', array(
            'fields' => array('id','location_id','area_id', 'region_id',
                'promoter_id','team_id','name','occupation_id','age',
                'is_female','mobile','recharge_amount','monthly_internet_usage',
                'is_smart_phone','mobile_brand_id','is_3g','package_id',
                'date_time', 'Promoter.name','Promoter.code','Team.name',
                'MobileBrand.title','Occupation.title','Package.title',
                'Location.title','Location.area_id'),
            'conditions' => $this->Survey->set_conditions($locationsIds, $this->request->data),
            'order' => array('Survey.created' => 'DESC'),      
        ));                 
        $Surveys = $this->Survey->format_for_export($Surveys);
//        $this->log(print_r($Surveys,true),'error');
//        pr($Surveys);exit;
        $this->set('surveys',$Surveys); 
    }

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Survey->recursive = 0;
		$this->set('surveys', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Survey->exists($id)) {
			throw new NotFoundException(__('Invalid survey'));
		}
		$options = array('conditions' => array('Survey.' . $this->Survey->primaryKey => $id));
		$this->set('survey', $this->Survey->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Survey->create();
			if ($this->Survey->save($this->request->data)) {
				$this->Session->setFlash(__('The survey has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The survey could not be saved. Please, try again.'));
			}
		}
		$promoters = $this->Survey->Promoter->find('list');
		$locations = $this->Survey->Location->find('list');
		$occupations = $this->Survey->Occupation->find('list');
		$packages = $this->Survey->Package->find('list');
		$mobileBrands = $this->Survey->MobileBrand->find('list');
		$this->set(compact('promoters', 'locations', 'occupations', 'packages', 'mobileBrands'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Survey->exists($id)) {
			throw new NotFoundException(__('Invalid survey'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Survey->save($this->request->data)) {
				$this->Session->setFlash(__('The survey has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The survey could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Survey.' . $this->Survey->primaryKey => $id));
			$this->request->data = $this->Survey->find('first', $options);
		}
		$promoters = $this->Survey->Promoter->find('list');
		$locations = $this->Survey->Location->find('list');
		$occupations = $this->Survey->Occupation->find('list');
		$packages = $this->Survey->Package->find('list');
		$mobileBrands = $this->Survey->MobileBrand->find('list');
		$this->set(compact('promoters', 'locations', 'occupations', 'packages', 'mobileBrands'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Survey->id = $id;
		if (!$this->Survey->exists()) {
			throw new NotFoundException(__('Invalid survey'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Survey->delete()) {
			$this->Session->setFlash(__('Survey deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Survey was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
