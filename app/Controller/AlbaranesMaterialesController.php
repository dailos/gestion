<?php
App::uses('AppController', 'Controller');
class AlbaranesMaterialesController extends AppController {
	
	public function add($albaran_id = null, $material_id = null) {
		if (!empty($this->request->data)) {				
			$this->AlbaranesMaterial->create();						
			if ($this->AlbaranesMaterial->save($this->request->data)) {				
				$albaran = $this->AlbaranesMaterial->Albaran->read(null,$this->request->data['AlbaranesMaterial']['albaran_id']);
				if($albaran['Albaran']['referencia']) $this->stock($this->request->data['AlbaranesMaterial']['material_id'],$this->request->data['AlbaranesMaterial']['cantidad']);
				$this->okMsg(array('controller'=> 'albaranes', 'action' => 'view',$this->request->data['AlbaranesMaterial']['albaran_id']));				
			}
			else $this->errorMsg(array('controller'=> 'albaranes', 'action' => 'view',$this->request->data['AlbaranesMaterial']['albaran_id']));			
		}else{
			$material = $this->AlbaranesMaterial->Material->read(null,$material_id);
			$this->set('material',$material['Material']);
			$this->set('albaran_id',$albaran_id);
		}
	}
	
	public function delete($id = null,$albaran_id = null) {
		if (!$id || !$albaran_id) $this->errorMsg(array('controller'=> 'empresas', 'action' => 'index'));
		$material = $this->AlbaranesMaterial->read(null,$id);	
		if ($this->AlbaranesMaterial->delete($id))
			$this->okMsg(array('controller'=> 'albaranes', 'action' => 'view',$albaran_id));	
		$this->errorMsg(array('controller'=> 'albaran_id', 'action' => 'view',$albaran_id));		
	}
}
?>