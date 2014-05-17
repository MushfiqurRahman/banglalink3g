<?php
App::uses('AppController', 'Controller');
/**
 * Promoters Controller
 *
 * @property Promoter $Promoter
 */
class PromotersController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Promoter->recursive = 0;
		$this->set('promoters', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Promoter->exists($id)) {
			throw new NotFoundException(__('Invalid promoter'));
		}
		$options = array('conditions' => array('Promoter.' . $this->Promoter->primaryKey => $id));
		$this->set('promoter', $this->Promoter->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Promoter->create();
			if ($this->Promoter->save($this->request->data)) {
				$this->Session->setFlash(__('The promoter has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The promoter could not be saved. Please, try again.'));
			}
		}
		$teams = $this->Promoter->Team->find('list');
		$this->set(compact('teams'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Promoter->exists($id)) {
			throw new NotFoundException(__('Invalid promoter'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Promoter->save($this->request->data)) {
				$this->Session->setFlash(__('The promoter has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The promoter could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Promoter.' . $this->Promoter->primaryKey => $id));
			$this->request->data = $this->Promoter->find('first', $options);
		}
		$teams = $this->Promoter->Team->find('list');
		$this->set(compact('teams'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Promoter->id = $id;
		if (!$this->Promoter->exists()) {
			throw new NotFoundException(__('Invalid promoter'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Promoter->delete()) {
			$this->Session->setFlash(__('Promoter deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Promoter was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
