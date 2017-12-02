<div class="title">
<?php echo $this->Html->image($icono, array('title'=>$titulo,'class'=>'imagentitulo')) ;?><h1><?php echo $titulo;?></h1>
	<div class="actions">
		<?php echo $this->Html->link($this->Html->image('add.png',array('title'=>'Crear nuevo')), array('action' => 'add'), array('escape' => false));?>
	</div>
</div>


<div class="empleados index">	
	<table cellpadding="0" cellspacing="0">
	<tr>	
		<th><?php echo $this->Paginator->sort('nombre');?></th>
		<th><?php echo $this->Paginator->sort('apellidos');?></th>
		<th><?php echo $this->Paginator->sort('cargo');?></th>
		<th><?php echo $this->Paginator->sort('Teléfono','telefono');?></th>
		<th><?php echo $this->Paginator->sort('Móvil','movil');?></th>
		<th><?php echo $this->Paginator->sort('E-mail','email');?></th>
		<th><?php echo $this->Paginator->sort('horario');?></th>
		<th><?php echo $this->Paginator->sort('Coste mensual','costexmes');?></th>
		<th><?php echo $this->Paginator->sort('Horas mensuales', 'horasxmes');?></th>
		<th><?php echo $this->Paginator->sort('Fecha de contratación', 'fechacontratacion');?></th>
		<th><?php echo $this->Paginator->sort('notas');?></th>			
	</tr>
	<?php
	$i = 0;
	foreach ($empleados as $empleado):
		$i++;	
		echo $this->element('trclass',array('i' =>$i,'url' => 'view/'.$empleado['Empleado']['id']));	
	?>
		<td><?php echo $empleado['Empleado']['nombre']; ?>&nbsp;</td>
		<td><?php echo $empleado['Empleado']['apellidos']; ?>&nbsp;</td>
		<td><?php echo $empleado['Empleado']['cargo']; ?>&nbsp;</td>
		<td><?php echo $empleado['Empleado']['telefono']; ?>&nbsp;</td>
		<td><?php echo $empleado['Empleado']['movil']; ?>&nbsp;</td>
		<td><?php echo $empleado['Empleado']['email']; ?>&nbsp;</td>
		<td><?php echo $empleado['Empleado']['horario']; ?>&nbsp;</td>
		<td><?php echo $empleado['Empleado']['costexmes']; ?>&nbsp;</td>
		<td><?php echo $empleado['Empleado']['horasxmes']; ?>&nbsp;</td>
		<td><?php echo $this->Format->date($empleado['Empleado']['fechacontratacion']); ?>&nbsp;</td>
		<td><?php echo $empleado['Empleado']['notas']; ?>&nbsp;</td>		
	</tr>
	<?php endforeach; ?>
	</table>
	<?php echo $this->element('pagination'); ?>
</div>