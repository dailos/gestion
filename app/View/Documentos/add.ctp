<?php 
echo $this->Form->create('Documento', array('type'=>'file','inputDefaults' => array('label' => false,'div' => false)));
echo $this->Form->hidden($fk_name,array('value'=>$fk_id));
echo $this->Form->hidden('referer',array('value'=>$referer));
?>
<table cellpadding="0" cellspacing="0">
<tr>
	<th>Nombre</th>	
	<th>Archivo</th>
	<th>Guardar</th>
</tr>
<tr>
	<td><?php echo $this->Form->input('nombre'); ?></td>
	<td><?php echo $this->Form->file('archivo');?></td>
	<td class='confirmar'><?php echo $this->Form->submit('si.png',array('title'=>'Confirmar','div' =>array('class' =>'confirmar')));?></td>
</tr></table>
<?php $this->Form->end();?>
