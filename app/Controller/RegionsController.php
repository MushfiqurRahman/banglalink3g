<?php
App::uses('AppController', 'Controller');
/**
 * Regions Controller
 *
 * @property Region $Region
 */
class RegionsController extends AppController {
    
    var $savedRegions, $savedAreas, $savedLocations, $savedTeams, $savedPromoters;
    
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->savedRegions = $this->savedAreas = $this->savedLocations = array();
        $this->savedTeams = $this->savedPromoters = array();
    }

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Region->recursive = 0;
		$this->set('regions', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Region->exists($id)) {
			throw new NotFoundException(__('Invalid region'));
		}
		$options = array('conditions' => array('Region.' . $this->Region->primaryKey => $id));
		$this->set('region', $this->Region->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Region->create();
			if ($this->Region->save($this->request->data)) {
				$this->Session->setFlash(__('The region has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The region could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Region->exists($id)) {
			throw new NotFoundException(__('Invalid region'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Region->save($this->request->data)) {
				$this->Session->setFlash(__('The region has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The region could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Region.' . $this->Region->primaryKey => $id));
			$this->request->data = $this->Region->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Region->id = $id;
		if (!$this->Region->exists()) {
			throw new NotFoundException(__('Invalid region'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Region->delete()) {
			$this->Session->setFlash(__('Region deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Region was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
        
        
        /**
         * 
         */
        public function import_data(){
            if( $this->request->is('post') ){
                if( !empty($this->request->data['Region']['xls_file']) ){
                    if( $this->request->data['Region']['xls_file']['error']==0){
                        $renamed_f_name = time().$this->request->data['Region']['xls_file']['name'];
                        if( move_uploaded_file($this->request->data['Region']['xls_file']['tmp_name'], WWW_ROOT.$renamed_f_name) ){
                        	
                            if( $this->_import($renamed_f_name) ){
                            	
                                $this->Session->setFlash(__('Data import successful.'));
                            }else{
                                $this->Session->setFlash(__('Data import failed!'));
                            }
                        }else{
                            $this->Session->setFlash(__('File upload failed! Please try again.'));
                        }
                    }else{
                        $this->Session->setFlash(__('Your given file is corrupted! Please try with valid file.'));
                    }
                }else{
                    $this->Session->setFlash(__('You have not selected any file to upload.'));
                }
            }
        }
        
        
        /**
         * 
         */
        protected function _import( $xlName ){
            App::import('Vendor','PHPExcel',array('file' => 'PHPExcel/Classes/PHPExcel.php'));
            
            //here i used microsoft excel 2007
            $objReader = PHPExcel_IOFactory::createReader('Excel2007');
            //set to read only
            $objReader->setReadDataOnly(true);
            //load excel file
            $objPHPExcel = $objReader->load($xlName);
            $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
            
            $totalRow = $objPHPExcel->getActiveSheet()->getHighestRow();            
            //pr($totalRow);
            
            for($i=4; $i<=$totalRow; $i++){
                $region['Region']['title'] = trim($objWorksheet->getCellByColumnAndRow(6,$i)->getValue());
                $regId = $this->_save_region( $region );
                
                $area['Area']['region_id'] = $regId;
                $area['Area']['title'] = trim($objWorksheet->getCellByColumnAndRow(8,$i)->getValue());
                $areaId = $this->_save_area( $area );
                
                $team['Team']['name'] = trim($objWorksheet->getCellByColumnAndRow(2,$i)->getValue());
                if(!empty($team['Team']['name'])){
                    $teamId = $this->_save_team($team);
                    $promoter['Promoter']['code'] = trim($objWorksheet->getCellByColumnAndRow(3,$i)->getValue());
                    $promoter['Promoter']['name'] = trim($objWorksheet->getCellByColumnAndRow(4,$i)->getValue());
                    $promoter['Promoter']['team_id'] = $teamId;
                    
                    $this->_save_promoter($promoter);
                }                
                $location['Location']['area_id'] = $areaId;                
                $location['Location']['team_id'] = $this->_getTeamId(trim($objWorksheet->getCellByColumnAndRow(7,$i)->getValue()));
                $location['Location']['title'] = trim($objWorksheet->getCellByColumnAndRow(9,$i)->getValue());
                $locationId = $this->_save_location($location);
            }
            return true;
        }
        
        protected function _getTeamId($teamTitle){
            $this->loadModel('Team');
            return $this->Team->field('id', array('name' => $teamTitle));
        }

        /**
         * 
         * Enter description here ...
         * @param unknown_type $region
         */
        protected function _save_region( $region ){
            //if already saved and stored in a array
            if( isset($this->savedRegions[$region['Region']['title']]) ){
                return $this->savedRegions[$region['Region']['title']];
            }else{
                $this->Region->create();
                $this->Region->save($region);
                $this->savedRegions[$region['Region']['title']] = $this->Region->id;
                return $this->Region->id;
            }
        }
        
        /**
         * 
         * Enter description here ...
         * @param unknown_type $area
         */
	protected function _save_area( $area ){
            if( isset($this->savedAreas[$area['Area']['title']])){
                return $this->savedAreas[$area['Area']['title']];
            }else{
                $this->Region->Area->create();
                $this->Region->Area->save($area);
                $this->savedAreas[$area['Area']['title']] = $this->Region->Area->id;
                return $this->Region->Area->id;
            }       	
        }
        
        protected function _save_team($team){
            if( isset($this->savedTeams[$team['Team']['name']]) ){
                return $this->savedTeams[$team['Team']['name']];
            }else{
                $this->loadModel('Team');
                $this->Team->create();
                $this->Team->save($team);
                $this->savedTeams[$team['Team']['name']] = $this->Team->id;
                return $this->Team->id;
            }
        }
        
        /**
         * 
         * Enter description here ...
         */
	protected function _save_location( $location ){
            if( isset($this->savedLocations[$location['Location']['title']])){
                return $this->savedLocations[$location['Location']['title']];
            }else{
                $this->Region->Area->Location->create();
                $this->Region->Area->Location->save($location);
                $this->savedLocations[$location['Location']['title']] = $this->Region->Area->Location->id;
                return $this->Region->Area->Location->id;
            }
        }
        
        /**
         * 
         * Enter description here ...
         */
	protected function _save_promoter( $rep ){ 
            if(isset($this->savedPromoters[$rep['Promoter']['code']])){
                return $this->savedPromoters[$rep['Promoter']['code']];
            }else{
                $this->loadModel('Promoter');
                $this->Promoter->create();
                $this->Promoter->save($rep);
                $this->savedPromoters[$rep['Promoter']['code']] = $this->Promoter->id;
                return $this->Promoter->id;
            }
        }
        
        /**
         * In the dashboard page it's essential
         * @return type
         */
        public function ajax_region_list(){
            $this->autoRender = $this->layout = false;            
            if( isset($_POST['team_id']) && !empty($_POST['team_id']) && $_POST['team_id'] != 'All' ){
                $this->loadModel('Location');
                $conditions = array('team_id' => $_POST['team_id']);
                $areaIds = $this->Location->find('list', array(
                    'fields' => array('area_id'),
                    'conditions' => $conditions));
                
                $regionIds = $this->Location->Area->find('list', array(
                    'fields' => array('region_id'),
                    'conditions' => array('id' => $areaIds)
                ));
                
                $regions = $this->Location->Area->Region->find('list', array(
                    'conditions' => array('Region.id' => $regionIds)
                ));
                
                $this->log(print_r($regions, true),'error');
                echo json_encode($regions);
            }
            return;            
        }
}