<?php
echo $this->Form->create('Empresa', array('inputDefaults' => array('label' => false,'div' => false)));
echo $this->Form->input('id');
?>
<dl>
	<dt class="separador">Nombre</dt>
		<dd><?php echo $this->Form->input('nombre',array('style'=>'width:500px;')); ?></dd>
	<dt class="separador">Dirección</dt>
		<dd><?php echo $this->Form->input('direccion',array('style'=>'width:500px;')); ?></dd>	
	<dt class="separador">Email</dt>
		<dd> <?php echo $this->Form->input('email',array('style'=>'width:500px;'));?></dd>	
	<dt class="separador">Cif</dt>
		<dd> <?php echo $this->Form->input('cif');?></dd>
	<dt class="separador">Teléfono fijo</dt>
		<dd> <?php echo $this->Form->input('telefono_fijo');?></dd>
	<dt class="separador">Móvil</dt>
		<dd><?php echo $this->Form->input('telefono_movil'); ?></dd>	
	<dt class="separador">Fax</dt>
		<dd> <?php echo $this->Form->input('fax');?></dd>			
	
	<?php if( $this->Form->value('Empresa.id') != SISTEMA):?>
	<dt class="separador">Relacion</dt>
		<dd> <?php echo $this->Form->input('relacion_id');?></dd>		
	<?php endif;?>
</dl>
<?php echo $this->Form->end('Guardar');?>
