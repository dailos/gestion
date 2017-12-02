<?php echo $this->Form->create('Factura', array('action' => 'edit','inputDefaults' => array('label' => false,'div' => false)));?>
<dl>
	<dt class="separador">Descripcion</dt>
		<dd><?php echo $this->Form->input('descripcion'); ?></dd>
	<dt class="separador">Fecha</dt>
		<dd> <?php echo $this->Form->input('fecha',array('dateFormat'=> 'DMY','timeFormat'=>null));?></dd>			
	<dt class="separador">Previsión de cobro</dt>
		<dd> <?php echo $this->Form->input('prevcobro',array('dateFormat'=> 'DMY','timeFormat'=>null));?></dd>	
	<dt class="separador">Notas</dt>
		<dd> <?php echo $this->Form->input('notas');?></dd>	
</dl>
<?php
echo $this->Form->hidden('nfactura'); 
echo $this->Form->hidden('proyecto_id'); 
echo $this->Form->hidden('id');
echo $this->Form->hidden('nfactura');
echo $this->Form->hidden('total');
echo $this->Form->end('Guardar');
?>

