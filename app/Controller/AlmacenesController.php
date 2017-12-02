<?php
App::uses('AppController', 'Controller');
class AlmacenesController extends AppController {

	public function index() {
		$this->Almacen->recursive = 0;
		$this->paginate = array('order' => array('Almacen.nombre' => 'asc'));
		$this->set('almacenes', $this->paginate());
		$this->titulo('Listado de almacenes');
	}

	public function view($id = null) {
		if (!$id) if (!$id) $this->errorMsg();
		$almacen = $this->Almacen->read(null, $id);
		$this->set('almacen', $almacen);
		$this->titulo('Almacén '. $almacen['Almacen']['nombre']);
	}

	public function add() {
		if (!empty($this->request->data)) {
			$this->Almacen->create();
			if ($this->Almacen->save($this->request->data))$this->okMsg();
			else $this->errorMsg();
		}	
		$this->titulo('Añadir almacén');
	}

	public function edit($id = null) {
		if (!$id && empty($this->request->data)) $this->errorMsg();
		if (!empty($this->request->data)) {
			if ($this->Almacen->save($this->request->data)) $this->okMsg();
			else $this->errorMsg();
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Almacen->read(null, $id);
		}
	}

	public function delete($id = null) {
		if (!$id) $this->errorMsg();
		
		$almacen = $this->Almacen->read(null,$id);		
		if(!empty($almacen['Herramienta']))$this->errorMsg('view/'.$id,'El almacén contiene herramientas, imposible eliminar');	
		if(!empty($almacen['Material']))$this->errorMsg('view/'.$id,'El almacén contiene materiales, imposible eliminar');	
		
		if ($this->Almacen->delete($id)) $this->okMsg();	
		$this->errorMsg();
	}
}
?>