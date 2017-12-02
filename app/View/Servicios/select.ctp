<div id="selectAjax">
<?php 
if(!$filtrado):?>
<div class="selecttitle">
<?php echo $this->Html->image($icono, array('title'=>$titulo,'class'=>'imagentitulo')) ;?><h1><?php echo $titulo;?></h1>	
	<div class="actions">
		<?php echo $this->Html->link($this->Html->image("no.png"), array('controller'=>'tajos', 'action' => 'view',$tajo_id), array( 'escape' => false) );?>	
	</div>
	<?php echo $this->element('filtro',array('model' =>'Servicio','url' => array('controller'=>'servicios','action' => 'select',$tajo_id)));?>
</div>

<div id="filtrado" class="selectlist">
<?php endif;?>

<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $this->Paginator->sort('nombre');?></th>
	<th><?php echo $this->Paginator->sort('coste');?></th>
	<th><?php echo $this->Paginator->sort('precio');?></th>	
	<th><?php echo $this->Paginator->sort('notas');?></th>
</tr>
<?php
$i = 0;
foreach ($servicios as $servicio):
	$i++;
	echo $this->element('trclassAjax',array('i' =>$i,'url' => '/servicios_tajos/add/'.$tajo_id.'/'.$servicio['Servicio']['id'],'update' => '#selectservicio' ,'evalScripts' => true));?>	
	<td><?php echo $servicio['Servicio']['nombre']; ?>&nbsp;</td>
	<td><?php echo $servicio['Servicio']['coste']; ?>&nbsp;</td>
	<td><?php echo $servicio['Servicio']['precio']; ?>&nbsp;</td>	
	<td><?php echo $servicio['Servicio']['notas']; ?>&nbsp;</td>
</tr>
<?php endforeach; ?>
</table>
<?php echo $this->element('paginationAjax');?>
<?php if(!$filtrado):?>
</div>
<?php endif;?>

</div>
