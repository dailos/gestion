<?php
App::uses('AppController', 'Controller');
class CuentasController extends AppController {
	
	public function beforeFilter(){
		$this->set('metodospago',Configure::read('metodospago'));
	}

	public function index() {
		$this->Cuenta->recursive = 0;
		$this->paginate = array('order' => array('Cuenta.nombre' => 'asc'));
		$this->set('cuentas', $this->paginate());
		$this->titulo('Listado de cuentas');
	}

	public function view($id = null) {
		if (!$id) $this->errorMsg();
		$this->Cuenta->recursive = 4;
		$cuenta =  $this->Cuenta->read(null, $id);			
		$this->set('cuenta', $cuenta);
		$this->titulo('Cuenta '.$cuenta['Cuenta']['nombre']);
	}

	public function add() {
		if (!empty($this->request->data)) {
			$this->Cuenta->create();
			if ($this->Cuenta->save($this->request->data)) $this->okMsg();
			else $this->errorMsg();				
		}
		$this->titulo('Añadir cuenta');
	}

	public function edit($id = null) {
		if (!$id && empty($this->request->data)) $this->errorMsg();
		if (!empty($this->request->data)) {
			if ($this->Cuenta->save($this->request->data)) $this->okMsg();
			else $this->errorMsg();
		}
		if (empty($this->request->data)) $this->request->data = $this->Cuenta->read(null, $id);
		
	}

	public function delete($id = null) {
		if (!$id) $this->errorMsg();
		$cuenta = $this->Cuenta->read(null,$id);		
		if(!empty($cuenta['Apunte']))$this->errorMsg('view/'.$id,'Existen cobros o pagos relacionados, imposible eliminar');						
		if ($this->Cuenta->delete($id)) $this->okMsg();
		$this->errorMsg();
	}
}
?>