<?php 
	$cont = $this->params['controller'];
	$act =  $this->params['action'];
	$empresas = $gestion = $gastos = $apuntes = $configuracion = $graficas = "";
	if($cont =='proyectos' || $cont =='facturas' || $cont =='tajos') $gestion = 'active_tab';
	else if($cont =='albaranes' || $cont =='gastos') $gastos = 'active_tab';
	else if($cont =='empresas') $empresas = 'active_tab';
	else if($cont =='apuntes') $apuntes = 'active_tab';
	else if($cont =='graficas') $graficas = 'active_tab';
	else $configuracion = 'active_tab';				
?>
<center>
<?php echo $this->Session->flash();?>

<div class="logout">
	<?php echo $this->Html->link($this->Html->image('logout.png',array('title'=>'Salir')), array('controller'=>'usuarios', 'action' =>'logout'),array('escape'=>false)); ?>
</div>
</center>	
<div class="mainmenu">
<ul id="navigation" class="css_menu">
	<li class="<?php echo $gestion;?>" >Gestión
		<ul class="css_menu">
			<li><?php echo $this->Html->link('Proyectos', array('controller'=>'proyectos','action' =>'index'));?></li>
			<li><?php echo $this->Html->link('Facturas', array('controller'=>'facturas','action' =>'index'));?></li>
			<li><?php echo $this->Html->link('Presupuestos', array('controller'=>'tajos','action'=>'indexpresupuestos'));?></li>
		</ul>
	</li>
	<li class="<?php echo $gastos;?>" >Gastos
		<ul class="css_menu">
			<li><?php echo $this->Html->link('Gastos', array('controller'=>'gastos','action' =>'index'));?></li>
			<li><?php echo $this->Html->link('Albaranes', array('controller'=>'albaranes','action'=>'index'));?></li>
			<li><?php echo $this->Html->link('Pedidos', array('controller'=>'albaranes','action'=>'indexpedidos'));?></li>
		</ul>
	</li>	
	<li class="<?php echo $empresas;?>" ><?php echo $this->Html->link('Empresas', array('controller'=>'empresas','action' =>'index'));?></li>				
	<li class="<?php echo $apuntes;?>" ><?php echo $this->Html->link('Apuntes', array('controller'=>'apuntes','action' =>'index'));?></li>	
	<li class="<?php echo $graficas;?>" >Resumen
		<ul class="css_menu">
			<li><?php echo $this->Html->link('Estado', array('controller'=>'graficas','action'=>'estado',));?></li>	
			<li><?php echo $this->Html->link('Clientes', array('controller'=>'graficas','action'=>'clientes',));?></li>	
			<li><?php echo $this->Html->link('Proveedores', array('controller'=>'graficas','action'=>'proveedores',));?></li>	
		</ul>
	</li>
	<li class="<?php echo $configuracion;?>" >Configuración
		<ul class="css_menu">
			<li><?php echo $this->Html->link('Mis Datos', array('controller'=>'empresas','action'=>'view',1));?></li>
			<li><?php echo $this->Html->link('Materiales', array('controller'=>'materiales','action' =>'index'));?></li>
			<li><?php echo $this->Html->link('Servicios', array('controller'=>'servicios','action' =>'index'));?></li>
			<li><?php echo $this->Html->link('Almacenes', array('controller'=>'almacenes','action' =>'index'));?></li>
			<li><?php echo $this->Html->link('Herramientas', array('controller'=>'herramientas','action' =>'index'));?></li>
			<li><?php echo $this->Html->link('Vehículos', array('controller'=>'vehiculos','action' =>'index'));?></li>
			<li><?php echo $this->Html->link('Conceptos', array('controller'=>'conceptos','action' =>'index'));?></li>
			<li><?php echo $this->Html->link('Cuentas', array('controller'=>'cuentas','action' =>'index'));?></li>
			<li><?php echo $this->Html->link('Impuestos', array('controller'=>'impuestos','action' =>'index'));?></li>	
			<li><?php echo $this->Html->link('Empleados', array('controller'=>'empleados','action' =>'index'));?></li>
			<li><?php echo $this->Html->link('Usuarios', array('controller'=>'usuarios','action' =>'index'));?></li>	
		</ul>
	</li>
</ul>
</div>