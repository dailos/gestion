<?php
echo $this->Form->create('Material', array('inputDefaults' => array('label' => false,'div' => false)));
echo $this->Form->input('id');
?>
<dl>
	<dt class="separador">Nombre</dt>
		<dd><?php echo $this->Form->input('nombre'); ?></dd>
	<dt class="separador">Cantidad en stock</dt>
		<dd> <?php echo $this->Form->input('cantidad');?></dd>
	<dt class="separador">Almacén</dt>
		<dd><?php echo $this->Form->input('almacen_id'); ?></dd>	
	<dt class="separador">Coste unitario</dt>
		<dd> <?php echo $this->Form->input('coste');?></dd>
	<dt class="separador">Precio unitario</dt>
		<dd><?php echo $this->Form->input('precio'); ?></dd>	
	<dt class="separador">Notas</dt>
		<dd> <?php echo $this->Form->input('notas');?></dd>		
</dl>
<?php echo $this->Form->end('Guardar');?>
