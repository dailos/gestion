<?php if(!$filtrado):?>
<div class="title">
<?php echo $this->Html->image($icono, array('title'=>$titulo,'class'=>'imagentitulo')) ;?>
<h1><?php echo $titulo;?></h1>
<?php echo $this->element('filtrocompleto',array('model' =>'Factura', 'estados' => $estadosfactura,'filter'=> $filter));?>
</div>
<div id="filtrado" class="facturas index">	
<?php endif;?>
	<table cellpadding="0" cellspacing="0">
	<tr>		
		<th><?php if($resumen) echo 'nº fra'; else echo $this->Paginator->sort('nfactura','nº fra');?></th>
		<th><?php if($resumen) echo 'Fecha'; else echo $this->Paginator->sort('fecha');?></th>								
		<th><?php if($resumen) echo 'Empresa'; else echo $this->Paginator->sort('empresa');?></th>
		<th><?php if($resumen) echo 'Proyecto'; else echo $this->Paginator->sort('proyecto_id');?></th>			
		<th style="text-align:right;"><?php if($resumen) echo 'Total'; else echo $this->Paginator->sort('total');?></th>
		<th style="text-align:right;"><?php if($resumen) echo 'Pendiente'; else echo $this->Paginator->sort('pendiente');?></th>
		<th><?php if($resumen) echo 'Estado'; else echo $this->Paginator->sort('estado');?></th>
		<th><?php if($resumen) echo 'Envío'; else echo $this->Paginator->sort('fecha_entrega','Envío');?></th>	
		<th><?php if($resumen) echo 'Recepción'; else echo $this->Paginator->sort('fecha_recepcion','Recepción');?></th>					
	</tr>
	<?php	
	$pendiente =0;
	$i = 0;
	foreach ($facturas as $factura):		
		switch ($factura['Factura']['estado_id']){
			case 0: $class = 'estado0';break;
			case 1: $class = 'estado1';break;
			case 2: $class = 'estado2';break;
			case 3: $class = 'estado3';break;
			case 4: $class = 'estado4';break;	
		}	
		$i++;
		echo $this->element('trclass',array('i' =>$i,'url' => 'view/'.$factura['Factura']['id']));			
		$pendiente += $factura['Factura']['pendiente'];		
	?>	
		<td><?php echo $factura['Factura']['nfactura'];?></td>
		<td><?php echo $this->Format->date($factura['Factura']['fecha']); ?>&nbsp;</td>				
		<td><?php echo $this->Html->link($factura['Proyecto']['Empresa']['nombre'], array('controller' => 'empresas', 'action' => 'view', $factura['Proyecto']['empresa_id'])); ?></td>
		<td><?php echo $this->Html->link($factura['Proyecto']['titulo'], array('controller' => 'proyectos', 'action' => 'view', $factura['Proyecto']['id'])); ?></td>
		<td style="text-align:right;"><?php echo $this->Format->money($factura['Factura']['total']); ?>&nbsp;</td>
		<td style="text-align:right;"><?php echo $this->Format->money($factura['Factura']['pendiente']); ?>&nbsp;</td>
		<td class="<?php echo $class;?>"><?php echo $estadosfactura[$factura['Factura']['estado_id']]; ?>&nbsp;</td>
		<td><?php if( $factura['Factura']['fecha_envio']) echo $this->Format->date($factura['Factura']['fecha_envio']);
					else   echo $this->Html->image('minino.png');?>&nbsp;</td>	
		<td><?php if( $factura['Factura']['fecha_recepcion']) echo 	$this->Format->date($factura['Factura']['fecha_recepcion']);
					else   echo $this->Html->image('minino.png');?>&nbsp;</td>			
	</tr>	
<?php  endforeach; ?>
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
			<dd><strong><?php echo $this->Format->money($pendiente); ?>&nbsp;</strong></dd>
			<dt>Coste</dt>
			<dd><strong><?php echo $this->Format->money($economicos['coste']); ?>&nbsp;</strong></dd>
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