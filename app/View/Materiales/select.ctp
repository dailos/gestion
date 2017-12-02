<div id="selectAjax">
<?php 
if ($controladororigen == 'tajos') $controlador = 'materiales_tajos';
else $controlador = 'albaranes_materiales';	

if(!$filtrado):?>

<div class="selecttitle">
<?php echo $this->Html->image($icono, array('title'=>$titulo,'class'=>'imagentitulo')) ;?><h1><?php echo $titulo;?></h1>	
	<div class="actions">		
		<?php echo $this->Html->link($this->Html->image("no.png"), array('controller'=>$controladororigen, 'action' => 'view',$id), array( 'escape' => false) );?>
	</div>
	<?php echo $this->element('filtro',array('model' =>'Material','url' => array('controller'=>'materiales','action' => 'select',$id,$controladororigen)));?>
	
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
foreach ($materiales as $material):
	$i++;
	echo $this->element('trclassAjax',array('i' =>$i,'url' => '/'.$controlador.'/add/'.$id.'/'.$material['Material']['id'],'update' => '#selectmaterial' ,'evalScripts' => true));?>	
	<td><?php echo $material['Material']['nombre']; ?>&nbsp;</td>
	<td><?php echo $material['Material']['coste']; ?>&nbsp;</td>
	<td><?php echo $material['Material']['precio']; ?>&nbsp;</td>	
	<td><?php echo $material['Material']['notas']; ?>&nbsp;</td>
</tr>
<?php endforeach; ?>
</table>
<?php echo $this->element('paginationAjax');?>
<?php if(!$filtrado):?>
</div>
<?php endif;?>
</div>