<?php
echo $this->Form->create('Cuenta', array('inputDefaults' => array('label' => false,'div' => false)));
echo $this->Form->input('id');
?>
<dl>
	<dt class="separador">Nombre</dt>
		<dd><?php echo $this->Form->input('nombre'); ?></dd>
	<dt class="separador">ccc</dt>
		<dd> <?php echo $this->Form->input('ccc');?></dd>	
	<dt class="separador">Notas</dt>
		<dd> <?php echo $this->Form->input('notas');?></dd>	
</dl>
<?php echo $this->Form->end('Guardar');?>
