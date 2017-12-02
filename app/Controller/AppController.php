<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * This is a placeholder class.
 * Create the same file in app/Controller/AppController.php
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       Cake.Controller
 * @link http://book.cakephp.org/view/957/The-App-Controller
 */
class AppController extends Controller {

public $components = array('RequestHandler','Session','Auth' => array(
			'authenticate' => array('Form' => array('userModel' => 'Usuario')),
	        'loginAction' =>  array('controller' => 'usuarios','action' => 'login'),     
	        'loginRedirect' =>  array('controller' => 'proyectos', 'action'=>'index'),     
	        'authorize'  => array('Controller'),    
			)
);	
public $helpers = array('Js'=>array('Prototype'),'Form', 'Html', 'Session','Cksource','Format');	

	
	public function isAuthorized(){return true;}
    
	public function resettaxes(){
		Configure::write('taxes', null);
		$this->loadtaxes();
	}
	
	public function loadtaxes(){
		$taxes = Configure::read('taxes');
		if(empty($taxes)){
			$this->loadModel('Impuesto');
			$limpuestos = $this->Impuesto->find('all');
			$taxes = array();
			foreach($limpuestos as $imp){
				$taxes[$imp['Impuesto']['id']] = 
					array('nombre'=> $imp['Impuesto']['nombre'],
						'porcentaje' => $imp['Impuesto']['porcentaje'] );
			} 
			Configure::write('taxes', $taxes);
		}
		$this->set('taxes',$taxes);
	}							
							
	public function errorMsg($url = null,$msg = null){
		if($msg) $this->Session->setFlash($msg, true);
		else $this->Session->setFlash(__(ACCION_FAIL, true));
		if($url) $this->redirect($url);
		else $this->redirect(array('action' => 'index'));
	}
	
	public function okMsg($url = null,$msg = null){
		if($msg) $this->Session->setFlash($msg, true);
		else $this->Session->setFlash(__(ACCION_OK, true));
		if($url)  $this->redirect($url);
		else $this->redirect(array('action' => 'index'));		
	}
	
	public function titulo($text = null){			
		$this->set('titulo',$text);
		$cont = $this->params['controller'];
		$act =  $this->params['action'];			
		if($cont =='tajos' && ($act == 'indexpresupuestos' || $act == 'viewpresupuesto') ) $icono = 'presupuestos';
		else if($cont =='tajos') $icono = 'proyectos';
		else if($cont =='albaranes' && ($act == 'indexpedidos' || $act == 'viewpedido') ) $icono = 'pedidos';					
		else $icono = $cont;					
		$this->set('icono',$icono.'.png');
	}
		
	public function getserial($model,$field,$textini = null){
		if(!$textini) $textini = strtoupper( substr($model, 0,3));
		$year = (int)substr(date("Y"), 2);
		$textini .= "-".$year."-";			
		$lastitem = $this->{$model}->find('first',array('fields'=>$field,'order' => $field.' DESC'));						
   	    if(empty($lastitem)) 
   	    	$serial = 0;
   	    else{
   	    	$serial = (int)substr($lastitem[$model][$field], 7);
   	    	$lastyear = (int)substr($lastitem[$model][$field], 4,2);   	    	
   	    	if($year != $lastyear) $serial = 0;
   	    }   							
		$serial = str_pad(++$serial,3, '0',STR_PAD_LEFT);
		return $textini.$serial;							
	}
	
	public function setproyectstate($id = null){
		//SININICIAR, PRESUPUESTADO, INICIADO, FACTURADO, COBRADO	
		$this->loadModel('Proyecto');	
		if(!$id) $this->errorMsg();
		$this->Proyecto->recursive = 3;
		$proyecto = $this->Proyecto->read(null,$id);			
		
		$proyecto['estado_id'] = SININICIAR;
		if(!empty($proyecto['Tajo'])){						
			$pend = $fac =$pre = $nullfac  =$abierta = false;
			foreach ($proyecto['Tajo'] as $key => $tajo){
				if($tajo['referencia']){		   
					foreach ($tajo['Servicio'] as $servicio) $d_eco_pro = $this->economicos($servicio['ServiciosTajo'],$d_eco_pro);													
					foreach ($tajo['Material'] as $material) $d_eco_pro = $this->economicos($material['MaterialesTajo'],$d_eco_pro);
				}else if($tajo['npresupuesto']){
					foreach ($tajo['Servicio'] as $servicio) $d_eco_pro_pre = $this->economicos($servicio['ServiciosTajo'],$d_eco_pro_pre);													
					foreach ($tajo['Material'] as $material) $d_eco_pro_pre = $this->economicos($material['MaterialesTajo'],$d_eco_pro_pre);
				}
				if(empty($tajo['Factura'])){	
					if($tajo['npresupuesto'] && !$tajo['referencia']) $pre = true;					
					else $nullfac = true;
				} else{
					$fac = true;
					if($tajo['Factura']['estado_id'] != COBRADA) $pend = true;	
					if($tajo['Factura']['estado_id'] < CERRADA) $abierta = true;										
				}			
			}				
			$facturado = 0;
			$cobrado = 0;
			foreach ($proyecto['Factura']as $factura){				
				$facturado +=$factura['total'];
				foreach ($factura['Apunte'] as $cobro) $cobrado += $cobro['cantidad'];
			}	
			
			if(!$fac  && !$nullfac && $pre) $proyecto['estado_id'] = PRESUPUESTADO;
			else if(!$nullfac){ 
				if($abierta)$proyecto['estado_id'] = INICIADO;
				else if($pend) $proyecto['estado_id'] = FACTURADO;	
				else  $proyecto['estado_id'] = COBRADO;		
			}else{ 
				$proyecto['estado_id'] =INICIADO;
			}									
		}			
		$this->Proyecto->id = $id;
		$this->Proyecto->set(array(
							'estado_id' =>$proyecto['estado_id'],
							'total' => $d_eco_pro['total'],
							'facturado' => $facturado,
							'pendiente' =>  round($d_eco_pro['total']-$cobrado,2),
							'beneficio' =>$d_eco_pro['subtotal']-$d_eco_pro['coste'] ,
							'coste' => $d_eco_pro['coste']
		));
		$this->Proyecto->save();
		$this->set('presupuestado',$d_eco_pro_pre['total']);
		$this->set(compact('d_eco_pro'));	
	}

