<div class="title">
<?php echo $this->Html->image($icono, array('title'=>$titulo,'class'=>'imagentitulo')) ;?><h1><?php echo $titulo;?></h1>
</div>
<div class="tajo form">
<?php
echo $this->Form->create('Tajo', array('inputDefaults' => array('label' => false,'div' => false)));
echo $this->Form->hidden('proyecto_id',array('value'=>$proyecto_id));
echo $this->Form->hidden('referencia',array('value'=>$referencia));
?>
<dl>	
	<dt class="separador">Descripción</dt>
		<dd><?php echo $this->Form->input('descripcion'); ?></dd>
	<dt class="separador">Fecha</dt>
		<dd> <?php echo $this->Form->input('fecha',array('dateFormat'=> 'DMY','timeFormat'=>null));?></dd>
<dt class="separador">Empleados</dt>
		<dd><?php echo $this->Form->input('Empleado',array('size' =>5,'style' =>'width:220px', 'type'=>'select','multiple' => true,'options'=>$empleados )); ?></dd>	
	<dt class="separador">Notas</dt>
		<dd> <?php echo $this->Form->input('notas');?></dd>
</dl>
<?php echo $this->Form->end('Siguiente');?>
</div>
