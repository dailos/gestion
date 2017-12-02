<div class="title">
<?php echo $this->Html->image($icono, array('title'=>$titulo,'class'=>'imagentitulo')) ;?><h1><?php echo $titulo;?></h1>
	<div class="actions">
	<?php
		echo $this->Html->link($this->Html->image("back.png"), array('action' => 'index'), array('escape' => false)); 
		echo $this->Js->link($this->Html->image('edit.png',array('title'=>'Editar')),array( 'action'=>'edit',$proyecto['Proyecto']['id']),array('escape'=>false,'update' => 'maindata'),null,false);				
		echo $this->Html->link($this->Html->image('del.png',array('title'=>'Eliminar')), array('action' => 'delete',$proyecto['Proyecto']['id']), array('escape' => false), sprintf('¿Seguro que desea eliminar el proyecto, perderá todos los datos asociados a él?', $proyecto['Proyecto']['id']));
	?>
	</div>	
</div>

<div class="proyectos view" >
	<div id='maindata'>
		<dl><?php $i = 0; $class = ' class="altrow"';?>	
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Descripción'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $proyecto['Proyecto']['descripcion']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Fecha inicio'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $this->Format->date($proyecto['Proyecto']['fechapedido']);  ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Estado'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $estadosproyecto[$proyecto['Proyecto']['estado_id']]; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Cliente'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $this->Html->link($proyecto['Empresa']['nombre'], array('controller' => 'empresas', 'action' => 'view', $proyecto['Empresa']['id'])); ?>
				&nbsp;
			</dd>
			
		</dl>
		<div id="economicos">
	<dl>		
		<dt>Subtotal</dt>
		<dd><strong><?php echo $this->Format->money($d_eco_pro['subtotal']); ?>&nbsp;</strong></dd>
		<?php if ($d_eco_pro['descuento']):?>
		<dt>Descuento</dt>
		<dd><strong><?php echo $this->Format->money($d_eco_pro['descuento']); ?>&nbsp;</strong></dd>
		<?php endif;?>
	<?php foreach ($d_eco_pro['impuestos'] as $nombre => $valor):
	if($valor > 0): ?>		
		<dt><?php echo $nombre;?></dt>
		<dd><strong><?php echo $this->Format->money($valor); ?>&nbsp;</strong></dd>
	<?php	endif; 
		endforeach;?>	
		<dt>Pres. sin ejecutar</dt>				
		<dd ><strong><?php echo $this->Format->money($presupuestado); ?>&nbsp;</strong></dd>					
	<?php if ($proyecto['Proyecto']['coste']):?>
		<dt>Coste</dt>
		<dd><strong><?php echo $this->Format->money($proyecto['Proyecto']['coste'])." (".round($proyecto['Proyecto']['coste']/$proyecto['Proyecto']['total']*100,2)." %)"; ?>&nbsp;</strong></dd>
		<dt>Beneficio</dt>		
		<dd><strong><?php echo $this->Format->money($proyecto['Proyecto']['beneficio'])." (".round($proyecto['Proyecto']['beneficio']/$proyecto['Proyecto']['total']*100,2)." %)"; ?>&nbsp;</strong></dd>				
		<dt><?php echo __('Pendiente');?></dt>
		<dd><strong><?php echo $this->Format->money($proyecto['Proyecto']['pendiente'])."  (".round($proyecto['Proyecto']['pendiente']/$proyecto['Proyecto']['total'] * 100,2) ." %)"; ?>&nbsp;</strong></dd>
	<?php endif;?>					
		<dt >Total Facturado</dt>				
		<dd ><strong><?php echo $this->Format->money($proyecto['Proyecto']['facturado']) ."  (". round($proyecto['Proyecto']['facturado']/$proyecto['Proyecto']['total'] * 100,2) ." %)"; ?>&nbsp;</strong></dd>
		<dt class="total">Total</dt>		
		<dd class="total"><strong><?php echo $this->Format->money($proyecto['Proyecto']['total']); ?>&nbsp;</strong></dd>
	</dl>
</div>	
		
	</div>	
	
