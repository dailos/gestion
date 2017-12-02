<?php 
if(!empty($tajo['Tajo']['npresupuesto']) || !empty($tajo['Tajo']['factura_id']) ) $abierto = false;
else $abierto = true;
?>
<div class="title">
<?php echo $this->Html->image($icono, array('title'=>$titulo,'class'=>'imagentitulo')) ;?><h1><?php echo $titulo;?></h1>
	<div class="actions">
	<?php
	echo $this->Html->link($this->Html->image("back.png"), array('controller'=>'proyectos', 'action' => 'view',$tajo['Proyecto']['id']), array( 'escape' => false) );	
	if($abierto) echo $this->Js->link($this->Html->image('edit.png',array('title'=>'Editar')),array( 'action'=>'edit',$tajo['Tajo']['id']),array('escape'=>false,'update' => 'maindata'),null,false);	
	if (empty($tajo['Tajo']['factura_id'])){
		echo $this->Js->link($this->Html->image('importar.png',array('title'=>'Importar Tajo')),array('controller'=>'tajos', 'action'=>'import',$tajo['Tajo']['id']),array('escape'=>false,'update' => '#selectlist','htmlAttributes' => array('id' => 'linkaddtajo'),'evalScripts' => true),null,false);
		echo $this->Html->link($this->Html->image('ejecutar.png',array('title'=>'Facturar tajo')), array('controller' => 'facturas', 'action' => 'add',$tajo['Tajo']['id']), array('escape' => false));
		echo $this->Html->link($this->Html->image('del.png',array('title'=>'Eliminar')), array('action' => 'delete', $tajo['Tajo']['id']),array('escape' => false), sprintf('¿Seguro que desea eliminar el tajo, los datos asociados se perderán', $tajo['Tajo']['id']));
	}else echo $this->Html->image('cerrado.png');
	?>
	</div>	
</div>

