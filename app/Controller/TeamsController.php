<?php
App::uses('AppController', 'Controller');
/**
 * Teams Controller
 *
 * @property Team $Team
 */
class TeamsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Team->recursive = 0;
		$this->set('teams', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Team->exists($id)) {
			throw new NotFoundException(__('Invalid team'));
		}
		$options = array('conditions' => array('Team.' . $this->Team->primaryKey => $id));
		$this->set('team', $this->Team->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Team->create();
			if ($this->Team->save($this->request->data)) {
				$this->Session->setFlash(__('The team has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The team could not be saved. Please, try again.'));
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
		if (!$this->Team->exists($id)) {
			throw new NotFoundException(__('Invalid team'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Team->save($this->request->data)) {
				$this->Session->setFlash(__('The team has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The team could not be saved. Please, try again.'));
			}
		} else {
			$options = array(
                            'conditions' => array('Team.' . $this->Team->primaryKey => $id),
                            'recursive' => -1);
			$this->request->data = $this->Team->find('first', $options);
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
		$this->Team->id = $id;
		if (!$this->Team->exists()) {
			throw new NotFoundException(__('Invalid team'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Team->delete()) {
			$this->Session->setFlash(__('Team deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Team was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
        
        /**
         * In the dashboard page it's essential
         * @return type
         */
//        public function ajax_team_list(){
//            $this->autoRender = $this->layout = false;            
//            if( isset($_POST['area_id']) && !empty($_POST['area_id']) && $_POST['area_id'] != 'All' ){
//                $this->loadModel('Location');
//                $conditions = array('area_id' => $_POST['area_id']);
//                $teamIds = $this->Location->find('list', array(
//                    'fields' => array('team_id'),
//                    'conditions' => $conditions));
//                
////                $this->log(print_r($teamIds, true),'error');
//                
//                $teams = $this->Team->find('list', array(
//                    'conditions' => array('Team.id' => $teamIds)
//                ));
//                echo json_encode($teams);
//            }
//            return;            
//        }
}
