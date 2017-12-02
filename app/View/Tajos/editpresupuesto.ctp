<?php
echo $this->Form->create('Tajo', array('inputDefaults' => array('label' => false,'div' => false)));
echo $this->Form->input('id');
echo $this->Form->hidden('proyecto_id');
?>
<dl>	
	<dt class="separador">Descripción</dt>
		<dd><?php echo $this->Form->input('descripcion'); ?></dd>
	<dt class="separador">Fecha</dt>
		<dd> <?php echo $this->Form->input('fecha',array('dateFormat'=> 'DMY','timeFormat'=>null));?></dd>	
	<dt class="separador">Notas</dt>
		<dd> <?php echo $this->Form->input('notas');?></dd>
</dl>
<?php echo $this->Form->end('Guardar');?>

