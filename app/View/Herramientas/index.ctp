<div class="title">
<?php echo $this->Html->image($icono, array('title'=>$titulo,'class'=>'imagentitulo')) ;?><h1><?php echo $titulo;?></h1>
	<div class="actions">
		<?php echo $this->Html->link($this->Html->image('add.png',array('title'=>'Crear nuevo')), array('action' => 'add'), array('escape' => false));?>
	</div>
</div>

<div class="herramientas index">	
	<table cellpadding="0" cellspacing="0">
	<tr>	
		<th><?php echo $this->Paginator->sort('Nº de serie','nserie');?></th>
		<th><?php echo $this->Paginator->sort('nombre');?></th>
		<th><?php echo $this->Paginator->sort('Fecha de compra','fechacompra');?></th>
		<th><?php echo $this->Paginator->sort('almacen_id');?></th>
		<th><?php echo $this->Paginator->sort('Próxima revisión', 'revision');?></th>
		<th><?php echo $this->Paginator->sort('Próximo mantenimiento','mantenimiento');?></th>		
		<th><?php echo $this->Paginator->sort('Nota','notas');?></th>		
	</tr>
	<?php
	$i = 0;
	foreach ($herramientas as $herramienta):
		$i++;	
		echo $this->element('trclass',array('i' =>$i,'url' => 'view/'.$herramienta['Herramienta']['id']));	
	?>
		<td><?php echo $herramienta['Herramienta']['nserie']; ?>&nbsp;</td>
		<td><?php echo $herramienta['Herramienta']['nombre']; ?>&nbsp;</td>
		<td><?php echo $this->Format->date($herramienta['Herramienta']['fechacompra']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($herramienta['Almacen']['nombre'], array('controller' => 'almacenes', 'action' => 'view', $herramienta['Almacen']['id'])); ?>
		</td>
		<td><?php echo $this->Format->date($herramienta['Herramienta']['revision']); ?>&nbsp;</td>
		<td><?php echo $this->Format->date($herramienta['Herramienta']['mantenimiento']); ?>&nbsp;</td>	
		<td><?php echo $herramienta['Herramienta']['notas']; ?>&nbsp;</td>		
	</tr>
	<?php endforeach; ?>
	</table>
<?php echo $this->element('pagination'); ?>
</div>