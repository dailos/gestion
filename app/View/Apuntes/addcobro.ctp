<div class="title">
<?php echo $this->Html->image($icono, array('title'=>$titulo,'class'=>'imagentitulo')) ;?><h1><?php echo $titulo;?></h1>
</div>
<div class="cobros form">
<?php echo $this->Form->create('Apunte', array('inputDefaults' => array('label' => false,'div' => false)));?>
<dl>
	<dt class="separador">Fecha</dt>
		<dd> <?php echo $this->Form->input('fecha',array('dateFormat'=> 'DMY','timeFormat'=>null));?></dd>	
	<dt class="separador">Descripción</dt>
		<dd><?php echo $this->Form->input('descripcion'); ?></dd>
	<dt class="separador">Referencia</dt>
		<dd> <?php echo $this->Form->input('referencia');?></dd>	
	<dt class="separador">Cantidad</dt>
		<dd> <?php echo $this->Form->input('cantidad',array('value'=>$cantidad));?></dd>			
	<dt class="separador">Cuenta</dt>
		<dd> <?php echo $this->Form->input('cuenta_id');?></dd>	
	<dt class="separador">Método de pago</dt>
		<dd> <?php echo $this->Form->input('metodo_id',array('options' => $metodospago));?></dd>		
	<dt class="separador">Notas</dt>
		<dd> <?php echo $this->Form->input('notas');?></dd>	
</dl>
<?php 
	echo $this->Form->hidden('factura_id',array('value'=>$factura_id));
	echo $this->Form->end('Guardar');
?>
</div>
