<?php
echo $this->Form->create('Proyecto', array('inputDefaults' => array('label' => false,'div' => false)));
echo $this->Form->input('id'); ?>
<dl>
	<dt class="separador">Título</dt>
		<dd><?php echo $this->Form->input('titulo'); ?></dd>
	<dt class="separador">Descripción</dt>
		<dd> <?php echo $this->Form->input('descripcion');?></dd>
	<dt class="separador">Cliente </dt>
		<dd><?php echo $this->Form->input('empresa_id',array('disabled' =>'disabled', 'id' =>'listaEmpresas')); ?>
			<a href="#" onclick="desbloquear(); "><img  src="/gestion/img/cerrado_action.png" width="24" ></a>	  			
		</dd>
	<dt class="separador">Fecha Inicio</dt>
		<dd><?php echo $this->Form->input('fechapedido',array('dateFormat'=> 'DMY','timeFormat'=>null)); ?></dd>		
</dl>

<?php 
echo $this->Form->hidden('estado_id');
echo $this->Form->hidden('coste');
echo $this->Form->hidden('ganancia');
echo $this->Form->end('Guardar');


?>

