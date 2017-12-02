<?php  
	$divclass = "pdf";
if(!$print):
	$divclass ="preview";
?>
<div class="title">
<?php echo $this->Html->image($icono, array('title'=>$titulo,'class'=>'imagentitulo')) ;?><h1><?php echo $titulo;?></h1>
	<div class="actions">
	<?php	
	echo $this->Html->link($this->Html->image("back.png",array('title'=>'Volver a la factura')), array('controller'=>'tajos', 'action' => 'view',$tajo['Tajo']['id']), array( 'escape' => false) );	
	echo $this->Html->link($this->Html->image("email.png",array('title'=>'Enviar por email')), array('action' => 'email',  $tajo['Tajo']['id'],$tajo['Proyecto']['Empresa']['email']),array('escape' => false));		
	echo $this->Html->link($this->Html->image("pdf.png",array('title'=>'Descargar pdf')), array('action' => 'pdf',  $tajo['Tajo']['id'],md5($tajo['Tajo']['id'])),array('escape' => false));		
	echo $this->Html->link($this->Html->image('entregada.png',array('title'=>'Marcar como entregado')), array('action' => 'entregado',  $tajo['Tajo']['id']),array('escape' => false), sprintf('¿Seguro que desea marcar el presupuesto como entregada?'));
	?>
	</div>	
</div>
<?php endif;?>
<div class="<?php echo $divclass;?>"> 
	<div id="f_header">
		<table>
			<tr>
				<td>
					<?php echo $this->Html->image('letraslogo.png',array("style"=>'height:50px;'))?>
					<h2><?php echo LEMA_EMPRESARIAL;?></h2>					
						<p><b><?php echo $misdatos['direccion'] ;?></b></p>
					<p><b><?php echo $misdatos['telefono_fijo'] ." ".$misdatos['telefono_movil'];?></b></p>
					<p><b><?php echo $misdatos['email'];?></b></p>
					<p><b>Nif:<?php echo $misdatos['cif'];?></b></p>
				</td>
				<td style="text-align:right;">					
					<h1>PRESUPUESTO</h1>
					<p><b>Fecha: <?php echo $this->Format->date($tajo['Tajo']['fecha']);?></b></p>		
					<p><b>Presupuesto: <?php echo $tajo['Tajo']['npresupuesto'];?></b></p>
								
				</td>
			</tr>
		</table>		
	</div>
	
	<div id="f_cliente">															
		<table>
			<tr>										
				<td><h3>Cliente</h3><?php echo $tajo['Proyecto']['Empresa']['nombre']?></td>
			</tr>
			<tr>							
				<td><?php echo $tajo['Proyecto']['Empresa']['cif']?></td>
			</tr>
			<tr>							
				<td><?php echo $tajo['Proyecto']['Empresa']['direccion'] ;?></td>
			</tr>
		</table>					
	</div>	
	
	<div id="f_informe">
		<table>
			<tr>
				<td>
					<h3>Informe técnico:</h3>
					<?php echo $tajo['Tajo']['descripcion'];?>						
				</td>
			</tr>
		</table>		
	</div>
	
	<?php 
	$descuento = false;
	$colspan = 3;
	foreach ($conceptos as $concepto){		
		foreach ($concepto as $apunte){
			if ($apunte['pdescuento'] != 0){
				$descuento = true;
				$colspan = 4;
			}
		}
	}
	?>
	
	<div id="f_conceptos">
		<table cellpadding = "5" cellspacing = "0">
			<tr>			
				<th style="text-align:center;"><?php echo __('Nombre'); ?></th>
				<th style="text-align:center;" width="50px"><?php echo __('Cantidad'); ?></th>		
				<th style="text-align:center;" width="100px"><?php echo __('Precio (u)'); ?></th>					
				<?php if($descuento):?>
					<th style="text-align:center;" width="100px"><?php echo __('Descuento'); ?></th>
				<?php endif;?>	
				<th style="text-align:center;" width="100px"><?php echo __('Subtotal'); ?></th>															
			</tr>					
			<?php										
				foreach ($conceptos as $concepto):		
					foreach ($concepto as $apunte):										
			?>									
				<td style="text-align:left;"><?php echo $apunte['nombre'];?></td>
				<td style="text-align:right;"><?php echo $this->Format->number($apunte['cantidad']);?></td>				
				<td style="text-align:right;"><?php echo $this->Format->money($apunte['precio']);?></td>					
				<?php if($descuento):?>
					<td style="text-align:right;"><?php echo $this->Format->number($apunte['pdescuento']).' %';?></td>
				<?php endif;?>
				<td style="text-align:right;"><?php echo $this->Format->money($apunte['cantidad']*$apunte['precio']* (1-$apunte['pdescuento']/100.00)) ;?></td>												
			</tr>
			<?php endforeach; endforeach;?>
			<tr>				
				<td colspan="<?php echo $colspan;?>" style="border-top:1px solid #000;">&nbsp;</td>
				<td style="border-top:1px solid #000;">&nbsp;</td>					
			</tr>				
			<tr>				
				<td colspan="<?php echo $colspan;?>" style="text-align:right;"><b>Subtotal</b></td>
				<td style="text-align:right;" ><strong><?php echo $this->Format->money($datoseconomicos['subtotal']); ?>&nbsp;</strong></td>
			</tr>				
			<?php if ($datoseconomicos['descuento']):?>
			<tr>				
				<td colspan="<?php echo $colspan;?>" style="text-align:right;"><b>Descuento</b></td>
				<td style="text-align:right;" ><strong><?php echo $this->Format->money($datoseconomicos['descuento']); ?>&nbsp;</strong></td>
			</tr>	
			<?php 
			endif;
			
			foreach ($datoseconomicos['impuestos'] as $nombre => $valor):	
				if($valor > 0): ?>	
				<tr>					
					<td colspan="<?php echo $colspan;?>" style="text-align:right;"><b><?php echo ($nombre);?></b></td>
					<td style="text-align:right;" ><strong><?php echo $this->Format->money($valor); ?>&nbsp;</strong></td>
				</tr>	
					
			<?php endif; 
			endforeach;?>	
			<tr>				
				<td colspan="<?php echo $colspan;?>" style="text-align:right;"><b>Total</b></td>
				<td style="text-align:right;" ><strong><?php echo $this->Format->money($datoseconomicos['total']); ?>&nbsp;</strong></td>
			</tr>								
		</table>
	</div>		
	
	<div id="f_footer"  style="position: fixed; bottom: -10mm; left: 0;<?php if ($divclass =='preview') echo "display:none";?>">
		<table>
			<tr>
				<td><b>Validez:</b>  <?php echo VALIDEZ_PRESUPUESTO;?></td>
			</tr>
			<tr>
				<td><b><?php echo CIERRE_PAG;?></td>
			</tr>
		</table>			
	</div>
	<!--footer ends-->
</div> 
		
	
