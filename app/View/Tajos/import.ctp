<div id="selectAjax">
<div class="selecttitle">
<h1><?php echo $titulo;?></h1>	
	<div class="actions">
		<?php echo $this->Html->link($this->Html->image("no.png"), array('controller'=>'tajos', 'action' => 'view',$tajo_id), array( 'escape' => false) );?>	
	</div>		
</div>

<div class="selectlist">
	<table cellpadding="0" cellspacing="0">
	<tr>	
		<th><?php echo $this->Paginator->sort('Referencia');?></th>
		<th><?php echo $this->Paginator->sort('Descripción');?></th>
		<th><?php echo $this->Paginator->sort('Empresa');?></th>
		<th><?php echo $this->Paginator->sort('Fecha');?></th>
	</tr>
	<?php
	$i = 0;
	$updateStock = "";
	if($field == "referencia")
		$updateStock= "/updateStock";
	foreach ($tajos as $tajo):
		$i++;		
		echo $this->element('trclass',array('i' =>$i,'url' => '/tajos/importarElementos/'.$tajo['Tajo']['id'].'/'.$tajo_id . $updateStock));?>	
		<td><?php echo $tajo['Tajo'][$field]; ?>&nbsp;</td>
		<td><?php echo $tajo['Tajo']['descripcion']; ?>&nbsp;</td>
		<td><?php echo $tajo['Proyecto']['Empresa']['nombre']; ?>&nbsp;</td>
		<td><?php echo $this->Format->date($tajo['Tajo']['fecha']); ?>&nbsp;</td>			
	</tr>
	<?php endforeach; ?>
	</table>
<?php echo $this->element('paginationAjax');?>
</div>
<?php echo $this->Js->writeBuffer(); ?>
</div>