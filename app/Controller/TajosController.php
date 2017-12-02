<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
class TajosController extends AppController {

	public function beforeFilter(){
		$this->loadtaxes();		
		$this->Auth->Allow('preview','pdf','descargar');		
	}
	
	public function indexpresupuestos(){			
		$this->Tajo->recursive = 3;
		$this->paginate = array('order' => array('Tajo.id' => 'desc'));
		$this->set('tajos', $this->paginate('Tajo',array('Tajo.npresupuesto IS NOT NULL')));		
		$this->titulo('Listado de presupuestos');
		$this->render('index');
	}
	
	public function preview($id = null, $print = false){
		if (!$id) $this->errorMsg();		
		$this->Tajo->recursive = 3;
		$tajo =  $this->Tajo->read(null, $id);
			   
		foreach ($tajo['Servicio'] as $servicio){ 
			$apuntado = false;
			$datoseconomicos = $this->economicos($servicio['ServiciosTajo'],$datoseconomicos);
			if(!empty($conceptos['ser_'.$servicio['ServiciosTajo']['servicio_id']])){
				foreach ($conceptos['ser_'.$servicio['ServiciosTajo']['servicio_id']] as $ind => $apunte){
					if($apunte['nombre'] == $material['MaterialesTajo']['nombre'] &&
						$apunte['pdescuento'] == $servicio['ServiciosTajo']['pdescuento'] &&
						$apunte['impuesto1_id'] == $servicio['ServiciosTajo']['impuesto1_id'] &&
						$apunte['impuesto2_id'] == $servicio['ServiciosTajo']['impuesto2_id']){
						$conceptos['ser_'.$servicio['ServiciosTajo']['servicio_id']][$ind]['cantidad'] += $servicio['ServiciosTajo']['cantidad'];
						$apuntado = true;
					}						
				}					
			}
			if(!$apuntado) $conceptos['ser_'.$servicio['ServiciosTajo']['servicio_id']][] = $servicio['ServiciosTajo'];														
		}
		foreach ($tajo['Material'] as $material) {
			$apuntado = false;
			$datoseconomicos = $this->economicos($material['MaterialesTajo'],$datoseconomicos);	
			if(!empty($conceptos['mat_'.$material['MaterialesTajo']['material_id']])){
				foreach ($conceptos['mat_'.$material['MaterialesTajo']['material_id']] as $ind => $apunte){
					if($apunte['nombre'] == $material['MaterialesTajo']['nombre'] &&
						$apunte['pdescuento'] == $material['MaterialesTajo']['pdescuento'] &&
						$apunte['impuesto1_id'] == $material['MaterialesTajo']['impuesto1_id'] &&
						$apunte['impuesto2_id'] == $material['MaterialesTajo']['impuesto2_id']){
						$conceptos['mat_'.$material['MaterialesTajo']['material_id']][$ind]['cantidad'] += $material['MaterialesTajo']['cantidad'];
						$apuntado = true;
					}						
				}					
			}
			if(!$apuntado) $conceptos['mat_'.$material['MaterialesTajo']['material_id']][] = $material['MaterialesTajo'];															
		}
		
		$this->loadModel("Empresa");
		$misdatos = $this->Empresa->read(null,SISTEMA);	
		$misdatos = $misdatos['Empresa'];
		$this->set(compact('tajo','datoseconomicos','misdatos','conceptos','print'));
		$this->titulo('Presupuesto '.$tajo['Tajo']['npresupuesto']);				
		if($print) $this->layout = 'pdfprint';
	}	
	
	public function pdf($id = null, $hash = null,$externa = null){		
		if ($hash != md5($id)) $this->redirect($this->Auth->logout());
		$tajo = $this->Tajo->read(null,$id);		
		if($externa) $this->Tajo->saveField('fecha_recepcion',date("Y-m-d H:i:s"));		
				
		$this->Pdf= $this->Components->load('Pdf');			
		$this->Pdf->filename = $tajo['Tajo']['npresupuesto'];
		$this->Pdf->output = 'download'; 
        $this->Pdf->init();
        $this->Pdf->process(Router::url('/', true) . 'tajos/preview/'. $id."/1"); 
        $this->render(false);         
	}
	
