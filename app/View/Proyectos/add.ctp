<div class="title">
<?php echo $this->Html->image($icono, array('title'=>$titulo,'class'=>'imagentitulo')) ;?><h1><?php echo $titulo;?></h1>
</div>
<div class="proyecto form">
<?php echo $this->Form->create('Proyecto', array('inputDefaults' => array('label' => false,'div' => false)));?>
<dl>
	<dt class="separador">Título</dt>
		<dd><?php echo $this->Form->input('titulo'); ?></dd>
	<dt class="separador">Descripción</dt>
		<dd> <?php echo $this->Form->input('descripcion');?></dd>
	<dt class="separador">Fecha Inicio</dt>
		<dd><?php echo $this->Form->input('fechapedido',array('dateFormat'=> 'DMY','timeFormat'=>null)); ?></dd>		
</dl>
<?php 
echo $this->Form->hidden('empresa_id',array('value' =>$empresa_id));
echo $this->Form->hidden('estado_id',array('value' =>0));
echo $this->Form->hidden('coste',array('readonly' => 'true'));
echo $this->Form->hidden('ganancia',array('readonly' => 'true'));
echo $this->Form->end('Guardar');
?>
</div>

