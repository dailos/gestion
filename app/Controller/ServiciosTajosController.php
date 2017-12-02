<?php
App::uses('AppController', 'Controller');
class ServiciosTajosController extends AppController {

	public function beforeFilter(){
		$this->loadtaxes();
	}
	
	public function add($tajo_id = null, $servicio_id = null) {
		if (!empty($this->request->data)) {				
			$this->ServiciosTajo->create();						
			if ($this->ServiciosTajo->save($this->request->data)) $this->okMsg(array('controller'=> 'tajos', 'action' => 'view',$this->request->data['ServiciosTajo']['tajo_id']));				
			else $this->errorMsg(array('controller'=> 'tajos', 'action' => 'view',$this->request->data['ServiciosTajo']['tajo_id']));			
		}else{
			$servicio = $this->ServiciosTajo->Servicio->read(null,$servicio_id);
			$this->set('servicio',$servicio['Servicio']);
			$this->set('tajo_id',$tajo_id);			
		}
	}
	
	public function edit($id = null,$servicio_id = null) {
		if (!$id && empty($this->request->data)) $this->errorMsg();
		if (!empty($this->request->data)) {
			if ($this->ServiciosTajo->save($this->request->data)) $this->okMsg(array('controller' => 'tajos','action' => 'view',$servicio_id));
			else $this->errorMsg();
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->ServiciosTajo->read(null, $id);
			$this->set('tajo_id',$tajo_id);
		}		
	}
	
	public function delete($id = null,$tajo_id = null) {
		if (!$id || !$tajo_id) $this->errorMsg(array('controller'=> 'proyectos', 'action' => 'index'));
		if ($this->ServiciosTajo->delete($id)) $this->okMsg(array('controller'=> 'tajos', 'action' => 'view',$tajo_id));
		
		$this->errorMsg(array('controller'=> 'tajos', 'action' => 'view',$tajo_id));		
	}	

}
?>