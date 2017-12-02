<?php
App::uses('AppController', 'Controller');
class ConceptoalbaranesController extends AppController {

	public function beforeFilter(){
		$this->loadtaxes();
	}
	
	public function add($albaran_id = null) {
		if (!empty($this->request->data)) {							
			$this->Conceptoalbaran->create();						
			if ($this->Conceptoalbaran->save($this->request->data)) $this->okMsg(array('controller'=> 'albaranes', 'action' => 'view',$this->request->data['Conceptoalbaran']['albaran_id']));				
			else $this->errorMsg(array('controller'=> 'albaranes', 'action' => 'view',$this->request->data['Conceptoalbaran']['albaran_id']));			
		}else{				
			$this->set('albaran_id',$albaran_id);			
		}
	}
	
	public function edit($id = null,$albaran_id = null) {
		if (!$id && empty($this->request->data)) $this->errorMsg();
		if (!empty($this->request->data)) {
			if ($this->Conceptoalbaran->save($this->request->data)) $this->okMsg(array('controller' => 'albaranes','action' => 'view',$albaran_id));
			else $this->errorMsg();
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Conceptoalbaran->read(null, $id);
			$this->set('albaran_id',$albaran_id);
		}		
	}
	
	public function delete($id = null,$albaran_id = null) {
		if (!$id || !$albaran_id) $this->errorMsg(array('controller'=> 'empresas', 'action' => 'index'));
		if ($this->Conceptoalbaran->delete($id)) $this->okMsg(array('controller'=> 'albaranes', 'action' => 'view',$albaran_id));
		
		$this->errorMsg(array('controller'=> 'albaranes', 'action' => 'view',$albaran_id));		
	}	

}
?>