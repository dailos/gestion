<?php
App::uses('AppController', 'Controller');
class ImpuestosController extends AppController {

	public function index() {
		$this->Impuesto->recursive = 0;
		$this->set('impuestos', $this->paginate());
		$this->titulo('Lista de impuestos');		
	}

	public function add() {
		if (!empty($this->request->data)) {
			$this->Impuesto->create();
			if ($this->Impuesto->save($this->request->data)) $this->okMsg();
			else $this->errorMsg();	
			$this->resettaxes();			
		}
	}

	public function delete($id = null) {
		if (!$id) $this->errorMsg();		
		$this->Impuesto->recursive = 3;					
		if ($this->Impuesto->delete($id)){
			$this->resettaxes();
			$this->okMsg();
		}
		$this->errorMsg();
	}
}
?>