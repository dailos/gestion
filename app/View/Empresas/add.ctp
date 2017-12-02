<div class="title">
<?php echo $this->Html->image($icono, array('title'=>$titulo,'class'=>'imagentitulo')) ;?><h1><?php echo $titulo;?></h1>
</div>
<div class="empresas form">
<?php echo $this->Form->create('Empresa', array('inputDefaults' => array('label' => false,'div' => false)));?>
<dl>
	<dt class="separador">Nombre</dt>
		<dd><?php echo $this->Form->input('nombre'); ?></dd>
	<dt class="separador">Cif</dt>
		<dd> <?php echo $this->Form->input('cif');?></dd>
	<dt class="separador">Dirección</dt>
		<dd><?php echo $this->Form->input('direccion'); ?></dd>	
	<dt class="separador">Teléfono fijo</dt>
		<dd> <?php echo $this->Form->input('telefono_fijo');?></dd>
	<dt class="separador">Móvil</dt>
		<dd><?php echo $this->Form->input('telefono_movil'); ?></dd>	
	<dt class="separador">Fax</dt>
		<dd> <?php echo $this->Form->input('fax');?></dd>		
	<dt class="separador">Email</dt>
		<dd> <?php echo $this->Form->input('email');?></dd>	
	<dt class="separador">Relación</dt>
		<dd> <?php echo $this->Form->input('relacion_id');?></dd>	
</dl>
<?php echo $this->Form->end('Guardar');?>
</div>