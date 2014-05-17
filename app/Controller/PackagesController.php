<?php
App::uses('AppController', 'Controller');
/**
 * Packages Controller
 *
 * @property Package $Package
 */
class PackagesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Package->recursive = 0;
		$this->set('packages', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Package->exists($id)) {
			throw new NotFoundException(__('Invalid package'));
		}
		$options = array('conditions' => array('Package.' . $this->Package->primaryKey => $id));
		$this->set('package', $this->Package->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Package->create();
			if ($this->Package->save($this->request->data)) {
				$this->Session->setFlash(__('The package has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The package could not be saved. Please, try again.'));
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
		if (!$this->Package->exists($id)) {
			throw new NotFoundException(__('Invalid package'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Package->save($this->request->data)) {
				$this->Session->setFlash(__('The package has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The package could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Package.' . $this->Package->primaryKey => $id));
			$this->request->data = $this->Package->find('first', $options);
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
		$this->Package->id = $id;
		if (!$this->Package->exists()) {
			throw new NotFoundException(__('Invalid package'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Package->delete()) {
			$this->Session->setFlash(__('Package deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Package was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