<?php 
$tajos = array();
$presupuestos = array();
foreach ($proyecto['Tajo'] as $tajo){
	if($tajo['referencia']) $tajos[]=$tajo;
	if($tajo['npresupuesto']) $presupuestos[] = $tajo;
}
echo $this->element('gestordocumental', array('documentos' =>$proyecto['Documento'],'fk_name' => 'proyecto_id','fk_id' =>$proyecto['Proyecto']['id']));
?>
	
	<div id="tabs">
	    <ul>
	        <li id="tabHeaderActive"><a href="javascript:void(0)" onClick="toggleTab(1,3)"><span>Tajos</span></a></li>
	        <li id="tabHeader2"><a href="javascript:void(0)" onClick="toggleTab(2,3)" ><span>Facturas</span></a></li>
	        <li id="tabHeader3"><a href="javascript:void(0)" onclick="toggleTab(3,3)"><span>Presupuestos</span></a></li>
	    </ul>
	</div>
	
	<div id="tabscontent">
		<div id="tabContent1" class="tabContent" style="display:yes;">    	
			<div class="actionstabs">
				<?php echo $this->Html->link($this->Html->image('add.png',array('title'=>'Crear nuevo')), array('controller' => 'tajos', 'action' => 'add',$proyecto['Proyecto']['id']), array('escape' => false));?>
			</div>
			<div class="tabcontendata">
				<?php if (!empty($tajos)):?>
				<table cellpadding = "0" cellspacing = "0">
				<tr>			
					<th style="width:70px;"><?php echo __('Referencia'); ?></th>
					<th><?php echo __('Descripción'); ?></th>
					<th style="width:70px;"><?php echo __('Fecha'); ?></th>					
					<th><?php echo __('Empleados'); ?></th>
					<th><?php echo __('Factura'); ?></th>
					<th><?php echo __('Presupuesto'); ?></th>
					<th style="text-align:right;width:70px;"><?php echo __('Total'); ?></th>
				</tr>
				<?php foreach ($tajos as $tajo):				
					$i++;
						echo $this->element('trclass',array('i' =>$i,'url' => '/tajos/view/'.$tajo['id']));?>
					<td><?php echo $tajo['referencia'];?></td>
					<td><?php echo $tajo['descripcion'];?></td>
					<td><?php echo $this->Format->date($tajo['fecha']);?></td>					
					<td><?php 
						foreach ($tajo['Empleado'] as $empleado) 
							echo $this->Html->link($empleado['nombre'],array('controller'=>'empleados','action'=>'view',$empleado['id'])). " ";?></td>
					<td><?php if (isset ($tajo['Factura']['nfactura'])) echo $this->Html->link($tajo['Factura']['nfactura'], array('controller'=>'facturas', 'action' => 'view',$tajo['Factura']['id']));
							 else echo $this->Html->image('no.png');?></td>
					<td><?php if (isset ($tajo['npresupuesto'])) echo $this->Html->link($tajo['npresupuesto'], array('controller'=>'tajos', 'action' => 'viewpresupuesto',$tajo['id']));
							 else echo $this->Html->image('no.png');?></td>
					<td style="text-align:right;"><?php echo $this->Format->money($tajo['total']);?></td>	
					</tr>
				<?php  endforeach; ?>
				</table>
				<?php else: echo "<h2>No existen tajos asociados</h2>";endif; ?>				
			</div>
		</div>
		
	    <div id="tabContent2" class="tabContent" style="display:none;">    	
	    	<div class="actionstabs">
			<br/><br/>	
			</div>		
			<div class="tabcontendata">
			<?php if (!empty($proyecto['Factura'])):?>
				<table cellpadding = "0" cellspacing = "0">
				<tr>
					<th style="width:70px;"><?php echo __('Nº factura'); ?></th>
					<th><?php echo __('Descripcion'); ?></th>
					<th style="width:70px;"><?php echo __('Fecha'); ?></th>																	
					<th style="text-align:right;width:70px;"><?php echo __('Total'); ?></th>
					<th style="text-align:right;width:70px;"><?php echo __('Pendiente'); ?></th>
					<th><?php echo __('Estado'); ?></th>
					<th><?php echo __('Prevcobro'); ?></th>
				</tr>
				<?php foreach ($proyecto['Factura'] as $factura):
					  	$i++;
						echo $this->element('trclass',array('i' =>$i,'url' => '/facturas/view/'.$factura['id']));?>							
					<td><?php echo $factura['nfactura'];?></td>
					<td><?php echo $factura['descripcion'];?></td>
					<td><?php echo $this->Format->date($factura['fecha']);?></td>															
					<td style="text-align:right;"><?php echo $this->Format->money($factura['total']);?></td>
					<td style="text-align:right;"><?php echo $this->Format->money($factura['pendiente']);?></td>
					<td><?php echo $estadosfactura[$factura['estado_id']];?></td> 
					<td><?php echo $this->Format->date($factura['prevcobro']);?></td>
				</tr>
			<?php endforeach; ?>
			</table>
			<?php else: 
				echo "<h2>No existen facturas asociadas</h2>";
			endif; ?>
		   </div>
		</div>
	    <div id="tabContent3" class="tabContent" style="display:none;">    	
			<div class="actionstabs">
				<?php echo $this->Html->link($this->Html->image('add.png',array('title'=>'Crear nuevo')), array('controller' => 'tajos', 'action' => 'addpresupuesto',$proyecto['Proyecto']['id']), array('escape' => false));?>
			</div>
			<div class="tabcontendata">
				<?php if (!empty($presupuestos)):?>
				<table cellpadding = "0" cellspacing = "0">
				<tr>
					<th style="width:70px;"><?php echo __('nº presupuesto'); ?></th>
					<th><?php echo __('Descripción'); ?></th>		
					<th style="width:70px;"><?php echo __('Fecha'); ?></th>							
					<th><?php echo __('Factura'); ?></th>
					<th><?php echo __('Referencia del tajo'); ?></th>					
					<th style="text-align:right;width:70px;"><?php echo __('Total'); ?></th>					
				</tr>
					<?php foreach ($presupuestos as $presupuesto):						
						$i++;
						echo $this->element('trclass',array('i' =>$i,'url' => '/tajos/viewpresupuesto/'.$presupuesto['id']));?>								
						<td><?php echo $presupuesto['npresupuesto'];?></td>
						<td><?php echo $presupuesto['descripcion'];?></td>
						<td><?php echo $this->Format->date($presupuesto['fecha']);?></td>																		
						<td><?php if (isset ($presupuesto['Factura']['nfactura'])) echo $this->Html->link($presupuesto['Factura']['nfactura'], array('controller'=>'facturas', 'action' => 'view',$presupuesto['Factura']['id']));
							 else echo $this->Html->image('no.png');?></td>
						<td><?php if (isset ($presupuesto['referencia'])) echo $this->Html->link($presupuesto['referencia'], array( 'action' => 'view',$presupuesto['id']));
							 else echo $this->Html->image('no.png');?></td>					
						<td style="text-align:right;"><?php echo $this->Format->money($presupuesto['total']);?></td>	
					</tr>
					<?php  endforeach; ?>
				</table>
				<?php 
					else: 
					echo "<h2>No existen presupuestos asociados</h2>";
					endif; 
				?>
		    </div>    
		 </div>
	</div>
</div>

