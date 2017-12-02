<?php
App::uses('AppController', 'Controller');
class IncidenciasController extends AppController {

/*
	function index() {
		$this->Incidencia->recursive = 0;
		$this->set('incidencias', $this->paginate());
	}	
	*/
	public function view($id = null) {
		if (!$id) $this->errorMsg(array('controller'=>'empleados','action' => 'index'));
		$incidencia = $this->Incidencia->read(null, $id);	
		$this->set('incidencia', $incidencia);	
		$this->titulo('Incidencia de '.$incidencia['Empleado']['nombre']. ' '.$incidencia['Empleado']['apellidos']);
	}

	public function add($empleado_id = null) {
		if (!empty($this->request->data)) {					
			if($this->request->data['Incidencia']['empleado_id']){	
				$this->Incidencia->create();
				if ($this->Incidencia->save($this->request->data)) 
					if ($this->Incidencia->save($this->request->data)) $this->okMsg(array('controller'=>'empleados','action' => 'view',$this->request->data['Incidencia']['empleado_id']));				
				else $this->errorMsg(array('controller'=>'empleados','action' => 'view',$this->request->data['Incidencia']['empleado_id']));
			}else $this->errorMsg(array('controller'=>'empleados','action' => 'index'));	
		}
		$empleado = $this->Incidencia->Empleado->read(null,$empleado_id);	
		$this->set('empleado_id',$empleado_id);
		$this->titulo('Añadir incidencia a '.$empleado['Empleado']['nombre']. ' '.$empleado['Empleado']['apellidos']);
	}

	public function edit($id = null) {
		if (!$id) $this->errorMsg(array('controller'=>'empleados','action' => 'index'));
		
		if (!empty($this->request->data)) {
			if ($this->Incidencia->save($this->request->data)) $this->okMsg(array('controller'=>'empleados','action' => 'view',$this->request->data['Incidencia']['empleado_id']));
			else $this->errorMsg(array('controller'=>'empleados','action' => 'index'));				
		}				
		if (empty($this->request->data)) $this->request->data = $this->Incidencia->read(null, $id);		
	}

	public function delete($id = null) {
		if (!$id) $this->errorMsg(array('controller'=>'empleados','action' => 'index'));		
		$incidencia = $this->Incidencia->read(null, $id);	
		if ($this->Incidencia->delete($id)) $this->okMsg(array('controller'=>'empleados','action' => 'view',$incidencia['Incidencia']['empleado_id']));	
		$this->errorMsg(array('controller'=>'empleados','action' => 'index'));		
	}
}
?>