	public function descargar($id = null, $hash = null){	
		if ($hash != md5($id)) $this->redirect($this->Auth->logout());		
		$presupuesto = $this->Tajo->read(null,$id);	
		$this->set(compact(array('id','hash','presupuesto')));	
		$this->layout = 'descargas';												
	}
	
	public function view($id = null,$edit =false) {
		if (!$id) $this->errorMsg(array('controller'=>'proyectos','action' => 'index'));
		$this->Tajo->recursive = 3;
		$tajo = $this->Tajo->read(null, $id);		
		if(empty($tajo['Tajo']['referencia'])) $this->redirect(array('action' => 'viewpresupuesto',$tajo['Tajo']['id']));		
		
		foreach ($tajo['Servicio'] as $servicio) $datoseconomicos = $this->economicos($servicio['ServiciosTajo'],$datoseconomicos);													
		foreach ($tajo['Material'] as $material)$datoseconomicos = $this->economicos($material['MaterialesTajo'],$datoseconomicos);		
		
		if($tajo['Tajo']['total'] != $datoseconomicos['total']) $this->Tajo->saveField('total',$datoseconomicos['total']);			
		
		$this->set(compact('datoseconomicos','tajo'));	
		$this->titulo("Tajo ".$tajo['Tajo']['referencia']);	
		if($edit){
			$this->set('edit', true);
			$this->Tajo->recursive = 3;
			$this->request->data = $this->Tajo->read(null, $id);
			$empleados = $this->Tajo->Empleado->find('list');
			$this->set(compact('empleados'));		
		}
	}
	
	public function viewpresupuesto($id = null) {
		if (!$id) $this->errorMsg(array('controller'=>'proyectos','action' => 'index'));
		$this->Tajo->recursive = 3;		
		$tajo = $this->Tajo->read(null, $id);						
		
		foreach ($tajo['Servicio'] as $servicio) $datoseconomicos = $this->economicos($servicio['ServiciosTajo'],$datoseconomicos);											
		foreach ($tajo['Material'] as $material) $datoseconomicos = $this->economicos($material['MaterialesTajo'],$datoseconomicos);

		if($tajo['Tajo']['total'] != $datoseconomicos['total']) $this->Tajo->saveField('total',$datoseconomicos['total']);
		
		$this->set(compact('datoseconomicos','tajo'));	
		$this->titulo("Presupuesto ".$tajo['Tajo']['npresupuesto']);	
	}

	public function addpresupuesto($proyecto_id = null){
		if (!empty($this->request->data)) {				
			if($this->request->data['Tajo']['proyecto_id']){			
				$this->Tajo->create();
				if ($this->Tajo->save($this->request->data)) $this->okMsg(array('action' => 'viewpresupuesto',$this->Tajo->id));				
				else $this->errorMsg(array('controller'=>'proyectos','action' => 'view',$this->request->data['Tajo']['proyecto_id']));
			}else $this->errorMsg(array('controller'=>'proyectos','action' => 'index'));	
		}	
		
		$npresupuesto = $this->getserial('Tajo','npresupuesto','PRE');
		$this->titulo('Crear presupuesto '.$npresupuesto);		
		$this->set(compact('proyecto_id','npresupuesto'));	
	}
	
	public function add($proyecto_id =null) {
		if (!empty($this->request->data)) {				
			if($this->request->data['Tajo']['proyecto_id']){									
				$this->Tajo->create();
				if ($this->Tajo->save($this->request->data))$this->okMsg(array('action' => 'view',$this->Tajo->id));
				else $this->errorMsg(array('controller'=>'proyectos','action' => 'view',$this->request->data['Tajo']['proyecto_id']));
			}else $this->errorMsg(array('controller'=>'proyectos','action' => 'index'));	
		}	
		$referencia = $this->getserial('Tajo','referencia');		
		$this->titulo('Crear tajo '.$referencia);
		$empleados = $this->Tajo->Empleado->find('list',array('conditions' => array('empresa_id' => SISTEMA)));		
		$this->set(compact('referencia','proyecto_id','empleados'));			
	}

