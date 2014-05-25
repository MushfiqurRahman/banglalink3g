<?php
App::uses('AppController', 'Controller');
/**
 * Locations Controller
 *
 * @property Location $Location
 */
class LocationsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Location->recursive = 0;
		$this->set('locations', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Location->exists($id)) {
			throw new NotFoundException(__('Invalid location'));
		}
		$options = array('conditions' => array('Location.' . $this->Location->primaryKey => $id));
		$this->set('location', $this->Location->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Location->create();
			if ($this->Location->save($this->request->data)) {
				$this->Session->setFlash(__('The location has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The location could not be saved. Please, try again.'));
			}
		}
		$areas = $this->Location->Area->find('list');
		$teams = $this->Location->Team->find('list');
		$this->set(compact('areas', 'teams'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Location->exists($id)) {
			throw new NotFoundException(__('Invalid location'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Location->save($this->request->data)) {
				$this->Session->setFlash(__('The location has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The location could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Location.' . $this->Location->primaryKey => $id));
			$this->request->data = $this->Location->find('first', $options);
		}
		$areas = $this->Location->Area->find('list');
		$teams = $this->Location->Team->find('list');
		$this->set(compact('areas', 'teams'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Location->id = $id;
		if (!$this->Location->exists()) {
			throw new NotFoundException(__('Invalid location'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Location->delete()) {
			$this->Session->setFlash(__('Location deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Location was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
        
        /**
         * In the dashboard page it's essential
         * @return type
         */
        public function ajax_location_list(){
            $this->autoRender = $this->layout = false;            
            if( isset($_POST['area_id']) && !empty($_POST['area_id']) && $_POST['area_id'] != 'All' ){
                $conditions = array('area_id' => $_POST['area_id']);
                $locations = $this->Location->find('list', array('conditions' => $conditions));
                echo json_encode($locations);
            }
            return;            
        }
}
