<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
class FacturasController extends AppController {

	public function beforeFilter(){
		$this->set('metodospago',Configure::read('metodospago'));
		$this->set('estadosfactura',Configure::read('estadosfactura'));
		$this->loadtaxes();
		$this->Auth->Allow('preview','pdf','descargar');
	}

	public function index() {
		if($this->request->data['Factura'])
			$this->getconditions($this->request->data['Factura'],'Factura', Configure::read('estadosfactura'),
									array('campofecha'=>'fecha','filtro'=> array('Factura.descripcion','Factura.nfactura','Proyecto.titulo')),'Proyecto');

		$filter = SessionComponent::read('filter.Factura');
		if(!$conditions = SessionComponent::read('sqlconditions.Factura')){
			$conditions = "";
			$filter = Configure::read('filter.Factura');
			foreach ($filter['checkbox'] as $valor){
				$conditions.= "  Factura.estado_id like '$valor' OR ";
			}
			$conditions = substr($conditions,0,-4);
		}
		$this->set('filter',$filter);

		$this->Factura->recursive = 2;
		if($this->request->data['Factura']['resumen']){
			$facturas = $this->Factura->find('all',array('conditions'=>$conditions));
			$this->set('facturas', $facturas);
			$datoseconomicos = null;
			foreach ($facturas as $factura){
				foreach ($factura['Tajo'] as $key => $tajo){
					foreach ($tajo['Servicio'] as $servicio) $datoseconomicos = $this->economicos($servicio['ServiciosTajo'],$datoseconomicos);
					foreach ($tajo['Material'] as $material) $datoseconomicos = $this->economicos($material['MaterialesTajo'],$datoseconomicos);
				}
			}

			$this->set('resumen', true);
			$this->set('economicos',$datoseconomicos);
		}else{
			$this->paginate = array('order' => array('Factura.nfactura' => 'desc'));
			$this->set('facturas', $this->paginate('Factura',$conditions));
			$this->set('resumen', false);
		}
		$this->titulo('Listado de Facturas');
		$this->set('filtrado', $this->request->isAjax());
	}


	public function preview($id = null, $print = false){
		if (!$id) $this->errorMsg();
		$this->Factura->recursive = 3;
		$factura =  $this->Factura->read(null, $id);

		foreach ($factura['Tajo'] as $key => $tajo){
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
		}
		$this->loadModel("Empresa");
		$misdatos = $this->Empresa->read(null,SISTEMA);
		$misdatos = $misdatos['Empresa'];
		$this->set(compact('factura','datoseconomicos','misdatos','conceptos','print'));
		$this->titulo('Factura '.$factura['Factura']['nfactura']);
		if($print) $this->layout = 'pdfprint';		
	}

	public function pdf($id = null, $hash = null,$externa = null){
		if ($hash != md5($id)) $this->redirect($this->Auth->logout());
		$factura = $this->Factura->read(null,$id);

		if($externa) $this->Factura->saveField('fecha_recepcion',date("Y-m-d H:i:s"));

		$this->Pdf= $this->Components->load('Pdf');
		$this->Pdf->filename = $factura['Factura']['nfactura'];
		$this->Pdf->output = 'download';
        $this->Pdf->init();
        $this->Pdf->process(Router::url('/', true) . 'facturas/preview/'. $id."/1");
        $this->render(false);
	}

	public function descargar($id = null, $hash = null){
		if ($hash != md5($id)) $this->redirect($this->Auth->logout());
		$factura = $this->Factura->read(null,$id);
		$this->set(compact(array('id','hash','factura')));
		$this->layout = 'descargas';
	}


	public function view($id = null,$edit = false) {
		if (!$id) $this->errorMsg();
		$this->Factura->recursive = 3;
		$factura =  $this->Factura->read(null, $id);

		foreach ($factura['Tajo'] as $key => $tajo){
			foreach ($tajo['Servicio'] as $servicio) $datoseconomicos = $this->economicos($servicio['ServiciosTajo'],$datoseconomicos);
			foreach ($tajo['Material'] as $material) $datoseconomicos = $this->economicos($material['MaterialesTajo'],$datoseconomicos);
		}

		foreach ($factura['Apunte'] as $cobro) $cobrado += $cobro['cantidad'];
		$total = round($datoseconomicos['total'],2);
		if($total != $factura['Factura']['total']){
			$this->Factura->saveField('total',$total);
			$factura['Factura']['total'] = $total;
		}
		if($total){
			$pendiente = round($total-$cobrado,2);
			if($pendiente != $factura['Factura']['pendiente'] ){
				$this->Factura->saveField('pendiente',$pendiente);
				$factura['Factura']['pendiente'] = $pendiente;
			}
			if($pendiente == 0 && $factura['Factura']['estado_id'] == CERRADA ) {
				$this->Factura->saveField('estado_id',COBRADA);
				$factura['Factura']['estado_id'] = COBRADA;
			}
		}

		$this->set(compact('factura','datoseconomicos'));
		$this->titulo('Factura '.$factura['Factura']['nfactura']);
		$this->setproyectstate($factura['Factura']['proyecto_id']);
		if($edit){
			$this->set('edit', true);
			$this->Factura->recursive = 3;
			$this->request->data = $this->Factura->read(null, $id);

		}
	}

