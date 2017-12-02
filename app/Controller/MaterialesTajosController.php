<?php
App::uses('AppController', 'Controller');
class MaterialesTajosController extends AppController {

	function beforeFilter(){
		$this->loadtaxes();
	}
	
	
	public function add($tajo_id = null, $material_id = null) {
		if (!empty($this->request->data)) {				
			$this->MaterialesTajo->create();						
			if ($this->MaterialesTajo->save($this->request->data)){
				$tajo = $this->MaterialesTajo->Tajo->read(null,$this->request->data['MaterialesTajo']['tajo_id']);
				if($tajo['Tajo']['referencia']) $this->stock($this->request->data['MaterialesTajo']['material_id'],-$this->request->data['MaterialesTajo']['cantidad']);
				$this->okMsg(array('controller'=> 'tajos', 'action' => 'view',$this->request->data['MaterialesTajo']['tajo_id']));				
			}
			else $this->errorMsg(array('controller'=> 'tajos', 'action' => 'view',$this->request->data['MaterialesTajo']['tajo_id']));			
		}else{
			$material = $this->MaterialesTajo->Material->read(null,$material_id);
			$this->set('material',$material['Material']);
			$this->set('tajo_id',$tajo_id);			
		}
	}		
	public function edit($id = null,$tajo_id = null) {
		if (!$id && empty($this->request->data)) $this->errorMsg();
		if (!empty($this->request->data)) {			
			
			if($tajo['Tajo']['referencia']) $this->stock($this->request->data['MaterialesTajo']['material_id'],$this->request->data['MaterialesTajo']['cantidadoriginal']-$this->request->data['MaterialesTajo']['cantidad']);
			if ($this->MaterialesTajo->save($this->request->data)) $this->okMsg(array('controller' => 'tajos','action' => 'view',$tajo_id));
			else $this->errorMsg();
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->MaterialesTajo->read(null, $id);
			$this->set('cantidadoriginal',$this->request->data['MaterialesTajo']['cantidad']);
			$this->set('tajo_id',$tajo_id);
		}		
	}
	public function delete($id = null,$tajo_id = null) {
		if (!$id || !$tajo_id) $this->errorMsg(array('controller'=> 'proyectos', 'action' => 'index'));
		$material = $this->MaterialesTajo->read(null,$id);		
		if ($this->MaterialesTajo->delete($id)){
			$this->stock($material['MaterialesTajo']['material_id'],$material['MaterialesTajo']['cantidad']);
			$this->okMsg(array('controller'=> 'tajos', 'action' => 'view',$tajo_id));
		}
		
		$this->errorMsg(array('controller'=> 'tajos', 'action' => 'view',$tajo_id));		
	}
}
?>