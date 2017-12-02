<div class="title">
<?php echo $this->Html->image($icono, array('title'=>$titulo,'class'=>'imagentitulo')) ;?><h1><?php echo $titulo;?></h1>
</div>
<div class="empleado form">
<?php echo $this->Form->create('Empleado', array('inputDefaults' => array('label' => false,'div' => false)));
echo $this->Form->hidden('empresa_id',array('value'=>$empresa_id));
?>

<dl>
	<dt class="separador">Nombre</dt>
		<dd><?php echo $this->Form->input('nombre'); ?></dd>
	<dt class="separador">Apellidos</dt>
		<dd> <?php echo $this->Form->input('apellidos');?></dd>
	<dt class="separador">Cargo</dt>
		<dd> <?php echo $this->Form->input('cargo');?></dd>
	<dt class="separador">Teléfono</dt>
		<dd> <?php echo $this->Form->input('telefono');?></dd>
	<dt class="separador">Móvil</dt>
		<dd> <?php echo $this->Form->input('movil');?></dd>
	<dt class="separador">E-mail</dt>
		<dd> <?php echo $this->Form->input('email');?></dd>
	<dt class="separador">Horario</dt>
		<dd> <?php echo $this->Form->input('horario');?></dd>
	<?php if($empresa_id == SISTEMA):?>
	<dt class="separador">Coste mensual</dt>
		<dd><?php echo $this->Form->input('costexmes'); ?></dd>	
	<dt class="separador">Horas mensuales</dt>
		<dd> <?php echo $this->Form->input('horasxmes');?></dd>
	<dt class="separador">Fecha de alta</dt>
		<dd><?php echo $this->Form->input('fechacontratacion',array('dateFormat'=> 'DMY','timeFormat'=>null)); ?></dd>	
		<?php endif;?>
	<dt class="separador">Notas</dt>
		<dd> <?php echo $this->Form->input('notas');?></dd>		
</dl>
<?php echo $this->Form->end('Guardar');?>
</div>