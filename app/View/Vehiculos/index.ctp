<div class="title">
<?php echo $this->Html->image($icono, array('title'=>$titulo,'class'=>'imagentitulo')) ;?><h1><?php echo $titulo;?></h1>
	<div class="actions">
		<?php echo $this->Html->link($this->Html->image('add.png',array('title'=>'Crear nuevo')), array('action' => 'add'), array('escape' => false));?>
	</div>
</div>


<div class="vehiculos index">	
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('matricula','Matrícula');?></th>
			<th><?php echo $this->Paginator->sort('marca');?></th>
			<th><?php echo $this->Paginator->sort('modelo');?></th>
			<th><?php echo $this->Paginator->sort('matriculacion','Fecha Matriculación');?></th>
			<th><?php echo $this->Paginator->sort('itv','Próxima ITV');?></th>
			<th><?php echo $this->Paginator->sort('revisionkm','Próxima Revisión');?></th>
			<th><?php echo $this->Paginator->sort('aceitekm','Cambio aceite');?></th>
			<th><?php echo $this->Paginator->sort('km','Kms');?></th>		
			<th><?php echo $this->Paginator->sort('notas','Nota');?></th>			
	</tr>
	<?php
	$i = 0;
	foreach ($vehiculos as $vehiculo):
		$i++;	
		echo $this->element('trclass',array('i' =>$i,'url' => 'view/'.$vehiculo['Vehiculo']['id']));	
	?>
		<td><?php echo $vehiculo['Vehiculo']['matricula']; ?>&nbsp;</td>
		<td><?php echo $vehiculo['Vehiculo']['marca']; ?>&nbsp;</td>
		<td><?php echo $vehiculo['Vehiculo']['modelo']; ?>&nbsp;</td>
		<td><?php echo $this->Format->date($vehiculo['Vehiculo']['matriculacion']); ?>&nbsp;</td>
		<td><?php echo $this->Format->date($vehiculo['Vehiculo']['itv']); ?>&nbsp;</td>
		<td><?php echo $vehiculo['Vehiculo']['revisionkm']; ?>&nbsp;</td>
		<td><?php echo $vehiculo['Vehiculo']['aceitekm']; ?>&nbsp;</td>
		<td><?php echo $vehiculo['Vehiculo']['km']; ?>&nbsp;</td>		
		<td><?php echo $vehiculo['Vehiculo']['notas']; ?>&nbsp;</td>		
	</tr>
	<?php endforeach; ?>
	</table>
	<?php echo $this->element('pagination'); ?>
</div>