<?php if(!$filtrado):?>
<div class="title">
<?php echo $this->Html->image($icono, array('title'=>$titulo,'class'=>'imagentitulo')) ;?><h1><?php echo $titulo;?></h1>
	<div class="actions">
		<?php echo $this->Html->link($this->Html->image('traspaso.png',array('title'=>'Traspaso entre cuentas')), array('action' => 'traspaso'), array('escape' => false));?>	
	</div>	
<?php echo $this->element('filtroapuntes',array('cuentas'=> $cuentas));?>	
</div>
<div  id="filtrado" class="cobros index">
<?php endif;?>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php if($resumen) echo 'Fecha'; else  echo $this->Paginator->sort('fecha');?></th>	
			<th><?php if($resumen) echo 'Descripción'; else echo $this->Paginator->sort('descripcion','Descripción');?></th>
			<th><?php if($resumen) echo 'Empresa'; else echo $this->Paginator->sort('empresa');?></th>
			<th><?php if($resumen) echo 'Referencia'; else echo $this->Paginator->sort('referencia');?></th>		
			<th style="text-align:right;"><?php if($resumen) echo 'Cantidad'; else echo $this->Paginator->sort('cantidad');?></th>
			<th><?php if($resumen) echo 'Documento'; else echo $this->Paginator->sort('documento');?></th>					
			<th><?php if($resumen) echo 'Cuenta'; else echo $this->Paginator->sort('cuenta_id');?></th>
			<th><?php if($resumen) echo 'Método'; else echo $this->Paginator->sort('metodo_id','Método');?></th>								
	</tr>
	<?php
	$i = 0;
	$pagos = $cobros = 0;	
	foreach ($apuntes as $apunte):
		$i++;		
		$class = "cobro";
		$pago = false;	
		
		if ($apunte['Apunte']['gasto_id'] || $apunte['Apunte']['metodo_id'] == TRAS_ORIG) {
			$pago = true;
			$apunte['Apunte']['cantidad'] = -$apunte['Apunte']['cantidad'];			
			$class = "pago";		
		}
		if($apunte['Apunte']['metodo_id'] != TRAS_ORIG && $apunte['Apunte']['metodo_id'] != TRAS_DEST){
			if($pago) $pagos +=$apunte['Apunte']['cantidad'];
			else $cobros += $apunte['Apunte']['cantidad'];		
		}
		$onclick = "onclick=\"location.href='". $this->Html->url('/apuntes/view/'.$apunte['Apunte']['id']) . "';\" ";		
		echo "<tr class = '$class' $onclick   onmouseover=\"this.className='selrow';\" onmouseout=\"this.className='$class';\"".">";		
	?>	
		<td><?php echo $this->Format->date($apunte['Apunte']['fecha']); ?>&nbsp;</td>
		<td><?php echo $apunte['Apunte']['descripcion']; ?>&nbsp;</td>
		<td><?php  if ($pago)echo $this->Html->link($apunte['Gasto']['Empresa']['nombre'], array('controller' => 'empresas', 'action' => 'view', $apunte['Gasto']['Empresa']['id'])); 
				  else  echo $this->Html->link($apunte['Factura']['Proyecto']['Empresa']['nombre'], array('controller' => 'facturas', 'action' => 'view', $apunte['Factura']['Proyecto']['Empresa']['id'])); ?></td>
		</td>
		<td><?php echo $apunte['Apunte']['referencia']; ?>&nbsp;</td>	
		<td style="text-align:right;"><?php echo  $this->Format->money($apunte['Apunte']['cantidad']); ?>&nbsp;</td>
		<td><?php if ($pago) echo $this->Html->link($apunte['Gasto']['referencia'], array('controller' => 'gastos', 'action' => 'view', $apunte['Gasto']['id'])); 
				  else  echo $this->Html->link($apunte['Factura']['nfactura'], array('controller' => 'facturas', 'action' => 'view', $apunte['Factura']['id'])); ?>
		</td>			
		<td><?php echo $this->Html->link($apunte['Cuenta']['nombre'], array('controller' => 'cuentas', 'action' => 'view', $apunte['Cuenta']['id'])); ?></td>
		<td><?php if ($apunte['Apunte']['metodo_id'] == TRAS_DEST || $apunte['Apunte']['metodo_id'] == TRAS_ORIG) echo 'Traspaso entre cuentas';
			else echo $metodospago[$apunte['Apunte']['metodo_id']]; ?></td>					
	</tr>
	<?php endforeach; ?>
	<?php if($resumen):
	$total = $cobros + $pagos;
	?>
<tr>
	<td class="total"><strong>RESUMEN</strong></td>
	<td>Ingresos:</td>
	<td><?php echo $this->Format->money($cobros); ?>&nbsp;</td>	
	
	<td>Gastos:</td>
	<td><?php echo $this->Format->money($pagos); ?>&nbsp;</td>
	<td><strong>BALANCE</strong></td>
	<td class="total"><strong><?php echo $this->Format->money($total); ?>&nbsp;</strong></td>	
</tr>
<?php endif; ?>
	</table>
	<?php echo $this->element('pagination'); ?>
<?php if(!$filtrado):?>
</div>
<?php endif; ?>