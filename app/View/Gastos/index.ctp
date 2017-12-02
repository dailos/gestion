<?php if(!$filtrado):?>
<div class="title">
<?php echo  $this->Html->image($icono, array('title'=>$titulo,'class'=>'imagentitulo')) ;?>
<h1><?php echo $titulo;?></h1>
<?php echo $this->element('filtrocompleto',array('model' =>'Gasto', 'estados' => $estadosgasto,'filter'=> $filter));?>
</div>
<div id="filtrado" class="gastos index">
<?php endif;?>
	<table cellpadding="0" cellspacing="0">
	<tr>			
			<th><?php if($resumen) echo 'Referencia'; else  echo $this->Paginator->sort('referencia');?></th>
			<th><?php if($resumen) echo 'Nº Factura'; else  echo $this->Paginator->sort( 'nfactura','Nº Factura');?></th>
			<th><?php if($resumen) echo 'Fecha'; else  echo $this->Paginator->sort('fecha');?></th>
			<th><?php if($resumen) echo 'Estado'; else  echo $this->Paginator->sort('estado');?></th>
			<th><?php if($resumen) echo 'Descripción'; else  echo $this->Paginator->sort('descripcion','Descripción');?></th>							
			<th style="text-align:right;"><?php if($resumen) echo 'Total'; else  echo $this->Paginator->sort('total');?></th>
			<th style="text-align:right;"><?php if($resumen) echo 'Pendiente'; else  echo $this->Paginator->sort('pendiente');?></th>
			<th><?php if($resumen) echo 'Empresa'; else  echo $this->Paginator->sort('empresa_id');?></th>
			<th><?php if($resumen) echo 'Previsión pago'; else  echo $this->Paginator->sort('prevpago','Previsión pago');?></th>
			<th><?php if($resumen) echo 'Concepto'; else  echo $this->Paginator->sort('concepto');?></th>			
	</tr>
	<?php
	$i = 0;
	foreach ($gastos as $gasto):	
		switch ($gasto['Gasto']['estado_id']){
			case 0: $class = 'estado0';break;
			case 1: $class = 'estado1';break;
			case 2: $class = 'estado2';break;
			case 3: $class = 'estado3';break;
			case 4: $class = 'estado4';break;	
		}	
		$i++;
		echo $this->element('trclass',array('i' =>$i,'url' => 'view/'.$gasto['Gasto']['id']));
		$pendiente += $gasto['Gasto']['pendiente'];
		$total += $gasto['Gasto']['total'];	
	?>		
		<td><?php echo $gasto['Gasto']['referencia']; ?>&nbsp;</td>
		<td><?php echo $gasto['Gasto']['nfactura']; ?>&nbsp;</td>
		<td><?php echo $this->Format->date($gasto['Gasto']['fecha']); ?>&nbsp;</td>
		<td class="<?php echo $class;?>"><?php echo $estadosgasto[$gasto['Gasto']['estado_id']]; ?>&nbsp;</td>
		<td><?php echo $gasto['Gasto']['descripcion']; ?>&nbsp;</td>									
		<td style="text-align:right;"><?php echo $this->Format->money($gasto['Gasto']['total']); ?>&nbsp;</td>
		<td style="text-align:right;"><?php echo $this->Format->money($gasto['Gasto']['pendiente']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($gasto['Empresa']['nombre'], array('controller' => 'empresas', 'action' => 'view', $gasto['Empresa']['id'])); ?>
		</td>
		<td><?php echo $this->Format->date($gasto['Gasto']['prevpago']); ?>&nbsp;</td>
		<td><?php echo $gasto['Concepto']['nombre']; ?>&nbsp;</td>		
	</tr>
<?php endforeach; ?>
</table>
<?php if($resumen):?>
<div id="resumen">
	<div>
		<h3>Resumen</h3>
		<dl>
			<?php foreach ($economicos['impuestos'] as $nombre => $impuesto):?>
			<dt><?php echo $nombre?></dt>
			<dd><strong><?php echo $this->Format->money($impuesto); ?>&nbsp;</strong></dd>
			<?php endforeach;?>
			<dt>Descuento</dt>
			<dd><strong><?php echo $this->Format->money($economicos['descuento']); ?>&nbsp;</strong></dd>
			<dt>Pendiente</dt>
			<dd><strong><?php echo $this->Format->money($pendiente,2,',','.'); ?>&nbsp;</strong></dd>		
			<dt>Subtotal</dt>
			<dd><strong><?php echo $this->Format->money($economicos['subtotal']); ?>&nbsp;</strong></dd>
			<dt>Total</dt>
			<dd><strong><?php echo $this->Format->money($economicos['total']); ?>&nbsp;</strong></dd>				
		</dl>	
	</div>
</div>
<?php endif; ?>	

	<?php echo $this->element('pagination'); ?>
<?php if(!$filtrado):?>
</div>
<?php endif;?>