<?php if(!$filtrado):?>
<div class="title">
<?php echo $this->Html->image($icono, array('title'=>$titulo,'class'=>'imagentitulo')) ;?><h1><?php echo $titulo;?></h1>	
	<div class="actions">
		<?php echo $this->Html->link($this->Html->image('add.png',array('title'=>'Crear nuevo')), array('action' => 'add'), array('escape' => false));?>	
	</div>	
	<?php echo $this->element('filtro',array('model' =>'Servicio'));?>
</div>


<div id="filtrado" class="servicios index">
<?php endif;?>
	<table cellpadding="0" cellspacing="0">
	<tr>			
			<th><?php echo $this->Paginator->sort('nombre');?></th>
			<th style="text-align:right;"><?php echo $this->Paginator->sort('precio');?></th>
			<th style="text-align:right;"><?php echo $this->Paginator->sort('coste');?></th>
			<th><?php echo $this->Paginator->sort('notas');?></th>		
	</tr>
	<?php
	$i = 0;
	foreach ($servicios as $servicio):
		if($servicio['Servicio']['id'] != SISTEMA):
			$i++;	
			echo $this->element('trclass',array('i' =>$i,'url' => 'view/'.$servicio['Servicio']['id']));	
		?>		
			<td><?php echo $servicio['Servicio']['nombre']; ?>&nbsp;</td>
			<td style="text-align:right;"><?php echo $this->Format->money($servicio['Servicio']['precio']); ?>&nbsp;</td>
			<td style="text-align:right;"><?php echo $this->Format->money($servicio['Servicio']['coste']); ?>&nbsp;</td>
			<td><?php echo $servicio['Servicio']['notas']; ?>&nbsp;</td>
		</tr>
		<?php endif; 
	endforeach; ?>
	</table>	
	<?php echo $this->element('pagination'); ?>
<?php if(!$filtrado):?>
</div>
<?php endif;?>