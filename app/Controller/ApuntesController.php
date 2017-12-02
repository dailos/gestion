<?php
App::uses('AppController', 'Controller');
class ApuntesController extends AppController {

	public function beforeFilter(){
		$this->set('metodospago',Configure::read('metodospago'));
		$this->set('estadosfactura',Configure::read('estadosfactura'));		
	}	
	
	public function getconditions($data,$fields,$cuentas){			
		$conditions = "";	
		$stateconditions = "";	
		$projectconditions	= "";									
		if($data['filtro']){
			foreach ($fields as $field){
				$conditions.= " Apunte.$field like '%".$data['filtro']."%' OR " ;
			}
			//$conditions = substr($conditions,0,-3)." AND ";
			$this->loadModel('Empresa');
			$this->Empresa->recursive = 0;
			$empresas = $this->Empresa->find('list',array('conditions'=>" Empresa.nombre like '%".$data['filtro']."%'"));
			foreach ($empresas as $key => $value) {
				$conditions .= " Gasto.empresa_id = '$key' OR";
				$projectconditions .= " Proyecto.empresa_id = '$key' OR ";
			}	
			$projectconditions = substr($projectconditions,0,-3);
			$this->loadModel('Proyecto');
			$this->Proyecto->recursive = 0;
			$proyectos = $this->Proyecto->find('list',array('conditions'=>$projectconditions));
			foreach ($proyectos as $k => $v) {
				$conditions .= " Factura.proyecto_id = '$k' OR";				
			}	
			
			$conditions = substr($conditions,0,-3)." AND ";
			
		} 													
		$conditions.=  " Apunte.fecha   >= '".$data['fechainicio']['year']."-".
						$data['fechainicio']['month']."-".$data['fechainicio']['day']."' AND ". 
						" Apunte.fecha <= '".$data['fechafin']['year']."-".$data['fechafin']['month']."-".
						$data['fechafin']['day']."' ";			
		if($data['pagos']) $stateconditions.= "  gasto_id IS NOT NULL OR ";
		if($data['cobros']) $stateconditions.= "  factura_id IS NOT  NULL OR ";	
		if($data['traspasos']) $stateconditions.= "  metodo_id = '8' OR metodo_id = '9' OR ";										
		
		if 	($stateconditions != "") $conditions.= " AND ( ".substr($stateconditions,0,-4)." )";
		if($data['cuenta']) $conditions.= "  AND cuenta_id='".$data['cuenta']."' ";	
		
		return $conditions;																
	}
	
	
	public function index() {
		
		$cuentas = $this->Apunte->Cuenta->find('list');	
		$cuentas[0] = 'TODAS';
		if($this->request->data['Apunte'])
			$conditions = $this->getconditions($this->request->data['Apunte'],array('descripcion','cantidad','referencia'),$cuentas);
		
		$this->Apunte->recursive = 3;		
		if($this->request->data['Apunte']['resumen']){
			$this->set('apuntes', $this->Apunte->find('all',array('conditions'=>$conditions)));			
			$this->set('resumen', true);
		}else{		
			$this->paginate = array('order' => array('Apunte.fecha' => 'desc'));
			$this->set('apuntes', $this->paginate('Apunte',$conditions));			
			$this->set('resumen', false);
		}					
		$this->titulo('Apuntes');	
		$this->set(compact('cuentas'));	
		$this->set('filtrado', $this->request->isAjax());									
	}	

	public function view($id = null) {
		if (!$id) $this->errorMsg();
		$this->Apunte->recursive = 3;
		$apunte =  $this->Apunte->read(null, $id);
		$this->set('apunte', $apunte);
		$this->titulo('Apunte '.$apunte['Apunte']['referencia']);
	}
	
	public function addpago($gasto_id = null, $pendiente = null) {
		if(!$gasto_id && empty($this->request->data) ) $this->errorMsg();
		if (!empty($this->request->data)) {			
			$this->Apunte->create();
			if ($this->Apunte->save($this->request->data)) $this->okMsg(array('controller' => 'gastos','action'=> 'view', $this->request->data['Apunte']['gasto_id']));
			else $this->errorMsg(array('controller' => 'gastos','action'=> 'view', $this->request->data['Pago']['gasto_id']));
		}		
		$this->set('cantidad',$pendiente);		
		$cuentas = $this->Apunte->Cuenta->find('list');		
		$this->set(compact('gasto_id', 'cuentas'));
		$this->titulo('Añadir pago');
	}
	
	public function deletepago($id = null) {
		if (!$id)$this->errorMsg();
		$pago = $this->Apunte->read(null,$id);
		if ($this->Apunte->delete($id)) $this->okMsg(array('controller'=> 'gastos','action' => 'view', $pago['Apunte']['gasto_id']));
		$this->errorMsg();
	}
	
	public function addcobro($factura_id = null, $pendiente = null) {		
		if(!$factura_id && empty($this->request->data) ) $this->errorMsg();
		if (!empty($this->request->data)) {			
			$this->Apunte->create();
			if ($this->Apunte->save($this->request->data))$this->okMsg(array('controller' => 'facturas','action'=> 'view', $this->request->data['Apunte']['factura_id']));
			else $this->errorMsg(array('controller' => 'facturas','action'=> 'view', $this->request->data['Apunte']['factura_id']));
		}		
		$this->set('cantidad',$pendiente);
		$cuentas = $this->Apunte->Cuenta->find('list');		
		$this->set(compact( 'factura_id', 'cuentas'));
		$this->titulo('Añadir cobro');
	}	

	public function deletecobro($id = null) {
		if (!$id)$this->errorMsg();
		if ($this->Apunte->delete($id)) $this->okMsg($this->referer());
		$this->errorMsg();
	}
	
	public function traspaso(){
		if (!empty($this->request->data)) {
			$fecha = date("Y-m-d H:i:s");
			$this->Apunte->create();
			$this->request->data['Apunte']['fecha']	= $fecha;
			$this->request->data['Apunte']['cuenta_id'] = $this->request->data['Apunte']['cuenta_origen'];	
			$this->request->data['Apunte']['metodo_id'] = TRAS_ORIG;				
			if ($this->Apunte->save($this->request->data)) {
				$this->Apunte->create();
				$this->request->data['Apunte']['cuenta_id'] = $this->request->data['Apunte']['cuenta_destino'];
				$this->request->data['Apunte']['metodo_id'] = TRAS_DEST;
				if ($this->Apunte->save($this->request->data))$this->okMsg();
				else $this->errorMsg();	
			}					
		}
		$cuentas = $this->Apunte->Cuenta->find('list');	
		$this->set(compact('cuentas'));
		$this->titulo('Traspaso entre cuentas');
	}
}
?>