	public function edit($id = null) {
		if (!$id && empty($this->request->data)) $this->errorMsg(array('controller'=>'proyectos','action' => 'index'));
			
		if (!empty($this->request->data)) {			
			if ($this->Tajo->saveAll($this->request->data)) $this->okMsg(array('action' => 'view',$this->request->data['Tajo']['id']));
			else $this->errorMsg();
		}				
		
		$this->request->data = $this->Tajo->read(null, $id);			
		$empleados = $this->Tajo->Empleado->find('list',array('conditions' => array('empresa_id' => SISTEMA)));
		$this->set(compact('empleados'));
	}
	
	public function editpresupuesto($id = null) {
		if (!$id && empty($this->request->data)) $this->errorMsg(array('controller'=>'proyectos','action' => 'index'));
			
		if (!empty($this->request->data)) {
			if ($this->Tajo->save($this->request->data)) $this->okMsg(array('controller' => 'proyectos','action' => 'view',$this->request->data['Tajo']['proyecto_id']));
			else $this->errorMsg();
		}						
		$this->request->data = $this->Tajo->read(null, $id);				
	}

	public function delete($id = null) {
		if (!$id) $this->errorMsg(array('controller'=>'proyectos','action' => 'index'));
		$tajo = $this->Tajo->read(null, $id);	
		$ok = true;				
		if($tajo['Tajo']['referencia']){
			foreach ($tajo['Material'] as $material) {
				if(!$this->stock($material['id'],$material['MaterialesTajo']['cantidad'])) $ok =false;
			}	
		}	
		if($tajo['Tajo']['npresupuesto'] && $tajo['Tajo']['referencia']) {														
			if (!$this->Tajo->saveField('referencia',null)) $ok = false;											
		}else{								
			if (!$this->Tajo->delete($id)) $ok = false;
		}		
		if($ok)$this->okMsg(array('controller'=>'proyectos','action' => 'view',$tajo['Tajo']['proyecto_id']));
		else $this->errorMsg(array('controller'=>'proyectos','action' => 'view',$tajo['Tajo']['proyecto_id']));					 					
	}
	
	public function select($factura_id =null,$proyecto_id = null){			
		if(!$factura_id || !$proyecto_id) $this->errorMsg();				
		$this->Tajo->recursive = 0;
		$this->set('factura_id',$factura_id);
		$this->set('tajos', $this->paginate('Tajo',array('Tajo.referencia IS NOT NULL','Tajo.factura_id IS NULL' , 'Tajo.proyecto_id' => $proyecto_id)));	
		$this->set('titulo','Añade tajo a la factura');
	}	
	
	public function import($tajo_id = null, $field= "referencia"){	
		if(!$tajo_id) $this->errorMsg();
		$this->set('field', $field);
		$this->Tajo->recursive = 2;
		$this->set('tajo_id',$tajo_id);
		 $this->paginate = array('conditions' => array("Tajo.$field IS NOT NULL"),
        						'limit' => 5);
		$this->set('tajos', $this->paginate('Tajo'));
		$this->set('titulo','Importar materiales y servicios');
	}	
		
	public function importarElementos($tajo_origen_id, $tajo_destino_id,$updateStock = null){		
		$tajoOrigen = $this->Tajo->read(null, $tajo_origen_id);
		$this->Tajo->id = $tajo_destino_id;
		$this->Tajo->saveField('descripcion',$tajoOrigen['Tajo']['descripcion']);
		foreach($tajoOrigen['Material'] as $material){
			$this->Tajo->MaterialesTajo->create();
			$material['MaterialesTajo']['tajo_id'] = $tajo_destino_id;
			unset($material['MaterialesTajo']['id']);			
			$this->Tajo->MaterialesTajo->save($material['MaterialesTajo']);
			if($updateStock == "updateStock")
				$this->stock($material['id'],-$material['MaterialesTajo']['cantidad']);
		}
		foreach($tajoOrigen['Servicio'] as $servicio){
			$this->Tajo->ServiciosTajo->create();
			$servicio['ServiciosTajo']['tajo_id'] = $tajo_destino_id;
			unset($servicio['ServiciosTajo']['id']);
			$this->Tajo->ServiciosTajo->save($servicio['ServiciosTajo']);			
		}
		
		$this->okMsg("/tajos/view/".$tajo_destino_id);
	}
	
