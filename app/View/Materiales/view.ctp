<div class="title">
<?php echo $this->Html->image($icono, array('title'=>$titulo,'class'=>'imagentitulo')) ;?><h1><?php echo $titulo;?></h1>
	<div class="actions">
	<?php
	echo $this->Html->link($this->Html->image("back.png"), array('action' => 'index'), array( 'escape' => false) );
	if($material['Material']['id'] != SISTEMA){
		echo $this->Js->link($this->Html->image('edit.png',array('title'=>'Editar')),array( 'action'=>'edit', $material['Material']['id']),array('escape'=>false,'update' => 'maindata'),null,false);
		echo $this->Html->link($this->Html->image('del.png',array('title'=>'Eliminar')), array('action' => 'delete',  $material['Material']['id']),array('escape' => false), sprintf('¿Seguro que desea eliminar el material?', $material['Material']['id']));
	}
	?>
	</div>	
</div>
<?php 
$sistema = false;
if ($material['Material']['id'] == SISTEMA) $sistema = true;	
foreach ($albaranes as $value){
	if(!empty($value['Albaran']['referencia'])) $alb[] = $value;
	if(!empty($value['Albaran']['npedido'])) $ped[] = $value;
}
foreach ($tajos as $value){
	if(!empty($value['Tajo']['referencia'])) $taj[] = $value;
	if(!empty($value['Tajo']['npresupuesto'])) $pre[] = $value;		 
}	

$years= date("Y", strtotime("now")) - date('Y',strtotime($material['Material']['fecha'])); 								
switch ($years){
	case 0:
		$months = date ("n", strtotime("now")) - date ("n", strtotime($material['Material']['fecha'])); 
		break;
	case 1:
		$months = 12 - date ("n", strtotime($material['Material']['fecha'])) + (date ("m")); 
		break;
	default:
		$months = ($years*12) + (date ("m", strtotime("now")) - date ("m", strtotime($material['Material']['fecha']))); 							 
}
?>
<div class="materiales view">
	<div id='maindata'>
	<?php if(!$sistema):?>	
		<dl><?php $i = 0; $class = ' class="altrow"';?>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Cantidad en stock'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $material['Material']['cantidad']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Almacén'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $this->Html->link($material['Almacen']['nombre'], array('controller' => 'almacenes', 'action' => 'view', $material['Almacen']['id'])); ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Coste unitario'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $this->Format->money($material['Material']['coste']); ?>
				&nbsp;
			</dd>			
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Precio unitario'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $this->Format->money($material['Material']['precio']); ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Actualización'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php  echo 'Hace '. $months ;		
					if($months != 1) echo ' meses' ; else echo ' mes';?> 
				&nbsp;
			</dd>						
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Notas'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $material['Material']['notas']; ?>
				&nbsp;
			</dd>
		</dl>
	<?php  endif;?>
	</div>
