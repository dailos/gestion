<?php
App::uses('AppController', 'Controller');
class GraficasController extends AppController {
	
   	private function cleantext($s){   			
		$s = str_replace("\'","",$s);
		$s = str_replace(","," ",$s);		
   		$s = htmlentities($s,ENT_QUOTES, "UTF-8");
		return $s;   		 		
   	}
	
	public function estado() { 		
		if($this->request->data){
			$this->set('filtrado',true);
			$series = 	$this->request->data['Grafica'];
			$year = $this->request->data['Grafica']['year'];								
		}else{			
		  $year = date('Y');
		  $series = array('pagado' =>true,'cobrado'=>true,'facturado'=>true,'gastado'=>true,
		  						'cobros previstos'=>true,'pagos previstos'=>true,'beneficio neto'=>true,'beneficio estimado'=>true);
		}
		$this->set('series',array('pagado','cobrado','facturado','gastado','cobros previstos','pagos previstos','beneficio neto', 'beneficio estimado'));
		$this->set('action','estado');
		
	   	$this->Ofc= $this->Components->load('Ofc');	
	    $this->Ofc->set_ofc_webroot($this->webroot); 
	    $this->Ofc->set_ofc_size(900,400); 
	
		$this->loadModel('Factura');
		$facturas = $this->Factura->find('all', array('conditions'=>"Factura.fecha >= '".$year."-01-01' AND Factura.fecha <= '".$year ."-12-31'"));	
		$this->loadModel('Gasto');
		$gastos = $this->Gasto->find('all', array('conditions'=>"Gasto.fecha >= '".$year."-01-01' AND Gasto.fecha <= '".$year ."-12-31'"));		
		$this->loadModel('Apunte');
		$apuntes = $this->Apunte->find('all',array('conditions'=>"Apunte.fecha >= '".$year."-01-01' AND Apunte.fecha <= '".$year ."-12-31'"));	
					
		$mactual = date('n')-1;
		
		for ($i = 0;$i <12; $i++){
			$facturado[$i] = $gasto[$i] = $ingreso[$i] = $pago[$i] = $prevpago[$i] = $prevcobro[$i] = $cashflow[$i] =   $prevcashflow[$i] = 0;			
		}
		
		foreach ($facturas as $d ){							
			$m = date('n',strtotime($d['Factura']['fecha'])) - 1;		
			$m2 = date('n',strtotime($d['Factura']['prevcobro'])) - 1;	
			$facturado[$m] += $d['Factura']['total'];	
			if ($mactual > $m2) $m2 = $mactual;			
			if(count($d['Apunte']))$m2 = date('n',strtotime($d['Apunte'][0]['fecha'])) - 1; 						
			$prevcobro[$m2] += $d['Factura']['total'];	
		}
	   	foreach ($gastos as $d ){
	   		$m = date('n',strtotime($d['Gasto']['fecha'])) - 1;		
	   		$m2 = date('n',strtotime($d['Gasto']['prevpago'])) - 1;					
			$gasto[$m] += $d['Gasto']['total'];	
			if ($mactual > $m2) $m2 = $mactual;
			if(count($d['Apunte']))$m2 = date('n',strtotime($d['Apunte'][0]['fecha'])) - 1; 													
			$prevpago[$m2] += $d['Gasto']['total'];
		}
	   foreach ($apuntes as $d ){
	   		$m = date('n',strtotime($d['Apunte']['fecha'])) - 1;			
	   		if(isset($d['Apunte']['factura_id']))   						
				$ingreso[$m] += $d['Apunte']['cantidad'];
			else if  (isset($d['Apunte']['gasto_id'])) 
				$pago[$m] += $d['Apunte']['cantidad'];			
		}
		
		for ($m = 0; $m < 12; $m++){
			$cashflow[$m] = $ingreso[$m] - $pago[$m];
			$prevcashflow[$m] = $prevcobro[$m] -$prevpago[$m];
		}
		
		$rango = 1000;
		for ($i = 0;$i <12; $i++){
			if($facturado[$i] > $rango) $rango = $facturado[$i];
			if($gasto[$i] > $rango) $rango = $gasto[$i];
			if($ingreso[$i] > $rango) $rango = $ingreso[$i];
			if($pago[$i] > $rango) $rango = $pago[$i];	
			if($prevcobro[$i] > $rango) $rango = $prevcobro[$i];	
			if($prevpago[$i] > $rango) $rango = $pago[$i];		
		}
		$rango =ceil( $rango / 1000 ) *1000;
		
		$this->set('series',array('facturado','gastado' ,'cobrado','pagado','cobros previstos','pagos previstos', 'beneficio neto', 'beneficio estimado'));
		
	    $this->Ofc->set_ofc_title( 'Estado de la empresa', '{font-size: 20px; color: #736AFF}' ); 
	    $meses = array( 'Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre' );
	    $this->Ofc->set_ofc_x_info($meses, array('size'=>10,'color'=>'0x000000','orientation'=>0,'step'=>2)); 
	    $this->Ofc->set_ofc_y_info($rango,4,array('text'=>'euros','size'=>12,'color'=>'#736AFF'));    
	     	  
	    $this->Ofc->init(); 
	    $this->Ofc->setup(); 
	    if($series['facturado']){
	    	$this->Ofc->set_ofc_data( $facturado ); 
	    	$this->Ofc->line_dot(3, 5, '0x9933CC', 'Facturado', 10 );
	    } 
	    if($series['gastado']){
		    $this->Ofc->set_ofc_data( $gasto ); 
		    $this->Ofc->line_dot( 3, 5, '0xCC3399', 'Gastado', 10); 
	    }
	    if($series['cobrado']){
		    $this->Ofc->set_ofc_data( $ingreso ); 
		    $this->Ofc->line_dot( 3, 5, '0x80a033', 'Cobrado', 10);
	    } 
	    if($series['pagado']){
	    	$this->Ofc->set_ofc_data( $pago); 
	    	$this->Ofc->line_dot( 3, 5, '0x80a099', 'Pagado', 10 ); 
	    }
	 	if($series['cobros previstos']){
	    	$this->Ofc->set_ofc_data( $prevcobro); 
	    	$this->Ofc->line_dot( 3, 5, '0x12a079', 'Previsión cobro', 10 ); 
	    }
	 	if($series['pagos previstos']){
	    	$this->Ofc->set_ofc_data( $prevpago); 
	    	$this->Ofc->line_dot( 3, 5,'0xffa059' , 'Previsión pagos', 10 ); 
	    }
	    if($series['beneficio neto']){
	    	$this->Ofc->set_ofc_data( $cashflow ); 
		   $this->Ofc->area_hollow( 4, 6, 30, '0xff0000' , 'Beneficio neto', 10,'0xff0000' ); 
	    }
		if($series['beneficio estimado']){
	    	$this->Ofc->set_ofc_data( $prevcashflow ); 
		   	$this->Ofc->line_dot( 4, 6,'0x0000ff' , 'Beneficio estimado', 10 ); 
	    }	    
	    
	    $this->titulo('Gráfica de estado');
	    $this->set('grafica' , $this->Ofc->ofc_render()); 
	    $this->render('grafica');
	   
	}
    public function clientes(){
   		$this->Ofc= $this->Components->load('Ofc');	
	    $this->Ofc->set_ofc_webroot($this->webroot); 
	    $this->Ofc->set_ofc_size(900,400);

	    if($this->request->data) {	    		      	    
	    	$year = $this->request->data['Grafica']['year'];
	    	$this->set('filtrado',true);
	    }else{
	    	$year = date('Y');
	    }
	     
	    $this->set('action','clientes');
		$this->loadModel('Empresa');							
		$empresas = $this->Empresa->find('all');			
	    
	    foreach ($empresas as $empresa){
	    	$id = $empresa['Empresa']['id'];
	    	foreach ($empresa['Proyecto'] as $proyecto){	    		
		    	if($proyecto['facturado'] > 0 && $proyecto['fechapedido'] >= $year."-01-01" && $proyecto['fechapedido'] <= $year."-12-31" ){		    	
		    		if(!isset($y[$id])) $y[$id] = 0;		    		
		    		$valor[$id] += $proyecto['facturado'];
		    		$nombre[$id] = $this->cleantext($empresa['Empresa']['nombre']);
		    	}
	    	}
    	}    	
      	   	
    	$this->Ofc->set_ofc_title( 'Facturación a clientes', '{font-size: 20px; color: #736AFF}' ); 
    	$this->Ofc->init(); 
    	$this->Ofc->setup(); 
	    
	    $this->Ofc->set_ofc_data($valor); 
	    $this->Ofc->pie(60,'#505050','{font-size: 12px; color: #404040;'); 
	    $this->Ofc->pie_values( $nombre);     
	    $this->Ofc->pie_slice_colors( array('#d01f3c','#8790f0','#356aa0','#C79810','#ddfe30','#C79f51','#229000','#435d40','#C22410') );     	  		 		
   		
	    $this->titulo('Facturación a clientes');
	    $this->set('grafica' , $this->Ofc->ofc_render());
	    $this->set(compact('nombre','valor')); 
    	$this->render('grafica');    	    	    	
   	}
   	