	public function setfactura($tajo_id =null, $factura_id =null,$edit = false){
		if(!$tajo_id || !$factura_id) $this->errorMsg();
		$this->Tajo->id = $tajo_id;
		$editar = "";
		if($edit) $editar = '/true';
		if ($this->Tajo->saveField('factura_id',$factura_id)) $this->okMsg("/facturas/view/$factura_id".$editar);
		else $this->errorMsg("/facturas/view/$factura_id");		
	}	
	
	public function unsetfactura($tajo_id =null, $factura_id =null){
		if(!$tajo_id || !$factura_id) $this->errorMsg();
		$this->Tajo->id = $tajo_id;
		if ($this->Tajo->saveField('factura_id',null)) $this->okMsg("/facturas/view/$factura_id");
		else $this->errorMsg("/facturas/view/$factura_id");		
	}	
	
	public function tajofrompresupuesto($tajo_id = null){
		if (!$tajo_id && empty($this->request->data)) $this->errorMsg(array('controller'=>'proyectos','action' => 'index'));							
		$this->request->data =  $this->Tajo->read(null, $tajo_id);	
		$this->request->data['Tajo']['referencia'] = $this->getserial('Tajo','referencia');
		$tajo =  $this->Tajo->read(null, $this->request->data['Tajo']['id']);	
		foreach ($tajo['Material'] as $material) $this->stock($material['id'],-$material['MaterialesTajo']['cantidad']);			
		if ($this->Tajo->saveAll($this->request->data['Tajo'])) $this->okMsg(array('controller'=>'tajos','action' => 'view',$this->request->data['Tajo']['id'],true));
						
	}
	public function email($id = null,$email = null) {
		if (!empty($this->request->data)) {								
			$this->Tajo->id = $this->request->data['Tajo']['id'];			
			$this->Tajo->saveField('fecha_envio',date("Y-m-d H:i:s"));
			$this->Tajo->saveField('fecha_recepcion',null);
			
			$email = new CakeEmail('smtp');
			$email->from(array(ADMIN_EMAIL => 'Feromadel S.L.'));
			$email->to($this->request->data['Tajo']['email']);	  
		    $email->subject('Feromadel S.L. : Presupuesto ref. '.$this->request->data['Tajo']['npresupuesto'].' listo para descargar');
		    $email->replyTo(ADMIN_EMAIL);		       
		    $email->template('factura','default');// ctp filename
		    $email->emailFormat('html');//text and html		 

		    $email->viewVars(array('cuerpo' => $this->request->data['Tajo']['cuerpo']));				       			    
		    $email->send();    	    		
		    $this->Session->setFlash(__(ACCION_OK, true));	     		
		    $this->okMsg("/tajos/indexpresupuestos");  
		}else{
			$tajo = $this->Tajo->read(null, $id);
			$this->set(compact('email','id','tajo'));
			$this->titulo('Enviar presupuesto');
		}   
	}
	public function entregado($id = null){
		$this->Tajo->id = $id;				
		$this->Tajo->saveField('fecha_envio',date("Y-m-d H:i:s"));
		$this->Tajo->saveField('fecha_recepcion',date("Y-m-d H:i:s"));
		$this->okMsg("/tajos/indexpresupuestos");		
	}
	
	public function abrir($id = null){
		$this->Tajo->id = $id;				
		$this->Tajo->saveField('fecha_envio',null);
		$this->Tajo->saveField('fecha_recepcion',null);
		$this->okMsg("/tajos/viewpresupuesto/".$id);		
	}
}
?>