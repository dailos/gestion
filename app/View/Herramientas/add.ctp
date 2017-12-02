<div class="title">
<?php echo $this->Html->image($icono, array('title'=>$titulo,'class'=>'imagentitulo')) ;?><h1><?php echo $titulo;?></h1>
</div>
<div class="herramientas form">
<?php echo $this->Form->create('Herramienta', array('inputDefaults' => array('label' => false,'div' => false)));?>
<dl>
	<dt class="separador">Nombre</dt>
		<dd><?php echo $this->Form->input('nombre'); ?></dd>
	<dt class="separador">Nº de serie</dt>
		<dd><?php echo $this->Form->input('nserie'); ?></dd>
	<dt class="separador">Compra</dt>
		<dd> <?php echo $this->Form->input('fechacompra',array('dateFormat'=> 'DMY','timeFormat'=>null));?></dd>
	<dt class="separador">Almacén</dt>
		<dd><?php echo $this->Form->input('almacen_id'); ?></dd>	
	<dt class="separador">Próx. revisión</dt>
		<dd> <?php echo $this->Form->input('revision');?></dd>
	<dt class="separador">Próx. manten.</dt>
		<dd> <?php echo $this->Form->input('mantenimiento');?></dd>	
	<dt class="separador">Nota</dt>
		<dd> <?php echo $this->Form->input('notas');?></dd>	
</dl>
<?php echo $this->Form->end('Guardar');?>
</div>
