<?php 
echo $this->Form->create('Impuesto', array('inputDefaults' => array('label' => false,'div' => false)));
?>
<table cellpadding="0" cellspacing="0">
<tr>
	<td><?php echo $this->Form->input('nombre'); ?></td>
	<td><?php echo $this->Form->input('porcentaje',array('value'=> 0));?></td>	
	<td><?php echo $this->Form->submit('add.png',array('title'=>'Crear nuevo'),array('div' =>false));?></td>
</tr></table>
<?php $this->Form->end();?>