	public function economicos($d,$datoseconomicos = null,$albaran = false){
		if(!$datoseconomicos) $datoseconomicos = array('subtotal' =>0,'descuento' =>'0','total'=>0,'coste'=>0,'baseimponible'=>0,'sinimpuestos'=>false,'impuestos' =>array());		
		if($d['impuesto1_id'] == SISTEMA && $d['impuesto2_id'] ==SISTEMA) $datoseconomicos['sinimpuestos'] = true;
		$taxes = Configure::read('taxes');	
		$imp1 =  $taxes[$d['impuesto1_id']]['porcentaje']/100;			
		$imp2 =  $taxes[$d['impuesto2_id']]['porcentaje']/100;
				
		$desc = $d['pdescuento']/100;		
		if($albaran) $_subtotal = $d['cantidad']*$d['coste'];
		else {
			$_subtotal = $d['cantidad']*$d['precio'];
			$datoseconomicos['coste'] += round($d['cantidad']*$d['coste'],2);	
		}
		if($d['impuesto1_id'] != SISTEMA)						
			$datoseconomicos['impuestos'][$taxes[$d['impuesto1_id']]['nombre']] += round($_subtotal*(1-$desc)*$imp1,2);
		if($d['impuesto2_id'] != SISTEMA)
			$datoseconomicos['impuestos'][$taxes[$d['impuesto2_id']]['nombre']] += round($_subtotal*(1-$desc)*$imp2,2);
		$datoseconomicos['subtotal'] +=round($_subtotal,2);
		$datoseconomicos['descuento'] += round($_subtotal*$desc,2);		
		$datoseconomicos['baseimponible'] += round($_subtotal*(1-$desc),2);
		$datoseconomicos['total'] += round($_subtotal*(1-$desc)*(1 + $imp1 + $imp2),2);
		//$datoseconomicos['total'] += round($_subtotal*(1+$imp1)*(1+$imp2)*(1-$desc),2);
				
		return $datoseconomicos;				
	}
	public function stock($material_id = null, $cantidad = 0){
		if(!$material_id) $this->errorMsg();
		if($material_id != SISTEMA){
			$this->loadModel('Material');
			$material = $this->Material->read(null,$material_id);
			$cantidad += $material['Material']['cantidad'];		
			if($this->Material->saveField('cantidad',$cantidad)) return true;
		}
	}
	
	public function getconditions($data,$model,$estados,$fields,$modelempresa = null){			
		if(!$modelempresa) $modelempresa = $model;
		$conditions = "";	
		$stateconditions = "";		
		$filter['text'] = $data['filtro'];
		$filter['inidate'] = $data['fechainicio']['year']."-".$data['fechainicio']['month']."-".$data['fechainicio']['day'];
        $filter['enddate'] = $data['fechafin']['year']."-".$data['fechafin']['month']."-".$data['fechafin']['day'];									
		if($data['filtro']){
			foreach ($fields['filtro'] as $field){
				$conditions.= " $field like '%".$data['filtro']."%' OR " ;
			}			
			$this->loadModel('Empresa');
			$this->Empresa->recursive = 0;
			$empresas = $this->Empresa->find('list',array('conditions'=>" Empresa.nombre like '%".$data['filtro']."%'"));
			foreach ($empresas as $key => $value) {
				$conditions .= " $modelempresa.empresa_id = '$key' OR ";
			}	
			$conditions = substr($conditions,0,-3)." AND ";
		} 													
		$conditions.=  $model.".".$fields['campofecha'].  " >= '".$filter['inidate']."' AND ". 
						$model.".".$fields['campofecha']." <= '".$filter['enddate']."' ";	
		foreach ($estados as $valor => $nombre){
			if($data[$nombre] == '1'){
				$stateconditions.= "  ".$model.".estado_id like '$valor' OR ";
				$filter['checkbox'][] = $valor;
			} 
		}
		if 	($stateconditions != "") $conditions.= " AND ( ".substr($stateconditions,0,-4)." )";	
		SessionComponent::write('sqlconditions.'.$model, $conditions);		
		SessionComponent::write('filter.'.$model, $filter);																			
	}
			
}
