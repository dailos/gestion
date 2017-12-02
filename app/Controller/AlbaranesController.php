<?php
App::uses('AppController', 'Controller');
class AlbaranesController extends AppController {

	public function beforeFilter(){
		$this->loadtaxes();
	}
	
	public function view($id = null,$edit = false) {
		if (!$id) $this->errorMsg();
		$this->Albaran->recursive = 3;			
		$albaran = $this->Albaran->read(null, $id);
		$datoseconomicos = array();
		if(empty($albaran['Albaran']['referencia'])) $this->redirect(array('action' => 'viewpedido',$albaran['Albaran']['id']));
		foreach ($albaran['Conceptoalbaran'] as $d) $datoseconomicos = $this->economicos($d,$datoseconomicos,true);		
		if($albaran['Albaran']['total'] != $datoseconomicos['total']) $this->Albaran->saveField('total',$datoseconomicos['total']);				
		$this->set(compact('datoseconomicos','albaran'));
		$this->titulo('Albarán '.$albaran['Albaran']['referencia']);
		if($edit){
			$this->set('edit', true);
			$this->Albaran->recursive = 3;
			$this->request->data = $this->Albaran->read(null, $id);			
		}
	}
	
	public function index(){			
		$this->Albaran->recursive = 3;		
		$this->paginate = array('order' => array('Albaran.fecha' => 'desc'));
		$this->set('albaranes', $this->paginate('Albaran',array('Albaran.referencia IS NOT NULL')));
		$this->titulo('Listado de albaranes');
		$this->render('index');
	}
	
	public function indexpedidos(){			
		$this->Albaran->recursive = 3;		
		$this->paginate = array('order' => array('Albaran.fecha' => 'desc'));
		$this->set('albaranes', $this->paginate('Albaran',array('Albaran.npedido IS NOT NULL')));
		$this->titulo('Listado de pedidos');
		$this->render('index');
	}
	
	public function viewpedido($id = null) {
		if (!$id) $this->errorMsg();
		$pedido = $this->Albaran->read(null, $id);
		$this->titulo('Pedido '.$pedido['Albaran']['npedido']);
		$this->set('pedido', $pedido);
	}
	
	public function addpedido($empresa_id = null){
		if (!empty($this->request->data)) {				
			if($this->request->data['Albaran']['empresa_id']){			
				$this->Albaran->create();
				if ($this->Albaran->save($this->request->data)) $this->okMsg(array('action' => 'viewpedido',$this->Albaran->id));				
				else $this->errorMsg(array('controller'=>'empresas','action' => 'view',$this->request->data['Albaran']['empresa_id']));
			}else $this->errorMsg(array('controller'=>'empresas','action' => 'index'));	
		}	
		
		$npedido = $this->getserial('Albaran','npedido','PED');	
		$this->titulo('Crear pedido '.$npedido);
		$this->set('npedido',$npedido);		
		$this->set('empresa_id',$empresa_id);	
	}
	

	public function add($empresa_id =null) {
		if (!empty($this->request->data)) {				
			if($this->request->data['Albaran']['empresa_id']){		
				if(empty($this->request->data['Albaran']['referencia'])) $this->errorMsg(array('action' => 'add',$this->request->data['Albaran']['empresa_id']),'Debe indicar una referencia'); 	
				$this->Albaran->create();
				if ($this->Albaran->save($this->request->data))$this->okMsg(array('action' => 'view',$this->Albaran->id));
				else $this->errorMsg(array('controller'=>'empresas','action' => 'view',$this->request->data['Albaran']['empresa_id']));
			}else $this->errorMsg(array('controller'=>'empresas','action' => 'index'));	
		}	
		
		$referencia = $this->getserial('Albaran','referencia');	
		$this->titulo('Crear albarán '.$referencia);
		$this->set('referencia',$referencia);								
		$this->set('empresa_id',$empresa_id);		
	}	

	public function editpedido($id = null) {
		if (!$id && empty($this->request->data)) $this->errorMsg();
		if (!empty($this->request->data)) {
			if ($this->Albaran->save($this->request->data)) $this->okMsg(array('action' => 'viewpedido',$this->request->data['Albaran']['id']));
			else $this->errorMsg();
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Albaran->read(null, $id);
		}		
	}
	
	public function edit($id = null) {
		if (!$id && empty($this->request->data)) $this->errorMsg();
		if (!empty($this->request->data)) {
			if ($this->Albaran->save($this->request->data)) $this->okMsg(array('action' => 'view',$id));
			else $this->errorMsg();
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Albaran->read(null, $id);
		}		
	}

	public function delete($id = null) {
		if (!$id) $this->errorMsg(array('controller'=>'clientes','action' => 'index'));
		$albaran =  $this->Albaran->read(null, $id);	
		$ok = true;				
		if($albaran['Albaran']['referencia']) {
			foreach ($albaran['Material'] as $material) {
				if(!$this->stock($material['id'],-$material['AlbaranesMaterial']['cantidad'])) $ok =false;
			}	
		}	
		if($albaran['Albaran']['npedido'] && $albaran['Albaran']['referencia']) {															
			if (!$this->Albaran->saveField('referencia',null)) $ok = false;											
		}else{								
			if (!$this->Albaran->delete($id)) $ok = false;
		}		
		if($ok)$this->okMsg(array('controller'=>'empresas','action' => 'view',$albaran['Albaran']['empresa_id']));
		else $this->errorMsg(array('controller'=>'empresas','action' => 'view',$albaran['Albaran']['empresa_id']));					 					
	}
		
	public function albaranfrompedido($albaran_id = null){
		if (!$albaran_id) $this->errorMsg(array('controller'=>'empresas','action' => 'index'));			
		$albaran = $this->Albaran->read(null, $albaran_id);				
		foreach ($albaran['Material'] as $material) {
				if(!$this->stock($material['id'],$material['AlbaranesMaterial']['cantidad'])) $ok =false;
			}	
		if ($this->Albaran->saveField('referencia', $this->getserial('Albaran','referencia'))) $this->okMsg('/albaranes/view/'.$albaran['Albaran']['id'].'/true');
		else $this->errorMsg('/albaranes/viewpedido/'.$albaran['Albaran']['id']);		

	}
	
	public function select($gasto_id =null,$empresa_id = null){	
		if(!$gasto_id || !$empresa_id) $this->errorMsg();				
		$this->Albaran->recursive = 0;
		$this->set('gasto_id',$gasto_id);
		$this->set('albaranes', $this->paginate('Albaran',array('Albaran.gasto_id IS NULL' ,'Albaran.referencia IS NOT NULL' ,'Albaran.empresa_id' => $empresa_id)));	
		$this->set('titulo','Añade albarán a la factura');
	}	
	public function setgasto($albaran_id =null, $gasto_id =null,$edit = false){
		if(!$albaran_id || !$gasto_id) $this->errorMsg();
		if($edit) $editar = '/true';
		$this->Albaran->id = $albaran_id;
		if ($this->Albaran->saveField('gasto_id',$gasto_id)) $this->okMsg("/gastos/view/$gasto_id".$editar);
		else $this->errorMsg("/gastos/view/$gasto_id");		
	}	
	
	public function unsetgasto($albaran_id =null, $gasto_id =null){
		if(!$albaran_id || !$gasto_id) $this->errorMsg();
		$this->Albaran->id = $albaran_id;
		if ($this->Albaran->saveField('gasto_id',null)) $this->okMsg("/gastos/view/$gasto_id");
		else $this->errorMsg("/gastos/view/$gasto_id");		
	}	
	
}
?>