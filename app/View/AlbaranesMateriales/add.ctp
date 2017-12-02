<?php 
echo $this->Form->create('AlbaranesMaterial', array('inputDefaults' => array('label' => false,'div' => false)));
echo $this->Form->hidden('material_id',array('value'=> $material['id']));
echo $this->Form->hidden('albaran_id',array('value'=> $albaran_id));
?>
<table cellpadding="0" cellspacing="0">
<tr>
	<th>Nombre</th>
	<th>Cantidad</th>	
	<th>Notas</th>
	<th>Añadir</th>
</tr>
<tr>
	<td><?php echo $this->Form->input('nombre',array('value'=> $material['nombre'],'readonly' => 'readonly')); ?></td>
	<td><?php echo $this->Form->input('cantidad',array('value'=> 0));?></td>	
	<td><?php echo $this->Form->input('notas',array('value'=> $material['notas'],'rows' => '1'));?></td>
	<td class='confirmar'><?php echo $this->Form->submit('si.png',array('title'=>'Confirmar','div' =>array('class' =>'confirmar')));?></td>
</tr></table>
<?php $this->Form->end();?>
