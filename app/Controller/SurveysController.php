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
    }
    
    public function dashboard(){
        $this->loadModel('Region');
        $this->set('totalFb', $this->Survey->getTotalFb());
        $this->set('pack3gUser', $this->Survey->parcent3gPackUser());
        $this->set('smartPhoneUser', $this->Survey->parcentSmartPhoneUser());
        $this->set('todayFbTotal', $this->Survey->getTodaysFbTotal());
        $this->set('teamContributions', json_encode($this->Survey->byTeamContribution()));
        $this->set('regions', $this->Region->find('list'));
    }
    
    public function report(){
        $this->_set_request_data_from_params();
                //pr($this->request->data);//exit;        
        $locationsIds = $this->Survey->Location->getLocationIds($this->request->data['Survey']);
        $promoterIds = $this->Survey->Promoter->getPromoterIds($this->request->data['Survey']);
        
        //pr($locationsIds);
        
        $this->_initialise_form_values($locationsIds, $promoterIds);
        
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
        $this->set('totalFb', $this->Survey->getTotalFb($this->Survey->set_conditions($locationsIds,$this->request->data)));
        $this->set('pack3gUser', $this->Survey->parcent3gPackUser($this->Survey->set_conditions($locationsIds,$this->request->data)));
        $this->set('smartPhoneUser', $this->Survey->parcentSmartPhoneUser($this->Survey->set_conditions($locationsIds,$this->request->data)));
        $this->set('todayFbTotal', $this->Survey->getTodaysFbTotal($this->Survey->set_conditions($locationsIds,$this->request->data)));
        
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
                $this->request->data['Survey']['region_id'] = $this->request->params['named']['region_id'];
            }
            if( isset($this->request->params['named']['area_id']) ){
                $this->request->data['Survey']['area_id'] = $this->request->params['named']['area_id'];
            }
            if( isset($this->request->params['named']['team_id']) ){
                $this->request->data['Survey']['team_id'] = $this->request->params['named']['team_id'];
            }
            if( isset($this->request->params['named']['promoter_id']) ){
                $this->request->data['Survey']['promoter_id'] = $this->request->params['named']['promoter_id'];
            }
            if( isset($this->request->params['named']['location_id']) ){
                $this->request->data['Survey']['location_id'] = $this->request->params['named']['location_id'];
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
    protected function _initialise_form_values($locationIds = array(), $promoterIds = array()){
        $this->set('promoters', $this->Survey->Promoter->find('list', array(
            'conditions' => array('Promoter.id' => $promoterIds)
        )));
        $this->set('locations', $this->Survey->Location->find('list', array(
            'conditions' => array('Location.id' => $locationIds),
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
        $Surveys = $this->Survey->find('all', array(
            'fields' => array('id','location_id','area_id', 'region_id',
                'promoter_id','team_id','name','occupation_id','age',
                'is_female','mobile','recharge_amount','monthly_internet_usage',
                'is_smart_phone','mobile_brand_id','is_3g','package_id',
                'created', 'Promoter.name','Promoter.code','Team.name',
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
