<?php
App::uses('AppController', 'Controller');
class ConceptosController extends AppController {

	public function index() {
		$this->Concepto->recursive = 0;
		$this->paginate = array('order' => array('Concepto.nombre' => 'asc'));
		$this->set('conceptos', $this->paginate());
		$this->titulo('Listado de conceptos');
	}

	public function view($id = null) {
		if (!$id) $this->errorMsg();
		
		$concepto = $this->Concepto->read(null, $id);
		$this->set('concepto',$concepto );
		$this->titulo('Concepto '.$concepto['Concepto']['nombre'] );
	}

	public function add() {
		if (!empty($this->request->data)) {
			$this->Concepto->create();
			if ($this->Concepto->save($this->request->data))$this->okMsg();
			else $this->errorMsg();				
		}
		$this->titulo('Añadir concepto');
	}

	public function edit($id = null) {
		if (!$id && empty($this->request->data))$this->errorMsg();
		
		if (!empty($this->request->data)) {
			if ($this->Concepto->save($this->request->data)) $this->okMsg();
			else $this->errorMsg();
		}
		if (empty($this->request->data)) $this->request->data = $this->Concepto->read(null, $id);
		
	}

	public function delete($id = null) {
		if (!$id) $this->errorMsg();
		if($id == SISTEMA)  $this->errorMsg('view/'.$id,'Concepto del sistema, imposible eliminar');
		$concepto = $this->Concepto->read(null,$id);
		if(!empty($concepto['Gasto']))$this->errorMsg('view/'.$id,'Existen gastos relacionadas, imposible eliminar');	
		if ($this->Concepto->delete($id)) $this->okMsg();
		$this->errorMsg();
	}
}
?>