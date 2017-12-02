<?php 
foreach ($taxes as $key => $tax){
	$impuesto[$key] = $tax['nombre'];	
}

echo $this->Form->create('Conceptoalbaran', array('inputDefaults' => array('label' => false,'div' => false)));
echo $this->Form->hidden('albaran_id',array('value'=> $albaran_id));

?>
<table cellpadding="0" cellspacing="0">
<tr>
	<th>Concepto</th>	
	<th>Coste</th>	
	<th>Cantidad</th>
	<th>Impuesto 1</th>
	<th>Impuesto 2</th>
	<th>% descuento</th>
	<th>Notas</th>
	<th>Añadir</th>
</tr>
<tr>
	<td><?php echo $this->Form->input('concepto'); ?></td>	
	<td><?php echo $this->Form->input('coste',array('style' =>'width:50px'));	?></td>		
	<td><?php echo $this->Form->input('cantidad',array('style' =>'width:30px'));?></td>
	<td><?php echo $this->Form->input('impuesto1_id',array('options'=>$impuesto));	?></td>		
	<td><?php echo $this->Form->input('impuesto2_id',array('options'=>$impuesto));	?></td>		
	<td><?php echo $this->Form->input('pdescuento',array('value'=>0,'style' =>'width:30px'));	?></td>		
	<td><?php echo $this->Form->input('notas',array('rows' => '1'));?></td>
	<td class='confirmar'><?php echo $this->Form->submit('si.png',array('title'=>'Confirmar','div' =>array('class' =>'confirmar')));?></td>
</tr></table>
<?php $this->Form->end();?>