<?php 	echo $this->element('gestordocumental', array('documentos' =>$material['Documento'],'fk_name' => 'material_id','fk_id' =>$material['Material']['id']));?>
	
	<div id="tabs">
	    <ul>
	        <li id="tabHeaderActive"><a href="javascript:void(0)" onClick="toggleTab(1,4)"><span>Pedidos</span></a></li>
	        <li id="tabHeader2"><a href="javascript:void(0)" onClick="toggleTab(2,4)" ><span>Albaranes</span></a></li>     
	        <li id="tabHeader3"><a href="javascript:void(0)" onClick="toggleTab(3,4)" ><span>Tajos</span></a></li>  
	        <li id="tabHeader4"><a href="javascript:void(0)" onClick="toggleTab(4,4)" ><span>Presupuestos</span></a></li>        
	    </ul>
	</div>
	
	<div id="tabscontent">
	    <div id="tabContent1" class="tabContent" style="display:yes;">    						
			<div class="tabcontendata">
				<?php if (!empty($ped)):?>
				<table cellpadding = "0" cellspacing = "0">
				<tr>								
					<th><?php echo __('Nº Pedido'); ?></th>							
					<th><?php echo __('Fecha'); ?></th>
					<th><?php echo __('Cantidad'); ?></th>
										
				</tr>
				<?php			
				$i = 0;
				foreach ($ped as $pedido):
					$i++;
					echo $this->element('trclass',array('i' =>$i,'url' => '/albaranes/viewpedido/'.$pedido['Albaran']['id']));
				?>			
						<td><?php echo $pedido['Albaran']['npedido'];?></td>
						<td><?php echo date("d-m-Y",strtotime($pedido['Albaran']['fecha']));?></td>															
						<td><?php echo $pedido['AlbaranesMaterial']['cantidad'];?></td>						
					</tr>
				<?php endforeach; ?>
				</table>
				<?php else: echo "<h2>No existen pedidos asociados</h2>";endif; ?>
			</div>
		</div>
		
		<div id="tabContent2" class="tabContent" style="display:none;">    						
			<div class="tabcontendata">
				<?php if (!empty($alb)):?>
				<table cellpadding = "0" cellspacing = "0">
				<tr>	
					<th><?php echo __('Referencia'); ?></th>	
					<th><?php echo __('Nº Albarán'); ?></th>							
					<th><?php echo __('Fecha'); ?></th>												
					<th><?php echo __('Cantidad'); ?></th>					
				</tr>
				<?php			
				$i = 0;
				foreach ($alb as $albaran):
					$i++;
					echo $this->element('trclass',array('i' =>$i,'url' => '/albaranes/view/'.$albaran['Albaran']['id']));
				?>					
					<td><?php echo $albaran['Albaran']['referencia'];?></td>
					<td><?php echo $albaran['Albaran']['nalbaran'];?></td>
					<td><?php echo date("d-m-Y",strtotime($albaran['Albaran']['fecha']));?></td>																
					<td><?php echo $albaran['AlbaranesMaterial']['cantidad'];?></td>						
				</tr>
				<?php endforeach; ?>
				</table>
				<?php else: echo "<h2>No existen albaranes asociados</h2>";endif; ?>
			</div>
		</div>
		
		<div id="tabContent3" class="tabContent" style="display:none;">    							
			<div class="tabcontendata">
				<?php if (!empty($taj)):?>
				<table cellpadding = "0" cellspacing = "0">
				<tr>										
					<th><?php echo __('Tajo'); ?></th>
					<th><?php echo __('Proyecto'); ?></th>					
					<th><?php echo __('Fecha'); ?></th>				
					<th><?php echo __('Cantidad'); ?></th>	
				<?php if($sistema):?>		
					<th><?php echo __('Nombre'); ?></th>
					<th style="text-align:right;"><?php echo __('Coste'); ?></th>
					<th style="text-align:right;"><?php echo __('Precio'); ?></th>		
				<?php endif;?>					
				
				</tr>
				<?php			
				$i = 0;
				foreach ($taj as $materialesTajo):
					$i++;
					echo $this->element('trclass',array('i' =>$i,'url' => '/tajos/view/'.$materialesTajo['Tajo']['id']));
				?>															
						<td><?php echo $materialesTajo['Tajo']['referencia'];?></td>
						<td><?php echo $this->Html->link($materialesTajo['Proyecto']['titulo'], '/proyectos/view/'.$materialesTajo['Proyecto']['id']) ;?></td>						
						<td><?php echo date("d-m-Y",strtotime($materialesTajo['Tajo']['fecha']));?></td>														
						<td><?php echo $materialesTajo['MaterialesTajo']['cantidad'];?></td>	
						
						<?php if($sistema):?>		
						<td><?php echo $materialesTajo['nombre'];?></td>
						<td style="text-align:right;"><?php echo $this->Format->money($materialesTajo['coste']);?></td>
						<td style="text-align:right;"><?php echo $this->Format->money($materialesTajo['precio']);?></td>
						<?php endif;?>																					
					</tr>
				<?php endforeach; ?>
				</table>
				<?php else: echo "<h2>No existen tajos asociados</h2>";endif; ?>
			</div>
		</div>
		
		<div id="tabContent4" class="tabContent" style="display:none;">    							
			<div class="tabcontendata">
				<?php if (!empty($pre)):?>
				<table cellpadding = "0" cellspacing = "0">
				<tr>										
					<th><?php echo __('Tajo'); ?></th>
					<th><?php echo __('Proyecto'); ?></th>					
					<th><?php echo __('Fecha'); ?></th>					
					<th><?php echo __('Cantidad'); ?></th>	
				<?php if($sistema):?>		
					<th><?php echo __('Nombre'); ?></th>
					<th style="text-align:right;"><?php echo __('Coste'); ?></th>
					<th style="text-align:right;"><?php echo __('Precio'); ?></th>		
				<?php endif;?>
								
				</tr>
				<?php			
				$i = 0;
				foreach ($pre as $materialesPresupuesto):
					$i++;
					echo $this->element('trclass',array('i' =>$i,'url' => '/tajos/view/'.$materialesPresupuesto['Tajo']['id']));
				?>															
						<td><?php echo $materialesPresupuesto['Tajo']['npresupuesto'];?></td>
						<td><?php echo $this->Html->link($materialesPresupuesto['Proyecto']['titulo'], '/proyectos/view/'.$materialesPresupuesto['Proyecto']['id']) ;?></td>						
						<td><?php echo date("d-m-Y",strtotime($materialesPresupuesto['Tajo']['fecha']));?></td>														
						<td><?php echo $materialesPresupuesto['MaterialesTajo']['cantidad'];?></td>	
						
						<?php if($sistema):?>		
						<td><?php echo $materialesPresupuesto['nombre'];?></td>
						<td style="text-align:right;"><?php echo $this->Format->money($materialesPresupuesto['coste']);?></td>
						<td style="text-align:right;"><?php echo $this->Format->money($materialesPresupuesto['precio']);?></td>
						<?php endif;?>					
																
					</tr>
				<?php endforeach; ?>
				</table>
				<?php else: echo "<h2>No existen presupuestos asociados</h2>";endif; ?>
			</div>
		</div>
		
	</div>
</div>