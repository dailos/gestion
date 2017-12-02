<div id="selectAjax">
<div class="selecttitle">
<h1><?php echo $titulo;?></h1>	
	<div class="actions">
		<?php echo $this->Html->link($this->Html->image("no.png"), array('controller'=>'facturas', 'action' => 'view',$factura_id), array( 'escape' => false) );?>	
	</div>		
</div>

<div class="selectlist">
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?php echo $this->Paginator->sort('Referencia');?></th>
		<th><?php echo $this->Paginator->sort('Descripción');?></th>
		<th><?php echo $this->Paginator->sort('Fecha');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($tajos as $tajo):
		$i++;
		echo $this->element('trclass',array('i' =>$i,'url' => '/tajos/setfactura/'.$tajo['Tajo']['id'].'/'.$factura_id ));?>	
		<td><?php echo $tajo['Tajo']['referencia']; ?>&nbsp;</td>
		<td><?php echo $tajo['Tajo']['descripcion']; ?>&nbsp;</td>
		<td><?php echo $this->Format->date($tajo['Tajo']['fecha']); ?>&nbsp;</td>			
	</tr>
	<?php endforeach; ?>
	</table>
<?php echo $this->element('paginationAjax');?>
</div>
<?php echo $this->Js->writeBuffer(); ?>
</div>