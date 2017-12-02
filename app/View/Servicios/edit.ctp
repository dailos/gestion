<?php
echo $this->Form->create('Servicio', array('inputDefaults' => array('label' => false,'div' => false)));
echo $this->Form->input('id');
?>
<dl>
	<dt class="separador">Nombre</dt>
		<dd><?php echo $this->Form->input('nombre'); ?></dd>
	<dt class="separador">Precio</dt>
		<dd> <?php echo $this->Form->input('precio');?></dd>
	<dt class="separador">coste</dt>
		<dd> <?php echo $this->Form->input('coste');?></dd>
	<dt class="separador">Notas</dt>
		<dd> <?php echo $this->Form->input('notas');?></dd>	
</dl>
<?php echo $this->Form->end('Guardar');?>

