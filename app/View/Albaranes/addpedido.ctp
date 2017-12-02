<div class="title">
<?php echo $this->Html->image($icono, array('title'=>$titulo,'class'=>'imagentitulo')) ;?><h1><?php echo $titulo;?></h1>
</div>
<div class="albaran form">
<?php
echo $this->Form->create('Albaran', array('inputDefaults' => array('label' => false,'div' => false)));
echo $this->Form->hidden('empresa_id',array('value'=>$empresa_id));
echo $this->Form->hidden('npedido',array('value'=>$npedido));
?>
<dl>	
	<dt class="separador">Descripción</dt>
		<dd> <?php echo $this->Form->input('descripcion');?></dd>
	<dt class="separador">Fecha</dt>
		<dd> <?php echo $this->Form->input('fecha',array('dateFormat'=> 'DMY','timeFormat'=>null));?></dd>	
	<dt class="separador">Notas</dt>
		<dd> <?php echo $this->Form->input('notas');?></dd>
</dl>
<?php echo $this->Form->end('Siguiente');?>
</div>
