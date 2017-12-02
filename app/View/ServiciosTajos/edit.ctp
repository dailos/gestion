<?php 
foreach ($taxes as $key => $tax){
	$impuesto[$key] = $tax['nombre'];	
}
echo $this->Form->create('ServiciosTajo', array('inputDefaults' => array('label' => false,'div' => false)));

echo $this->Form->hidden('tajo_id',array('value'=> $tajo_id));
echo $this->Form->hidden('id');

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
	<th>Modificar</th>
	<th>Cancelar</th>
</tr>
<tr>
	<td><?php echo $this->Form->input('nombre',array('readonly' => $readonly)); ?></td>	
	<td><?php echo $this->Form->input('coste',array('style' =>'width:50px'));	?></td>	
	<td><?php echo $this->Form->input('precio',array('style' =>'width:50px'));?></td>
	<td><?php echo $this->Form->input('cantidad',array('style' =>'width:30px'));?></td>
	<td><?php echo $this->Form->input('impuesto1_id',array('options'=>$impuesto));	?></td>		
	<td><?php echo $this->Form->input('impuesto2_id',array('options'=>$impuesto));	?></td>				
	<td><?php echo $this->Form->input('pdescuento',array('style' =>'width:30px'));	?></td>	
	<td><?php echo $this->Form->input('notas',array('rows' => '1'));?></td>
	<td class='confirmar'><?php echo $this->Form->submit('si.png',array('title'=>'Confirmar','div' =>array('class' =>'confirmar')));?></td>
	<td class='confirmar'><?php echo $this->Html->link($this->Html->image('no.png',array('title'=>'Cancelar')), array('controller' => 'tajos','action' =>'view',$tajo_id),array( 'escape' => false) );?></td>
</tr></table>
<?php $this->Form->end();?>
