<?php
echo $this->Form->create('Albaran', array('action' => 'edit','inputDefaults' => array('label' => false,'div' => false)));
echo $this->Form->input('id');
echo $this->Form->hidden('gasto_id');
echo $this->Form->hidden('empresa_id');
echo $this->Form->hidden('referencia');
?>
<dl>
	<dt class="separador">Nº Albarán</dt>
		<dd><?php echo $this->Form->input('nalbaran'); ?></dd>	
	<dt class="separador">Descripción</dt>
		<dd> <?php echo $this->Form->input('descripcion');?></dd>
	<dt class="separador">Fecha</dt>
		<dd> <?php echo $this->Form->input('fecha',array('dateFormat'=> 'DMY','timeFormat'=>null));?></dd>
	<dt class="separador">Notas</dt>
		<dd> <?php echo $this->Form->input('notas');?></dd>		
</dl>
<?php echo $this->Form->end('Guardar');?>
