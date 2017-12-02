<div id="selectAjax">
<div class="selecttitle">
<h1><?php echo $titulo;?></h1>	
	<div class="actions">
		<?php echo $this->Html->link($this->Html->image("no.png"), array('controller'=>'gastos', 'action' => 'view',$gasto_id), array( 'escape' => false) );?>	
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
	foreach ($albaranes as $albaran):
		$i++;
		echo $this->element('trclass',array('i' =>$i,'url' => '/albaranes/setgasto/'.$albaran['Albaran']['id'].'/'.$gasto_id ));?>	
		<td><?php echo $albaran['Albaran']['referencia']; ?>&nbsp;</td>
		<td><?php echo $albaran['Albaran']['descripcion']; ?>&nbsp;</td>
		<td><?php echo $this->Format->date($albaran['Albaran']['fecha']); ?>&nbsp;</td>		
	</tr>
	<?php endforeach; ?>
	</table>
<?php echo $this->element('paginationAjax');?>
</div>
<?php echo $js->writeBuffer(); ?>
</div>