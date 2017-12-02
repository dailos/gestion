<?php
echo $this->Form->create('Vehiculo', array('inputDefaults' => array('label' => false,'div' => false)));
echo $this->Form->input('id');
?>
<dl>
	<dt class="separador">Matrícula</dt>
		<dd><?php echo $this->Form->input('matricula'); ?></dd>
	<dt class="separador">Marca</dt>
		<dd> <?php echo $this->Form->input('marca');?></dd>
	<dt class="separador">Modelo</dt>
		<dd><?php echo $this->Form->input('modelo'); ?></dd>	
	<dt class="separador">Matriculación</dt>
		<dd> <?php echo $this->Form->input('matriculacion',array('dateFormat'=> 'DMY','timeFormat'=>null));?></dd>
	<dt class="separador">Próx. ITV</dt>
		<dd><?php echo $this->Form->input('itv',array('dateFormat'=> 'DMY','timeFormat'=>null)); ?></dd>	
	<dt class="separador">Próx. Revisión(km)</dt>
		<dd> <?php echo $this->Form->input('revisionkm');?></dd>
	<dt class="separador">Próx. aceite(km)</dt>
		<dd><?php echo $this->Form->input('aceitekm'); ?></dd>	
	<dt class="separador">Km actuales</dt>
		<dd> <?php echo $this->Form->input('km');?></dd>
	<dt class="separador">Notas</dt>
		<dd> <?php echo $this->Form->input('notas');?></dd>			
</dl>
<?php echo $this->Form->end('Guardar');?>