 	public function proveedores(){
   		$this->Ofc= $this->Components->load('Ofc');	
	    $this->Ofc->set_ofc_webroot($this->webroot); 
	    $this->Ofc->set_ofc_size(900,400); 
	     
	    if($this->request->data){
	    	$year = $this->request->data['Grafica']['year'];
	    	$this->set('filtrado',true);
	    }else{
	    	$year = date('Y');
	    }
	    
	    $this->set('action','proveedores');
		$this->loadModel('Empresa');
		$empresas = $this->Empresa->find('all');			     	   	     	
		
	    foreach ($empresas as $empresa){
	    	$id = $empresa['Empresa']['id'];
	    	foreach ($empresa['Gasto'] as $gasto){
		    	if($gasto['total'] > 0  && $gasto['fecha'] >= $year."-01-01" && $gasto['fecha'] <= $year."-12-31" ){
		    		if(!isset($y[$id])) $y[$id] = 0;		    		
		    		$valor[$id] += $gasto['total'];
		    		$nombre[$id] =  $this->cleantext($empresa['Empresa']['nombre']);
		    	}
	    	}
    	}    	
      	   	
    	$this->Ofc->set_ofc_title( 'Compras a proveedores', '{font-size: 20px; color: #736AFF}' ); 
    	$this->Ofc->init(); 
    	$this->Ofc->setup(); 
	    
	    $this->Ofc->set_ofc_data($valor); 
	    $this->Ofc->pie(60,'#505050','{font-size: 12px; color: #404040;'); 
	    $this->Ofc->pie_values( $nombre);     
	    $this->Ofc->pie_slice_colors( array('#d01f3c','#8790f0','#356aa0','#C79810','#ddfe30','#C79f51','#229000','#435d40','#C22410') );     	  		 		
   		
	    $this->titulo('Compras a proveedores');
	    $this->set('grafica' , $this->Ofc->ofc_render()); 
	     $this->set(compact('nombre','valor'));
    	$this->render('grafica');    	    	    	
   	}
   	
 
} 