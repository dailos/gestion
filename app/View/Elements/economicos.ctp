<div id="economicos">
	<dl>
		<dt>Subtotal</dt>
		<dd><strong><?php echo $this->Format->money($datoseconomicos['subtotal']); ?>&nbsp;</strong></dd>
		<?php if ($datoseconomicos['descuento']):?>
		<dt>Descuento</dt>
		<dd><strong><?php echo $this->Format->money($datoseconomicos['descuento']); ?>&nbsp;</strong></dd>
		<?php endif;?>
		<dt>Base Imponible</dt>
		<dd><strong><?php echo $this->Format->money($datoseconomicos['baseimponible']); ?>&nbsp;</strong></dd>
		<?php foreach ($datoseconomicos['impuestos'] as $nombre => $valor):	
			if($valor != 0): ?>	
		<dt><?php echo __($nombre);?></dt>
		<dd><strong><?php echo $this->Format->money($valor); ?>&nbsp;</strong></dd>	
	<?php	endif; 
		endforeach;?>						
		<?php if ($datoseconomicos['coste']):?>
		<dt>Coste</dt>
		<dd><strong><?php echo $this->Format->money($datoseconomicos['coste'])."  (".$this->Format->number($datoseconomicos['coste']/$datoseconomicos['total']*100)." % del total)"; ?>&nbsp;</strong></dd>
		<dt>Beneficio</dt>
		<?php $beneficio = $datoseconomicos['subtotal']-$datoseconomicos['coste'];
			  $pbeneficio = $this->Format->number($beneficio/$datoseconomicos['total']*100); 
		?>
		<dd><strong><?php echo $this->Format->money($beneficio) ." ($pbeneficio % del total)"; ?>&nbsp;</strong></dd>
		<?php endif;?>
		<dt class="total">Total</dt>		
		<dd class="total"><strong><?php echo $this->Format->money($datoseconomicos['total']); ?>&nbsp;</strong></dd>
	</dl>
</div>