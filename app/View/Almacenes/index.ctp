<div class="title">
<?php echo $this->Html->image($icono, array('title'=>$titulo,'class'=>'imagentitulo')) ;?><h1><?php echo $titulo;?></h1>
	<div class="actions">
		<?php echo $this->Html->link($this->Html->image('add.png',array('title'=>'Crear nuevo')), array('action' => 'add'), array('escape' => false));?>		
	</div>
</div>

<div class="almacenes index">
	<table cellpadding="0" cellspacing="0">
	<tr>			
		<th><?php echo $this->Paginator->sort('nombre');?></th>
		<th><?php echo $this->Paginator->sort('ubicacion');?></th>
		<th><?php echo $this->Paginator->sort('notas');?></th>	
		<th>&nbsp;</th>	
	</tr>
	<?php
	$i = 0;
	foreach ($almacenes as $almacen):
		$i++;	
		echo $this->element('trclass',array('i' =>$i,'url' => 'view/'.$almacen['Almacen']['id']));	
	?>		
		<td><?php echo $almacen['Almacen']['nombre']; ?>&nbsp;</td>
		<td><?php echo $almacen['Almacen']['ubicacion']; ?>&nbsp;</td>
		<td><?php echo $almacen['Almacen']['notas']; ?>&nbsp;</td>		
		<td>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</table>	
<?php echo $this->element('pagination'); ?>

</div>
