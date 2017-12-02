<?php
App::uses('AppController', 'Controller');
class UsuariosController extends AppController {
	
	public function login() {		
		if ($this->request->is('post')) {		
			if ($this->Auth->login()) $this->redirect($this->Auth->redirect());
		    else  $this->Session->setFlash('No se ha podido autentificar');
		}
		$this->layout = "login";
	}

	public function logout() {
		$this->redirect($this->Auth->logout());
	}
	
	public function index() {
		$this->Usuario->recursive = 0;
		$this->set('usuarios', $this->paginate());
		$this->titulo('Lista de usuarios');
	}	

	public function add() {
		if (!empty($this->request->data)) {		         			       		
			$this->Usuario->create();
			if ($this->Usuario->save($this->request->data)) $this->okMsg();
			else $this->errorMsg(); 							
		}		
	}	

	public function delete($id = null) {
		if (!$id) $this->errorMsg();
		if ($this->Usuario->delete($id)) $this->okMsg();
		$this->errorMsg();
	}
}
?>