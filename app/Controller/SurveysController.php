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
                pr($this->request->data);//exit;
        
        $locationsIds = $this->Survey->Location->getLocationIds($this->request->data['Survey']);
        
        $this->Survey->Behaviors->load('Containable');

        $this->paginate = array(
            //'fields' => array('id','outlet_id','date_time'),
            'contain' => $this->Survey->get_contain_array(),
            'conditions' => $this->Survey->set_conditions($locationsIds, $this->request->data),
            'order' => array('Survey.created' => 'DESC'),
            'limit' => 20,
        );
        $Surveys = $this->paginate();
        //pr($Surveys);exit;
        $this->set('Surveys', $Surveys);
        if( !empty($this->request->query)){
            $this->set('data',$this->request->query);
        }
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
            'fields' => array('id','location_id','area_id', 'region_id','promoter_id',
                'team_id','name','mobile','age','occupation_id',
                'created', 'Promoter.name','Team.name',
                'MobileBrand.title','Occupation.title',
                'Location.title','Location.area_id'),
            //'conditions' => $this->Survey->set_conditions($SurveyIds, $this->request->data),
            'conditions' => $this->Survey->set_conditions($locationsIds, $this->request->data),
            'order' => array('Survey.created' => 'DESC'),      
        ));                 
        $Surveys = $this->Survey->format_for_export($Surveys);
//        $this->log(print_r($Surveys,true),'error');
//        print_r($Surveys);exit;
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
