<?php 
$sistema = false;
if ($servicio['Servicio']['id'] == SISTEMA) $sistema = true;	
foreach ($tajos as $value){
	if(!empty($value['Tajo']['referencia'])) $taj[] = $value;
	if(!empty($value['Tajo']['npresupuesto'])) $pre[] = $value;		 
}	
?>

<div class="title">
<?php echo $this->Html->image($icono, array('title'=>$titulo,'class'=>'imagentitulo')) ;?><h1><?php echo $titulo;?></h1>
	<div class="actions">
	<?php
	echo $this->Html->link($this->Html->image("back.png"), array( 'action' => 'index'), array( 'escape' => false) );
	if(!$sistema){
		echo $this->Js->link($this->Html->image('edit.png',array('title'=>'Editar')),array( 'action'=>'edit',$servicio['Servicio']['id']),array('escape'=>false,'update' => 'maindata'),null,false);
		echo $this->Html->link($this->Html->image('del.png',array('title'=>'Eliminar')), array('action' => 'delete', $servicio['Servicio']['id']),array('escape' => false), sprintf('¿Seguro que desea eliminar el servicio?',$servicio['Servicio']['id']));
	}
	?>
	</div>	
</div>

<div class="servicios view">
	<div id="maindata">
	<?php if(!$sistema):?>	
	<dl><?php $i = 0; $class = ' class="altrow"';?>	
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Precio'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Format->money($servicio['Servicio']['precio']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Coste'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Format->money($servicio['Servicio']['coste']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Notas'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $servicio['Servicio']['notas']; ?>
			&nbsp;
		</dd>
	</dl>
	<?php  endif;?>
	</div>

<?php 	echo $this->element('gestordocumental', array('documentos' =>$servicio['Documento'],'fk_name' => 'servicio_id','fk_id' =>$servicio['Servicio']['id']));?>
	<div id="tabs">
	    <ul>
	        <li id="tabHeaderActive"><a href="javascript:void(0)" onClick="toggleTab(1,2)"><span>Tajos</span></a></li>	 
	         <li id="tabHeader2"><a href="javascript:void(0)" onClick="toggleTab(2,2)" ><span>Presupuestos</span></a></li>          
	    </ul>
	</div>

	<div id="tabscontent">
	    <div id="tabContent1" class="tabContent" style="display:yes;">    						
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
				foreach ($taj as $serviciosTajo):
					$i++;
					echo $this->element('trclass',array('i' =>$i,'url' => '/tajos/view/'.$serviciosTajo['Tajo']['id']));
				?>		
					<td><?php echo $serviciosTajo['Tajo']['referencia'];?></td>			
					<td><?php echo $this->Html->link($serviciosTajo['Proyecto']['titulo'], '/proyectos/view/'.$serviciosTajo['Proyecto']['id']) ;?></td>
					<td><?php echo $this->Format->date($serviciosTajo['Tajo']['fecha']);?></td>													
					<td><?php echo $serviciosTajo['ServiciosTajo']['cantidad'];?></td>	
					
					<?php if($sistema):?>		
					<td><?php echo $serviciosTajo['nombre'];?></td>
					<td style="text-align:right;"><?php echo $this->Format->money($serviciosTajo['coste']);?></td>
					<td style="text-align:right;"><?php echo $this->Format->money($serviciosTajo['precio']);?></td>
					<?php endif;?>																
					</tr>
				<?php endforeach; ?>
				</table>	
				<?php else: echo "<h2>No existen tajos asociados</h2>";endif; ?>
			</div>
		</div>
		
		<div id="tabContent2" class="tabContent" style="display:none;">    							
			<div class="tabcontendata">
				<?php if (!empty($pre)):?>
				<table cellpadding = "0" cellspacing = "0">
				<tr>										
					<th><?php echo __('Presupuesto'); ?></th>
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
				foreach ($pre as $serviciosPresupuesto):
					$i++;
					echo $this->element('trclass',array('i' =>$i,'url' => '/tajos/viewpresupuesto/'.$serviciosPresupuesto['Tajo']['id']));
				?>															
						<td><?php echo $serviciosPresupuesto['Tajo']['npresupuesto'];?></td>
						<td><?php echo $this->Html->link($serviciosPresupuesto['Proyecto']['titulo'], '/proyectos/view/'.$serviciosPresupuesto['Proyecto']['id']) ;?></td>						
						<td><?php echo $this->Format->date($serviciosPresupuesto['Tajo']['fecha']);?></td>														
						<td><?php echo $serviciosPresupuesto['ServiciosTajo']['cantidad'];?></td>	
						
						<?php if($sistema):?>		
						<td><?php echo $serviciosPresupuesto['nombre'];?></td>
						<td style="text-align:right;"><?php echo $this->Format->money($serviciosPresupuesto['coste']);?></td>
						<td style="text-align:right;"><?php echo $this->Format->money($serviciosPresupuesto['precio']);?></td>
						<?php endif;?>					
																
					</tr>
				<?php endforeach; ?>
				</table>
				<?php else: echo "<h2>No existen presupuestos asociados</h2>";endif; ?>
			</div>
		</div>
	</div>
</div>