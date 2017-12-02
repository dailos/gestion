<?php 
foreach ($taxes as $key => $tax){
	$impuesto[$key] = $tax['nombre'];	
}
echo $this->Form->create('ServiciosTajo', array('inputDefaults' => array('label' => false,'div' => false)));
echo $this->Form->hidden('servicio_id',array('value'=> $servicio['id']));
echo $this->Form->hidden('tajo_id',array('value'=> $tajo_id));

if($servicio['id'] != '1') $readonly  = 'readonly';
else $readonly = '';
?>
<table cellpadding="0" cellspacing="0">
<tr>
	<th>Nombre</th>	
	<th>Coste</th>
	<th>Precio</th>
	<th>Cantidad</th>
	<th>Impuesto 1</th>
	<th>Impuesto 2</th>
	<th>% descuento</th>
	<th>Notas</th>
	<th>Añadir</th>
</tr>
<tr>
	<td><?php echo $this->Form->input('nombre',array('value'=> $servicio['nombre'],'readonly' => $readonly)); ?></td>	
	<td><?php echo $this->Form->input('coste',array('value'=> $servicio['coste'],'style' =>'width:50px'));	?></td>	
	<td><?php echo $this->Form->input('precio',array('value'=> $servicio['precio'],'style' =>'width:50px'));?></td>
	<td><?php echo $this->Form->input('cantidad',array('value'=> 1,'style' =>'width:30px'));?></td>
	<td><?php echo $this->Form->input('impuesto1_id',array('options'=>$impuesto,'default'=>IMPUESTODEFECTO));	?></td>		
	<td><?php echo $this->Form->input('impuesto2_id',array('options'=>$impuesto));	?></td>				
	<td><?php echo $this->Form->input('pdescuento',array('value'=>0,'style' =>'width:30px'));	?></td>	
	<td><?php echo $this->Form->input('notas',array('value'=> $servicio['notas'],'rows' => '1'));?></td>
	<td class='confirmar'><?php echo $this->Form->submit('si.png',array('title'=>'Confirmar','div' =>array('class' =>'confirmar')));?></td>
</tr></table>
<?php $this->Form->end();?>
