<?php
App::uses('AppController', 'Controller');
class EmpleadosController extends AppController {

	public function index() {
		$this->Empleado->recursive = 0;
		$this->paginate = array('order' => array('Empleado.nombre' => 'asc'));
		$this->set('empleados', $this->paginate('Empleado',array('Empleado.empresa_id' =>SISTEMA)));
		$this->titulo('Mis empleados');
	}
	
	public function view($id = null) {
		if (!$id) $this->errorMsg();
		$this->Empleado->recursive = 2;
		$empleado = $this->Empleado->read(null, $id);
		$this->set('empleado',$empleado );
		$this->titulo('Empleado '.$empleado['Empleado']['nombre']." ".$empleado['Empleado']['apellidos']);
	}	

	public function add($empresa_id = null) {
		if (!$empresa_id) $empresa_id = SISTEMA;
		if (!empty($this->request->data)) {
			$this->Empleado->create();
			if ($this->Empleado->save($this->request->data))
				$this->redirect(array('action' => 'view',$this->Empleado->id));
			else 
				$this->errorMsg();
		}
		$this->titulo('Añadir empleado');
		$this->set(compact('empresa_id'));
	}

	public function edit($id = null) {
		if (!$id) $this->errorMsg();
		if (!empty($this->request->data)) {
			if ($this->Empleado->save($this->request->data)) $this->okMsg(array('action' => 'view',$id));
			else $this->errorMsg();
		}
		if (empty($this->request->data)) $this->request->data = $this->Empleado->read(null, $id);
	}

	public function delete($id = null) {
		if (!$id) $this->errorMsg();
		$empleado = $this->Empleado->read(null, $id);
		if(!empty($empleado['Tajo']))$this->errorMsg(array('action' => 'view',$id),'El empleado tiene tajos asociados, imposible eliminar al empleado');
		if ($this->Empleado->delete($id)) $this->okMsg();
		$this->errorMsg();
	}
}

