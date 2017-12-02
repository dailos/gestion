
<?php echo $this->Form->create('Usuario', array('inputDefaults' => array('label' => false,'div' => false))); ?>
<table cellpadding="0" cellspacing="0">
<tr>
	<th>Usuario</th>
	<th>Clave</th>
	<th>Nombre</th>
	<th>Apellidos</th>
	<th>Email</th>
</tr>
<tr>
	<td><?php echo $this->Form->input('username');?></td>
	<td><?php echo $this->Form->input('password');?></td>
	<td><?php echo $this->Form->input('nombre');?></td>
	<td><?php echo $this->Form->input('apellidos');?></td>
	<td><?php echo $this->Form->input('email');	?></td>
	<td><?php echo $this->Form->submit('add.png',array('title'=>'Crear nuevo'),array('div' =>false));?></td>
</tr></table>
<?php $this->Form->end();?>
