<div class="title">
<?php echo $this->Html->image($icono, array('title'=>$titulo,'class'=>'imagentitulo')) ;?><h1><?php echo $titulo;?></h1>	
<div class="actions">
	<?php
	echo $this->Html->link($this->Html->image("back.png"), array('action' => 'index'), array( 'escape' => false) );	
	?>
	</div>	
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
			<dd> <?php echo $this->Form->input('cantidad');?></dd>					
		<dt class="separador">Cuenta origen</dt>
			<dd> <?php echo $this->Form->input('cuenta_origen', array('options' => $cuentas));?></dd>			
		<dt class="separador">Cuenta destino</dt>
			<dd> <?php echo $this->Form->input('cuenta_destino', array('options' => $cuentas));?></dd>						
		<dt class="separador">Notas</dt>
			<dd> <?php echo $this->Form->input('notas');?></dd>	
	</dl>
<?php echo $this->Form->end('Guardar');?>
</div>
