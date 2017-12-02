<div class="title">
<?php echo $this->Html->image($icono, array('title'=>$titulo,'class'=>'imagentitulo')) ;?><h1><?php echo $titulo;?></h1>
</div>
<div class="materiales form">
<?php echo $this->Form->create('Material', array('inputDefaults' => array('label' => false,'div' => false)));?>
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
</div>
