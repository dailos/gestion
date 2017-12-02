<?php if(!$filtrado):?>
<div class="title">
<?php echo $this->Html->image($icono, array('title'=>$titulo,'class'=>'imagentitulo')) ;?><h1><?php echo $titulo;?></h1>	
	<div class="actions">
		<?php echo $this->Html->link($this->Html->image('add.png',array('title'=>'Crear nuevo')), array('action' => 'add'), array('escape' => false));?>	
	</div>	
	<?php echo $this->element('filtro',array('model' =>'Material'));?>
</div>


<div id="filtrado" class="materiales index">
<?php endif;?>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('nombre');?></th>
			<th><?php echo $this->Paginator->sort('cantidad','Cantidad en stock');?></th>
			<th><?php echo $this->Paginator->sort('almacen_id','Almacén');?></th>
			<th style="text-align:right;"><?php echo $this->Paginator->sort('coste','Coste unitario');?></th>
			<th style="text-align:right;"><?php echo $this->Paginator->sort('precio','Precio unitario');?></th>
			<th><?php echo $this->Paginator->sort('fecha','Actualizado');?></th>	
			<th><?php echo $this->Paginator->sort('notas');?></th>			
	</tr>
	<?php
	$i = 0;
	foreach ($materiales as $material):
		if($material['Material']['id'] != SISTEMA):
			$i++;	
			echo $this->element('trclass',array('i' =>$i,'url' => 'view/'.$material['Material']['id']));	
			
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
			<td><?php echo $material['Material']['nombre']; ?>&nbsp;</td>
			<td><?php echo $material['Material']['cantidad']; ?>&nbsp;</td>
			<td><?php echo $this->Html->link($material['Almacen']['nombre'], array('controller' => 'almacenes', 'action' => 'view', $material['Almacen']['id'])); ?></td>
			<td style="text-align:right;"><?php echo $this->Format->money($material['Material']['coste']); ?>&nbsp;</td>
			<td style="text-align:right;"><?php echo $this->Format->money($material['Material']['precio']); ?>&nbsp;</td>
			<td <?php if($months > 3) echo  "class='estado3'";?>><?php echo 'Hace '. $months ;		
					if($months != 1) echo ' meses' ; else echo ' mes';?>&nbsp;</td>	
			<td><?php echo $material['Material']['notas']; ?>&nbsp;</td>		
		</tr>
		<?php endif; 
	endforeach; ?>
	</table>
<?php echo $this->element('pagination'); ?>
<?php if(!$filtrado):?>
</div>
<?php endif;?>