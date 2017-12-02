<?php
App::uses('AppController', 'Controller');
class GastosController extends AppController {

	public function beforeFilter(){
		$this->set('metodospago',Configure::read('metodospago'));
		$this->set('estadosgasto',Configure::read('estadosgasto'));
		$this->loadtaxes();
	}
		
	public function index() {
		if($this->request->data['Gasto'])
			$this->getconditions($this->request->data['Gasto'],'Gasto', Configure::read('estadosgasto'),
									array('campofecha'=>'fecha','filtro'=> array('Gasto.descripcion','Gasto.referencia')));
		$filter = SessionComponent::read('filter.Gasto');
		if(!$conditions = SessionComponent::read('sqlconditions.Gasto')){		
			$conditions = "";
			$filter = Configure::read('filter.Gasto');
			foreach ($filter['checkbox'] as $valor){				
				$conditions.= "  Gasto.estado_id like '$valor' OR ";						
			}
			$conditions = substr($conditions,0,-4);
		}	
		$this->set('filter',$filter);								
		$this->Gasto->recursive = 2;		
		if($this->request->data['Gasto']['resumen']){
			$gastos = $this->Gasto->find('all',array('conditions'=>$conditions));
			$this->set('gastos', $gastos);
			$datoseconomicos = null;
			foreach ($gastos as $gasto)
				foreach ($gasto['Albaran'] as $key => $albaran)
					foreach ($albaran['Conceptoalbaran'] as $d) $datoseconomicos = $this->economicos($d,$datoseconomicos,true);	
			
			$this->set('economicos',$datoseconomicos);
			$this->set('resumen', true);
		}else{		
			$this->paginate = array('order' => array('Gasto.fecha' => 'desc'));
			$this->set('gastos', $this->paginate('Gasto',$conditions));
			$this->set('resumen', false);
		}					
		$this->titulo('Listado de Gastos');		
		$this->set('filtrado', $this->request->isAjax());				
	}
		
	public function view($id = null,$edit=false) {
		//PENDIENTE, PAGADO
		if (!$id) $this->errorMsg();
		$this->Gasto->recursive = 3;
		$gasto =  $this->Gasto->read(null, $id);			
		$conceptos = $this->Gasto->Concepto->find('list');
				
		foreach ($gasto['Albaran'] as $key => $albaran)
			foreach ($albaran['Conceptoalbaran'] as $d) $datoseconomicos = $this->economicos($d,$datoseconomicos,true);				
					
		
		foreach ($gasto['Apunte'] as $pago) $pagado += $pago['cantidad'];
		$total = round($datoseconomicos['total'],2);		
		if($total != $gasto['Gasto']['total']){
			$this->Gasto->saveField('total',$total);
			$gasto['Gasto']['total'] = $total;
		}	
		if($total){
			$pendiente = round($total-$pagado,2);	
			if($pendiente !=$gasto['Gasto']['pendiente'] ){		
				$this->Gasto->saveField('pendiente',$pendiente);
				$gasto['Gasto']['pendiente'] = $pendiente;
			}
			if($pendiente == 0 && $gasto['Gasto']['estado_id'] == CERRADA) {
				$this->Gasto->saveField('estado_id',PAGADA);
				$gasto['Gasto']['estado_id'] = PAGADA;		
			}			
		}
				
		$this->set(compact('gasto','datoseconomicos','conceptos'));
		$this->titulo('Gasto '.$gasto['Gasto']['referencia']);

		if($edit){
			$this->set('edit', true);
			$this->request->data = $this->Gasto->read(null, $id);
			$this->set('conceptos',$this->Gasto->Concepto->find('list'));
		}
	}
	
	public function add($albaran_id = null) {
		if(!$albaran_id) $this->errorMsg();		
		$this->loadModel('Albaran');
		$albaran = $this->Albaran->read(null,$albaran_id);
		$this->request->data['Gasto']['referencia'] =  $this->getserial('Gasto','referencia');
		$this->request->data['Gasto']['fecha'] = date("Y-m-d H:i:s");		
		$this->request->data['Gasto']['empresa_id'] = $albaran['Albaran']['empresa_id'];
		$this->request->data['Gasto']['estado_id'] = ABIERTA;
		$this->request->data['Gasto']['concepto_id'] = SISTEMA;
		$this->request->data['Gasto']['descripcion'] = $albaran['Albaran']['descripcion'];
		if($albaran['Albaran']['npedido']) $this->request->data['Gasto']['notas'] = 'Gasto correspondiente al pedido '.$albaran['Albaran']['npedido'];
		$this->Gasto->create();
		if ($this->Gasto->save($this->request->data)) $this->redirect( array('controller'=>'albaranes','action'=>'setgasto',$albaran_id,$this->Gasto->id,true));
		else $this->errorMsg(array('controller'=>'empresas','action' => 'view',$albaran['Albaran']['empresa_id']));																					
	}

	public function edit($id = null) {
		if (!$id && empty($this->request->data)) $this->errorMsg();
		if (!empty($this->request->data)) {
			if ($this->Gasto->save($this->request->data)) $this->okMsg(array('action'=>'view',$this->Gasto->id));
		 	else $this->errorMsg(array('action'=>'view',$this->Gasto->id));				
		}
		if (empty($this->request->data)){
			$this->request->data = $this->Gasto->read(null, $id);
			$this->set('conceptos',$this->Gasto->Concepto->find('list'));
		}
				
	}

	public function delete($id = null) {
		if (!$id) $this->errorMsg();					
		$gasto = $this->Gasto->read(null, $id);		
		if ($this->Gasto->delete($id)) $this->okMsg(array('controller' =>'empresas','action'=>'view',$gasto['Gasto']['empresa_id']));						
		$this->errorMsg();
	}
	
	public function abrir($id = null){
		if (!$id) $this->errorMsg();
		$this->Gasto->id = $id;
		if ($this->Gasto->saveField('estado_id',ABIERTA)) $this->okMsg(array('action'=>'view', $id));
		else $this->errorMsg(array('action'=>'view', $id));
	}
	
	public function cerrar($id = null){
		if (!$id) $this->errorMsg();
		$this->Gasto->id = $id;		
		$this->Gasto->saveField('estado_id',CERRADA);
		$this->redirect(array('action'=>'view',$id));
	}
}
?>