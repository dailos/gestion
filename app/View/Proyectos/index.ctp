<?php if(!$filtrado):?>
<div class="title">
<?php echo $this->Html->image($icono, array('title'=>$titulo,'class'=>'imagentitulo')) ;?>
<h1><?php echo $titulo;?></h1>
<?php echo $this->element('filtrocompleto',array('model' =>'Proyecto', 'estados' => $estadosproyecto,'filter'=> $filter));?>
</div>
<div id="filtrado" class="proyectos index" >
<?php endif;?>
<table cellpadding="0" cellspacing="0">
<tr>	
		<th><?php if($resumen) echo 'Título'; else echo $this->Paginator->sort('titulo','Título');?></th>		
		<th><?php if($resumen) echo 'Empresa'; else echo $this->Paginator->sort('empresa_id');?></th>
		<th style="text-align:right;"><?php if($resumen) echo 'Facturas'; else echo $this->Paginator->sort('Facturas');?></th>
		<th><?php if($resumen) echo 'Fecha'; else echo $this->Paginator->sort('fechapedido','Fecha');?></th>
		<th><?php if($resumen) echo 'Estado'; else echo $this->Paginator->sort('estado');?></th>	
		<th style="text-align:right;"><?php if($resumen) echo 'Coste'; else echo $this->Paginator->sort('coste');?></th>
		<th style="text-align:right;"><?php if($resumen) echo 'Beneficio'; else echo $this->Paginator->sort('beneficio');?></th>
		<th style="text-align:right;"><?php if($resumen) echo 'Facturado'; else echo $this->Paginator->sort('facturado');?></th>
		<th style="text-align:right;"><?php if($resumen) echo 'Pendiente'; else echo $this->Paginator->sort('pendiente','Pendiente');?></th>		
		<th style="text-align:right;"><?php if($resumen) echo 'Total'; else echo $this->Paginator->sort('total');?></th>
</tr>
<?php
	$coste = $beneficio = $facturado = $pendiente = $total = 0;
	$i=0;
	foreach ($proyectos as $proyecto):
		if(is_array($proyecto['Factura']))	$nfac = count($proyecto['Factura']);
		
		switch ($proyecto['Proyecto']['estado_id']){
			case 0: $class = 'estado0';break;
			case 1: $class = 'estado1';break;
			case 2: $class = 'estado2';break;
			case 3: $class = 'estado3';break;
			case 4: $class = 'estado4';break;	
		}	
	$i++;
	echo $this->element('trclass',array('i' =>$i,'url' => 'view/'.$proyecto['Proyecto']['id']));	
	$coste += $proyecto['Proyecto']['coste'];
	$beneficio += $proyecto['Proyecto']['beneficio'];
	$facturado += $proyecto['Proyecto']['facturado'];
	$pendiente += $proyecto['Proyecto']['pendiente'];
	$total += $proyecto['Proyecto']['total'];
?>	
	<td><?php echo $proyecto['Proyecto']['titulo']; ?>&nbsp;</td>	
	<td><?php echo $this->Html->link($proyecto['Empresa']['nombre'], array('controller' => 'empresas', 'action' => 'view', $proyecto['Empresa']['id'])); ?></td>
	<td style="text-align:right;"><?php echo $nfac;  ?>&nbsp;</td>
	<td><?php echo$this->Format->date($proyecto['Proyecto']['fechapedido']);  ?>&nbsp;</td>
	<td class="<?php echo $class;?>"><?php echo $estadosproyecto[$proyecto['Proyecto']['estado_id']]; ?>&nbsp;</td>	
	<td style="text-align:right;"><?php echo $this->Format->money($proyecto['Proyecto']['coste']); ?>&nbsp;</td>
	<td style="text-align:right;"><?php echo $this->Format->money($proyecto['Proyecto']['beneficio']); ?>&nbsp;</td>
	<td style="text-align:right;"><?php echo $this->Format->money($proyecto['Proyecto']['facturado']); ?>&nbsp;</td>
	<td style="text-align:right;"><?php echo $this->Format->money($proyecto['Proyecto']['pendiente']); ?>&nbsp;</td>
	<td style="text-align:right;"><?php echo $this->Format->money($proyecto['Proyecto']['total']); ?>&nbsp;</td>
</tr>
<?php endforeach; ?>
<?php if($resumen):?>
<tr>
	<td class="total"><strong>RESUMEN</strong></td>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	<td class="total" style="text-align:right;"><strong><?php echo $this->Format->money($coste); ?>&nbsp;</strong></td>
	<td class="total" style="text-align:right;"><strong><?php echo $this->Format->money($beneficio); ?>&nbsp;</strong></td>
	<td class="total" style="text-align:right;"><strong><?php echo $this->Format->money($facturado); ?>&nbsp;</strong></td>
	<td class="total" style="text-align:right;"><strong><?php echo $this->Format->money($pendiente); ?>&nbsp;</strong></td>
	<td class="total" style="text-align:right;"><strong><?php echo $this->Format->money($total); ?>&nbsp;</strong></td>
</tr>
<?php endif; ?>
</table>
<?php echo $this->element('pagination'); ?>
<?php if(!$filtrado):?>
</div>
<?php endif;?>