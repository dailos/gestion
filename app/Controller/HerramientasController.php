<?php
App::uses('AppController', 'Controller');
class HerramientasController extends AppController {

	public function index() {
		$this->Herramienta->recursive = 0;
		$this->paginate = array('order' => array('Herramienta.nombre' => 'asc'));
		$this->set('herramientas', $this->paginate());
		$this->titulo('Listado de Herramientas');	
	}

	public function view($id = null) {
		if (!$id) $this->errorMsg();
		$herramienta = 	$this->Herramienta->read(null, $id);
		$this->set('herramienta',$herramienta );
		$this->titulo('Herramienta: '.$herramienta['Herramienta']['nombre']);
	}

	public function add() {
		if (!empty($this->request->data)){ 			
			$this->Herramienta->create();
			$this->request->data['Herramienta']['nombre'] = 'Herramienta nueva';
			if ($this->Herramienta->save($this->request->data))
				$this->redirect(array('action' => 'view',$this->Herramienta->id));				
			else 
				$this->errorMsg();		
		}
		$this->titulo('Añadir herramienta');		
		$almacenes = $this->Herramienta->Almacen->find('list');
		$this->set(compact('almacenes'));	
	}
		
	public function edit($id = null) {
		if (!$id) $this->errorMsg();
		if (!empty($this->request->data)) {
			if ($this->Herramienta->save($this->request->data)) $this->okMsg(array('action' => 'view',$id));
			else $this->errorMsg();				
		}
		if (empty($this->request->data)){ 
			$this->request->data = $this->Herramienta->read(null, $id);
			$almacenes = $this->Herramienta->Almacen->find('list');
			$this->set(compact('almacenes'));
		}			
	}
	
	public function delete($id = null) {
		if (!$id) $this->errorMsg();		
		if ($this->Herramienta->delete($id)) $this->okMsg();	
		$this->errorMsg();
	}	
}
?>