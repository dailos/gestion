<div class="title">
<?php echo $this->Html->image($icono, array('title'=>$titulo,'class'=>'imagentitulo')) ;?><h1><?php echo $titulo;?></h1>
</div>
<div class="almacen form">
<?php echo $this->Form->create('Almacen', array('inputDefaults' => array('label' => false,'div' => false)));?>
<dl>
	<dt class="separador">Nombre</dt>
		<dd><?php echo $this->Form->input('nombre'); ?></dd>
	<dt class="separador">Ubicación</dt>
		<dd> <?php echo $this->Form->input('ubicacion');?></dd>
	<dt class="separador">Notas</dt>
		<dd> <?php echo $this->Form->input('notas');?></dd>	
</dl>
<?php echo $this->Form->end('Guardar');?>
</div>