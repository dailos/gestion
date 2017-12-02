<?php 
	echo $this->Form->create('Incidencia', array('inputDefaults' => array('label' => false,'div' => false)));
	echo $this->Form->hidden('empleado_id');
	echo $this->Form->hidden('id');
?>
<dl>	
	<dt class="separador">Descripción</dt>
		<dd><?php echo $this->Form->input('descripcion'); ?></dd>
	<dt class="separador">Fecha de inicio</dt>
		<dd> <?php echo $this->Form->input('fechainicio',array('dateFormat'=> 'DMY','timeFormat'=>null));?></dd>
	<dt class="separador">Fecha finalización</dt>
		<dd><?php echo $this->Form->input('fechafin',array('dateFormat'=> 'DMY','timeFormat'=>null)); ?></dd>	
	<dt class="separador">Tipo</dt>
		<dd> <?php echo $this->Form->input('tipo');?></dd>	
	<dt class="separador">Notas</dt>
		<dd> <?php echo $this->Form->input('notas');?></dd>		
</dl>
<?php echo $this->Form->end('Guardar');?>