	public function add($tajo_id = null) {
		if(!$tajo_id) $this->errorMsg();
		$this->loadModel('Tajo');
		$tajo = $this->Tajo->read(null,$tajo_id);
		$this->request->data['Factura']['nfactura'] =  $this->getserial('Factura','nfactura');
		$this->request->data['Factura']['fecha'] = date("Y-m-d H:i:s");
		$this->request->data['Factura']['proyecto_id'] = $tajo['Tajo']['proyecto_id'];
		$this->request->data['Factura']['estado_id'] = ABIERTA;
		$this->request->data['Factura']['descripcion'] = $tajo['Tajo']['descripcion'];
		if($tajo['Tajo']['npresupuesto']) $this->request->data['Factura']['notas'] = 'Factura correspondiente al presupuesto '.$tajo['Tajo']['npresupuesto'];
		$this->Factura->create();
		if ($this->Factura->save($this->request->data)) $this->redirect( array('controller'=>'tajos','action'=>'setfactura',$tajo_id,$this->Factura->id,true));
		else $this->errorMsg(array('controller'=>'proyectos','action' => 'view',$tajo['Tajo']['proyecto_id']));
	}

	public function edit($id = null) {
		if (!$id && empty($this->request->data)) $this->errorMsg();
		if (!empty($this->request->data)) {
			if ($this->Factura->save($this->request->data)) $this->okMsg(array('action'=>'view',$this->request->data['Factura']['id']));
			else $this->errorMsg(array('controller'=>'proyectos','action' => 'view',$this->request->data['Factura']['proyecto_id']));
		}
		if (empty($this->request->data)) {
			$this->Factura->recursive = 3;
			$this->request->data = $this->Factura->read(null, $id);
		}
	}

	public function delete($id = null) {
		if (!$id) $this->errorMsg();
		$factura =  $this->Factura->read(null,$id);
		if(!empty($factura['Apuntes']))$this->errorMsg(array('controller'=>'proyectos','action' => 'view',$factura['Factura']['proyecto_id']),'Existen cobros relacionados, imposible de eliminar la factura');
		if($this->Factura->delete($id)) $this->okMsg(array('controller'=>'proyectos','action' => 'view',$factura['Factura']['proyecto_id']));
		$this->errorMsg(array('controller'=>'proyectos','action' => 'view',$factura['Factura']['proyecto_id']));
	}

	public function cerrar($id = null){
		if (!$id) $this->errorMsg();
		$this->Factura->id = $id;
		$this->Factura->saveField('estado_id',CERRADA);
		$this->redirect(array('action'=>'view',$id));
	}

	public function abrir($id = null){
		if (!$id) $this->errorMsg();
		$this->Factura->id = $id;
		if ($this->Factura->saveField('estado_id',ABIERTA)) $this->okMsg(array('action'=>'view', $id));
		else $this->errorMsg(array('action'=>'view', $id));
	}

	public function entregada($id = null){
		$this->Factura->id = $id;
		$this->Factura->saveField('fecha_envio',date("Y-m-d H:i:s"));
		$this->Factura->saveField('fecha_recepcion',date("Y-m-d H:i:s"));
		$this->okMsg();
	}

	public function email($id = null,$email = null) {
		if (!empty($this->request->data)) {
			$this->Factura->id = $this->request->data['Factura']['id'];
			$this->Factura->saveField('fecha_envio',date("Y-m-d H:i:s"));
			$this->Factura->saveField('fecha_recepcion',null);

			$email = new CakeEmail('smtp');
			$email->from(array(ADMIN_EMAIL => 'Feromadel S.L.'));
			$email->to($this->request->data['Factura']['email']);
		    $email->subject('Feromadel S.L. : Factura ref. '.$this->request->data['Factura']['nfactura'].' lista para descargar');
		    $email->replyTo(ADMIN_EMAIL);
		    $email->template('factura','default');// ctp filename
		    $email->emailFormat('html');//text and html

		    $email->viewVars(array('cuerpo' => $this->request->data['Factura']['cuerpo']));
		    $email->send();
		    $this->Session->setFlash(__(ACCION_OK, true));
		    $this->okMsg();
		}else{
			$factura = $this->Factura->read(null, $id);
			$this->set(compact('email','id','factura'));
			$this->titulo('Enviar factura');
		}

	}

}