<div class="tajos view" >
	<div id='maindata'>
	<?php if($edit) include_once '../View/Tajos/edit.ctp';
	else{
	?>
		<dl><?php $i = 0; $class = ' class="altrow"';?>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Proyecto'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $this->Html->link($tajo['Proyecto']['titulo'], array('controller' => 'proyectos', 'action' => 'view', $tajo['Proyecto']['id'])); ?>
				&nbsp;
			</dd>		
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Fecha'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $this->Format->date($tajo['Tajo']['fecha']);  ?>&nbsp;</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Descripción'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $tajo['Tajo']['descripcion']; ?>&nbsp;</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Empleados'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php 
				foreach ($tajo['Empleado'] as $empleado)
					echo $this->Html->link($empleado['nombre'], array('controller' => 'empleados', 'action' => 'view', $empleado['id'])) ." "; ?>&nbsp;</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?> ><?php echo __('Notas'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php echo $tajo['Tajo']['notas']; ?>&nbsp;</dd>			
			
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Factura'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php if (isset ($tajo['Factura']['nfactura'])) echo $this->Html->link($tajo['Factura']['nfactura'], array('controller' => 'facturas', 'action' => 'view', $tajo['Factura']['id'])) ; 
								 else echo $this->Html->image('no.png');?></dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Pre. relacionado'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>><?php if (isset ($tajo['Tajo']['npresupuesto'])) echo $this->Html->link($tajo['Tajo']['npresupuesto'], array ('action' => 'viewpresupuesto', $tajo['Tajo']['id'])) ; 
								 else echo $this->Html->image('no.png');?></dd>
			
		</dl>
		<?php echo $this->element('economicos',array('datoseconomicos'=>$datoseconomicos));?>		
	
	<?php }?>
	</div>
	

<?php 	echo $this->element('gestordocumental', array('documentos' =>$tajo['Documento'],'fk_name' => 'tajo_id','fk_id' =>$tajo['Tajo']['id']));?>
	
	
	<div id="tabscontent">
	    <div id="tabContent1" class="tabContent" style="display:yes;">  
    		<div class="titletab">Servicios
    		<div class="actionstabswithtitle">			
			 	<?php if($abierto) echo $this->Js->link($this->Html->image('add.png',array('title'=>'Crear nuevo')),array('controller'=>'servicios', 'action'=>'select',$tajo['Tajo']['id']),array('escape'=>false,'update' => '#selectlist','evalScripts' => true,'htmlAttributes' => array('id' => 'linkaddservice')),null,false);?>									
			</div>
    		</div>			
			
			<div class="tabcontendata">
				<table cellpadding = "0" cellspacing = "0">
				<tr>			
					<th><?php echo __('Nombre'); ?></th>
					<th><?php echo __('Cantidad'); ?></th>
					<th><?php echo __('Coste (u)'); ?></th>
					<th><?php echo __('Precio (u)'); ?></th>	
					<th><?php echo __('Impuesto 1'); ?></th>	
					<th><?php echo __('Impuesto 2'); ?></th>	
					<th><?php echo __('Descuento'); ?></th>
					<th><?php echo __('Subtotal'); ?></th>						
					<th><?php echo __('Notas'); ?></th>				
					<th class="actions"><?php if($abierto) echo __('Editar');?></th>				
					<th class="actions"><?php if($abierto) echo __('Eliminar');?></th>
				</tr>					
				<?php						
				if (!empty($tajo['Servicio'])):	
					$i = 0;
					foreach ($tajo['Servicio'] as $servicio):						
						$i++;
						echo $this->element('trclass',array('i' =>$i,'url' => '/servicios/view/'.$servicio['id']));						
						$servicio = $servicio['ServiciosTajo'];						
				?>									
						<td><?php echo $servicio['nombre'];?></td>
						<td><?php echo $servicio['cantidad'];?></td>
						<td><?php echo $this->Format->money($servicio['coste']);?></td>
						<td><?php echo $this->Format->money($servicio['precio']);?></td>	
						<td><?php echo $taxes[$servicio['impuesto1_id']]['nombre'];?></td>	
						<td><?php echo $taxes[$servicio['impuesto2_id']]['nombre'];?></td>
						<td><?php echo $servicio['pdescuento'].' %';?></td>	
						<td><?php echo $this->Format->money($servicio['cantidad']*$servicio['precio']);?></td>
						<td><?php echo $servicio['notas'];?></td>	
						<td><?php if($abierto) echo $this->Js->link($this->Html->image('edit.png',array('title'=>'Editar')),array('controller'=>'servicios_tajos', 'action'=>'edit',$servicio['id'],$servicio['tajo_id']),array('escape'=>false,'update' => 'selectservicio'),null,false);?></td>					
						<td><?php if($abierto) echo $this->Html->link($this->Html->image('minidel.png',array('title'=>'Eliminar')), array('controller' => 'servicios_tajos','action' =>'delete',$servicio['id'],$servicio['tajo_id']),array( 'escape' => false) );?></td>
					</tr>
				<?php endforeach;
					 endif; ?>
				</table>
				<div id="selectservicio"></div>								
			</div>
			
			<div class="titletab">Materiales<div class="actionstabswithtitle">			
				<?php if($abierto) echo $this->Js->link($this->Html->image('add.png',array('title'=>'Crear nuevo')), array('controller' => 'materiales', 'action' => 'select',$tajo['Tajo']['id'],'tajos'), array('escape' => false,'update' => '#selectlist','evalScripts' => true,'htmlAttributes' => array('id' => 'linkaddmaterial')),null,false);?>
				</div>
			</div>
					
			<div class="tabcontendata">
				<table cellpadding = "0" cellspacing = "0">
				<tr>
					<th><?php echo __('Nombre'); ?></th>
					<th><?php echo __('Cantidad'); ?></th>		
					<th><?php echo __('Coste (u)'); ?></th>
					<th><?php echo __('Precio (u)'); ?></th>
					<th><?php echo __('Impuesto 1'); ?></th>	
					<th><?php echo __('Impuesto 2'); ?></th>	
					<th><?php echo __('Descuento'); ?></th>
					<th><?php echo __('Subtotal'); ?></th>
					<th><?php echo __('Notas'); ?></th>
					<th class="actions"><?php if($abierto) echo __('Editar');?></th>	
					<th class="actions"><?php if($abierto) echo __('Eliminar');?></th>
				</tr>
				<?php		
					if (!empty($tajo['Material'])):	
						$i = 0;
						foreach ($tajo['Material'] as $material):													
							$i++;
							echo $this->element('trclass',array('i' =>$i,'url' => '/materiales/view/'.$material['id']));							
							$material = $material['MaterialesTajo'];																			
					?>									
						<td><?php echo $material['nombre'];?></td>
						<td><?php echo $material['cantidad'];?></td>				
						<td><?php echo $this->Format->money($material['coste']);?></td>
						<td><?php echo $this->Format->money($material['precio']);?></td>
						<td><?php echo $taxes[$material['impuesto1_id']]['nombre'];?></td>
						<td><?php echo $taxes[$material['impuesto2_id']]['nombre'];?></td>	
						<td><?php echo $material['pdescuento'].' %';?></td>
						<td><?php echo $this->Format->money($material['cantidad']*$material['precio'] ) ;?></td>
						<td><?php echo $material['notas'];?></td>
						<td><?php if($abierto) echo $this->Js->link($this->Html->image('edit.png',array('title'=>'Editar')),array('controller'=>'materiales_tajos', 'action'=>'edit',$material['id'],$tajo['Tajo']['id']),array('escape'=>false,'update' => 'selectmaterial'),null,false);?></td>						
						<td><?php if($abierto) echo $this->Html->link($this->Html->image('minidel.png',array('title'=>'Eliminar')), array('controller' => 'materiales_tajos','action' =>'delete',$material['id'],$tajo['Tajo']['id']),array( 'escape' => false) );?></td>
					</tr>
					<?php endforeach; 		
				 		endif; ?>
				</table>
				<div id="selectmaterial"></div>
			</div>			
	   </div>
	    <?php echo $this->element('sinimpuestos',array('sinimpuestos'=>$datoseconomicos['sinimpuestos']));?>	   
	</div>
</div>
<?php 	
	echo $this->Js->get('#linkaddservice')->event('click','ocultardoc()');	
	echo $this->Js->get('#linkaddmaterial')->event('click','ocultardoc()');		
	echo $this->Js->get('#linkaddtajo')->event('click','ocultardoc()');	
?>
