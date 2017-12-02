<?php
App::uses('AppController', 'Controller');
class VehiculosController extends AppController {

	public function index() {
		$this->Vehiculo->recursive = 0;
		$this->set('vehiculos', $this->paginate());
		$this->titulo('Listado de Vehículos');	
	}

	public function view($id = null) {
		if (!$id) $this->errorMsg();
		$vehiculo = $this->Vehiculo->read(null, $id);
		$this->set('vehiculo',$vehiculo );
		$this->titulo('Vehículo matrícula: '.$vehiculo['Vehiculo']['matricula']);	
	}
	
	public function add(){
		if (!empty($this->request->data)) {
			$this->Vehiculo->create();	
			if ($this->Vehiculo->save($this->request->data))
				$this->redirect(array('action' => 'view',$this->Vehiculo->id));				
			else 
				$this->errorMsg();					
		}
		$this->titulo('Crear vehículo nuevo');		
	}

	public function edit($id = null) {
		if (!$id) $this->errorMsg();
		if (!empty($this->request->data)) {
			if ($this->Vehiculo->save($this->request->data)) $this->okMsg(array('action' => 'view',$id));
			else $this->errorMsg();				
		}
		if (empty($this->request->data)) $this->request->data = $this->Vehiculo->read(null, $id);	
	}

	public function delete($id = null) {
		if (!$id) $this->errorMsg();		
		if ($this->Vehiculo->delete($id)) $this->okMsg();	
		$this->errorMsg();
	}
}
?>