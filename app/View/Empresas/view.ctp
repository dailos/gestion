<?php 
$id = $empresa['Empresa']['id'];
?>
<div class="title">
<?php echo $this->Html->image($icono, array('title'=>$titulo,'class'=>'imagentitulo')) ;?><h1><?php echo $titulo;?></h1>
	<div class="actions">
	<?php	
	if($id != SISTEMA)
		echo $this->Html->link($this->Html->image("back.png"), array('action' => 'index'), array('escape' => false)); 
	echo $this->Js->link($this->Html->image('edit.png',array('title'=>'Editar')),array( 'action'=>'edit',$id),array('escape'=>false,'update' => 'maindata'),null,false);	
	if($id != SISTEMA)			
		echo $this->Html->link($this->Html->image('del.png',array('title'=>'Eliminar')), array('action' => 'delete',$id), array('escape' => false), sprintf('¿Seguro que desea eliminar el contacto?', $id));		
	?>
	</div>	
</div>
<div class="empresas view">
	<div id='maindata'>
	<dl><?php $i = 0; $class = ' class="altrow"';?>				
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Cif'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $empresa['Empresa']['cif']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Dirección'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $empresa['Empresa']['direccion']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Teléfono fijo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $empresa['Empresa']['telefono_fijo']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Teléfono móvil'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $empresa['Empresa']['telefono_movil']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Fax'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $empresa['Empresa']['fax']; ?>
			&nbsp;
		</dd>		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Email'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $empresa['Empresa']['email']; ?>
			&nbsp;
		</dd>				
		
		<?php if($id != SISTEMA):?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Relación'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $relaciones[$empresa['Empresa']['relacion_id']]; ?>
			&nbsp;
		</dd>
		<?php endif;?>
	</dl>
	</div>
<?php 
if($id != SISTEMA):
	switch ($empresa['Empresa']['relacion_id']){
		case OTRA: $fin = 1;break;
		case CLIENTE: $fin = 5;break;
		case PROVEEDOR: $fin = 4;break;
		case CLIENTEYPROVEEDOR: $fin = 8;		
	}	
	$ini = 1;
	
	echo $this->element('gestordocumental', array('documentos' =>$empresa['Documento'],'fk_name' => 'empresa_id','fk_id' =>$empresa['Empresa']['id']));
?>

	<div id="tabs">
	    <ul>
	        <li id="tabHeaderActive"><a href="javascript:void(0)" onclick="toggleTab(<?php echo $ini++.",".$fin;?>)"><span>Empleados</span></a></li>
	        <?php if ($empresa['Empresa']['relacion_id'] == CLIENTE || $empresa['Empresa']['relacion_id'] == CLIENTEYPROVEEDOR):?>
	        <li id="tabHeader<?php echo $ini;?>"><a href="javascript:void(0)" onClick="toggleTab(<?php echo $ini++.",".$fin;?>)"><span>Proyectos</span></a></li>
	        <li id="tabHeader<?php echo $ini;?>"><a href="javascript:void(0)" onClick="toggleTab(<?php echo $ini++.",".$fin; ?>)" ><span>Facturas</span></a></li>
	        <li id="tabHeader<?php echo $ini;?>"><a href="javascript:void(0)" onclick="toggleTab(<?php echo $ini++.",".$fin;?>)"><span>Tajos</span></a></li>
	        <li id="tabHeader<?php echo $ini;?>"><a href="javascript:void(0)" onclick="toggleTab(<?php echo $ini++.",".$fin;?>)"><span>Presupuestos</span></a></li>
	        <?php endif;  if ($empresa['Empresa']['relacion_id'] == PROVEEDOR || $empresa['Empresa']['relacion_id'] == CLIENTEYPROVEEDOR):?>
	        <li id="tabHeader<?php echo $ini;?>"><a href="javascript:void(0)" onClick="toggleTab(<?php echo $ini++.",".$fin;?>)" ><span>Pedidos</span></a></li>
	        <li id="tabHeader<?php echo $ini;?>"><a href="javascript:void(0)" onclick="toggleTab(<?php echo $ini++.",".$fin; ?>)"><span>Albaranes</span></a></li>
	        <li id="tabHeader<?php echo $ini;?>"><a href="javascript:void(0)" onclick="toggleTab(<?php echo $ini++.",".$fin;?>)"><span>Gastos</span></a></li>
	       <?php endif;?>
	    </ul>
	</div>
	
	<?php $ini = 2;?>
	
	<div id="tabscontent">
	
		<div id="tabContent1" class="tabContent" style="display:yes;">    	
			<div class="actionstabs">
				<?php echo $this->Html->link($this->Html->image('add.png',array('title'=>'Crear nuevo')), array('controller' => 'empleados', 'action' => 'add',$id), array('escape' => false));?>
			</div>
			<div class="tabcontendata">
				<?php if (!empty($empresa['Empleado'])):?>
				<table cellpadding = "0" cellspacing = "0">
				<tr>			
					<th><?php echo __('Nombre'); ?></th>
					<th><?php echo __('Apellidos'); ?></th>
					<th><?php echo __('Cargo'); ?></th>
					<th><?php echo __('Horario'); ?></th>
					<th><?php echo __('Teléfono'); ?></th>
					<th><?php echo __('Móvil'); ?></th>
					<th><?php echo __('E-mail'); ?></th>
				</tr>
				<?php foreach ($empresa['Empleado'] as $empleado):
						$i++;
						echo $this->element('trclass',array('i' =>$i,'url' => '/empleados/view/'.$empleado['id']));?>
						<td><?php echo $empleado['nombre'];?></td>
						<td><?php echo $empleado['apellidos'];?></td>
						<td><?php echo $empleado['cargo'];?></td>
						<td><?php echo $empleado['horario'];?></td>
						<td><?php echo $empleado['telefono'];?></td>
						<td><?php echo $empleado['movil'];?></td>
						<td><?php echo $empleado['email'];?></td>
					</tr>
				<?php endforeach; ?>
				</table>
				<?php else: echo "<h2>No existen empleados asociados</h2>";endif; ?>
			</div>
		</div>
	
		<?php if ($empresa['Empresa']['relacion_id'] == CLIENTE || $empresa['Empresa']['relacion_id'] == CLIENTEYPROVEEDOR):?>
	
		<div id="tabContent<?php echo $ini++;?>" class="tabContent" style="display:none;">    	
			<div class="actionstabs">
				<?php echo $this->Html->link($this->Html->image('add.png',array('title'=>'Crear nuevo')), array('controller' => 'proyectos', 'action' => 'add',$id), array('escape' => false));?>
			</div>
			<div class="tabcontendata">
				<?php if (!empty($empresa['Proyecto'])):?>
					<table cellpadding = "0" cellspacing = "0">
					<tr>			
						<th><?php echo __('Título'); ?></th>
						<th><?php echo __('Descripción'); ?></th>
						<th><?php echo __('Coste'); ?></th>
						<th><?php echo __('Beneficio'); ?></th>
						<th><?php echo __('Pendiente'); ?></th>
						<th><?php echo __('Facturado'); ?></th>
						<th><?php echo __('Total'); ?></th>
						<th><?php echo __('Estado'); ?></th>
					</tr>
					<?php
					$facturas = array(); 
					$presupuestos = array();
					$tajos = array();
					foreach ($empresa['Proyecto'] as $proyecto):
						$i++;						
						echo $this->element('trclass',array('i' =>$i,'url' => '/proyectos/view/'.$proyecto['id']));?>
						<td><?php echo $proyecto['titulo'];?></td>
						<td><?php echo $proyecto['descripcion'];?></td>
						<td><?php echo $this->Format->money($proyecto['coste']);?></td>
						<td><?php echo $this->Format->money($proyecto['beneficio']);?></td>
						<td><?php echo $this->Format->money($proyecto['pendiente']);?></td>
						<td><?php echo $this->Format->money($proyecto['facturado']);?></td>
						<td><?php echo $this->Format->money($proyecto['total']);?></td>
						<td><?php echo $estadosproyecto[$proyecto['estado_id']];?></td>
						
					</tr>
					<?php 				
					foreach ($proyecto['Factura'] as $value) $facturas[] = $value;						
					foreach ($proyecto['Tajo'] as $value){ 
						if($value['referencia']) $tajos[]=$value;
						if($value['npresupuesto']) $presupuestos[] = $value;
					}																		
					endforeach; ?>
					</table>
				<?php else: echo "<h2>No existen proyectos asociados</h2>";endif; ?>
			</div>
		</div>
		
		<div id="tabContent<?php echo $ini++;?>" class="tabContent" style="display:none;">    				
			<div class="tabcontendata">
				<?php if (!empty($facturas)):?>
				<table cellpadding = "0" cellspacing = "0">
				<tr>			
					<th><?php echo __('Referencia'); ?></th>
					<th><?php echo __('Proyecto'); ?></th>
					<th><?php echo __('Descripción'); ?></th>
					<th><?php echo __('Fecha'); ?></th>
					<th><?php echo __('Total'); ?></th>
					<th><?php echo __('Pendiente'); ?></th>	
					<th><?php echo __('Estado'); ?></th>					
				</tr>
				<?php foreach ($facturas as $factura):
						$i++;
						echo $this->element('trclass',array('i' =>$i,'url' => '/facturas/view/'.$factura['id']));?>
						<td><?php echo $factura['nfactura'];?></td>
						<td><?php echo $this->Html->link($factura['Proyecto']['titulo'],array('controller'=>'proyectos', 'action' => 'view', $factura['proyecto_id']));?></td>
						<td><?php echo $factura['descripcion'];?></td>
						<td><?php echo $this->Format->date($factura['fecha']);?></td>
						<td><?php echo $this->Format->money($factura['total']);?></td>
						<td><?php echo $this->Format->money($factura['pendiente']);?></td>
						<td><?php echo $estadosfactura[$factura['estado_id']];?></td>
					</tr>
				<?php endforeach; ?>
				</table>
				<?php else: echo "<h2>No existen facturas asociadas</h2>";endif; ?>
			</div>
		</div>
		
		<div id="tabContent<?php echo $ini++;?>" class="tabContent" style="display:none;">    				
			<div class="tabcontendata">
				<?php if (!empty($tajos)):?>
				<table cellpadding = "0" cellspacing = "0">
				<tr>			
					<th><?php echo __('Referencia'); ?></th>				
					<th><?php echo __('Descripción'); ?></th>
					<th><?php echo __('Factura'); ?></th>
					<th><?php echo __('Presupuesto'); ?></th>
					<th><?php echo __('Fecha'); ?></th>	
					<th><?php echo __('Proyecto'); ?></th>
					<th><?php echo __('Total'); ?></th>						
				</tr>
				<?php foreach ($tajos as $tajo):
						$i++;
						echo $this->element('trclass',array('i' =>$i,'url' => '/tajos/view/'.$tajo['id']));?>
						<td><?php echo $tajo['referencia'];?></td>
						<td><?php echo $tajo['descripcion'];?></td>
						<td><?php if (isset ($tajo['Factura']['nfactura'])) echo $this->Html->link($tajo['Factura']['nfactura'], array('controller'=>'facturas', 'action' => 'view',$tajo['Factura']['id']));
							 else echo $this->Html->image('no.png');?></td>
						<td><?php if (isset ($tajo['npresupuesto'])) echo $this->Html->link($tajo['npresupuesto'], array( 'action' => 'viewpresupuesto',$tajo['id']));
							 else echo $this->Html->image('no.png');?></td>
						<td><?php echo $this->Format->date($tajo['fecha']);?></td>
						<td><?php echo $this->Html->link($tajo['Proyecto']['titulo'],array('controller'=>'proyectos', 'action' => 'view', $tajo['proyecto_id']));?></td>
						<td><?php echo $this->Format->money($tajo['total']);?></td>									
					</tr>
				<?php endforeach; ?>
				</table>
				<?php else: echo "<h2>No existen presupuestos asociados</h2>";endif; ?>
			</div>
		</div>
		
		<div id="tabContent<?php echo $ini++;?>" class="tabContent" style="display:none;">  				
			<div class="tabcontendata">
				<?php if (!empty($presupuestos)):?>
				<table cellpadding = "0" cellspacing = "0">
				<tr>			
					<th><?php echo __('Nº Presupuesto'); ?></th>				
					<th><?php echo __('Descripción'); ?></th>
					<th><?php echo __('Factura'); ?></th>
					<th><?php echo __('Referencia del tajo'); ?></th>
					<th><?php echo __('Fecha'); ?></th>		
					<th><?php echo __('Proyecto'); ?></th>
					<th><?php echo __('Total'); ?></th>
				</tr>
				<?php foreach ($presupuestos as $presupuesto):
						$i++;
						echo $this->element('trclass',array('i' =>$i,'url' => '/tajos/viewpresupuesto/'.$presupuesto['id']));?>
						<td><?php echo $presupuesto['npresupuesto'];?></td>
						<td><?php echo $presupuesto['descripcion'];?></td>
						<td><?php if (isset ($presupuesto['Factura']['nfactura'])) echo $this->Html->link($presupuesto['Factura']['nfactura'], array('controller'=>'facturas', 'action' => 'view',$presupuesto['Factura']['id']));
							 else echo $this->Html->image('no.png');?></td>
						<td><?php if (isset ($presupuesto['referencia'])) echo $this->Html->link($presupuesto['referencia'], array( 'action' => 'view',$presupuesto['id']));
							 else echo $this->Html->image('no.png');?></td>	
						<td><?php echo $this->Format->date($presupuesto['fecha']);?></td>	
						<td><?php echo $this->Html->link($presupuesto['Proyecto']['titulo'],array('controller'=>'proyectos', 'action' => 'view', $presupuesto['proyecto_id']));?></td>									
						<td><?php echo $this->Format->money($presupuesto['total']);?></td>	
					</tr>
				<?php endforeach; ?>
				</table>
				<?php else: echo "<h2>No existen presupuestos asociados</h2>";endif; ?>
			</div>
		</div>
		
		<?php endif;  if ($empresa['Empresa']['relacion_id'] == PROVEEDOR || $empresa['Empresa']['relacion_id'] == CLIENTEYPROVEEDOR):?>				
		
		<?php 
		$albaranes = array();
		$pedidos = array();
			foreach ($empresa['Albaran'] as $value){				
				if($value['referencia']) $albaranes[]=$value;
				if($value['npedido']) $pedidos[] = $value;
			}		
		?>
		<div id="tabContent<?php echo $ini++;?>" class="tabContent" style="display:none;">    	
			<div class="actionstabs">
				<?php echo $this->Html->link($this->Html->image('add.png',array('title'=>'Crear nuevo')), array('controller' => 'albaranes', 'action' => 'addpedido',$id), array('escape' => false));?>
			</div>
			<div class="tabcontendata">
				<?php if (!empty($pedidos)):?>
				<table cellpadding = "0" cellspacing = "0">
				<tr>			
					<th><?php echo __('Nº pedido'); ?></th>
					<th><?php echo __('Descripción'); ?></th>
					<th><?php echo __('Fecha'); ?></th>	
					<th><?php echo __('Albarán'); ?></th>
					<th><?php echo __('Gasto'); ?></th>
				</tr>
				<?php foreach ($pedidos as $pedido):							
						$i++;
						echo $this->element('trclass',array('i' =>$i,'url' => '/albaranes/viewpedido/'.$pedido['id']));?>
						<td><?php echo $pedido['npedido'];?></td>
						<td><?php echo $pedido['descripcion'];?></td>
						<td><?php echo $this->Format->date($pedido['fecha']);?></td>		
						<td><?php if (isset ($pedido['referencia'])) echo $this->Html->link($pedido['referencia'], array('controller'=>'albaranes', 'action' => 'view',$pedido['id']));
							 else echo $this->Html->image('no.png');?></td>		
						<td><?php if (isset ($pedido['Gasto']['referencia'])) echo $this->Html->link($pedido['Gasto']['referencia'], array('controller'=>'gastos', 'action' => 'view',$pedido['Gasto']['id']));
							 else echo $this->Html->image('no.png');?></td>
											
					</tr>
				<?php endforeach; ?>
				</table>
				<?php else: echo "<h2>No existen pedidos asociados</h2>";endif; ?>
			</div>
		</div>
				
		<div id="tabContent<?php echo $ini++;?>" class="tabContent" style="display:none;">    	
			<div class="actionstabs">
				<?php echo $this->Html->link($this->Html->image('add.png',array('title'=>'Crear nuevo')), array('controller' => 'albaranes', 'action' => 'add',$id), array('escape' => false));?>
			</div>
			<div class="tabcontendata">
				<?php if (!empty($albaranes)):?>
				<table cellpadding = "0" cellspacing = "0">
				<tr>
					<th><?php echo __('Referencia'); ?></th>				
					<th><?php echo __('nº albarán'); ?></th>									
					<th><?php echo __('Fecha'); ?></th>
					<th><?php echo __('Pedido'); ?></th>
					<th><?php echo __('Gasto'); ?></th>
					<th><?php echo __('Descripción'); ?></th>												
					<th><?php echo __('Total'); ?></th>					
				</tr>
				<?php foreach ($albaranes as $albaran):
						$i++;
						echo $this->element('trclass',array('i' =>$i,'url' => '/albaranes/view/'.$albaran['id']));?>
						<td><?php echo $albaran['referencia'];?></td>
						<td><?php echo $albaran['nalbaran'];?></td>												
						<td><?php echo $this->Format->date($albaran['fecha']);?></td>
						<td><?php if (isset ($albaran['npedido'])) echo $this->Html->link($albaran['npedido'], array('controller'=>'albaranes', 'action' => 'viewpedido',$albaran['id']));
							 else echo $this->Html->image('no.png');?></td>
						<td><?php if (isset ($albaran['Gasto']['referencia'])) echo $this->Html->link($albaran['Gasto']['referencia'], array('controller'=>'gastos', 'action' => 'view',$albaran['Gasto']['id']));
							 else echo $this->Html->image('no.png');?></td>
						<td><?php echo $albaran['descripcion'];?></td>												
						<td><?php echo $this->Format->money($albaran['total']);?></td>						
					</tr>
				<?php endforeach; ?>
				</table>
				<?php else: echo "<h2>No existen albaranes asociados</h2>";endif; ?>
			</div>
		</div>
				
		<div id="tabContent<?php echo $ini++;?>" class="tabContent" style="display:none;">    				
			<div class="tabcontendata">
				<?php if (!empty($empresa['Gasto'])):?>
				<table cellpadding = "0" cellspacing = "0">
				<tr>
					<th><?php echo __('Referencia'); ?></th>			
					<th><?php echo __('nº factura'); ?></th>					
					<th><?php echo __('Fecha'); ?></th>
					<th><?php echo __('Descripción'); ?></th>
					<th><?php echo __('Total'); ?></th>
					<th><?php echo __('Pendiente'); ?></th>								
				</tr>
				<?php foreach ($empresa['Gasto'] as $gasto):
						$i++;
						echo $this->element('trclass',array('i' =>$i,'url' => '/gastos/view/'.$gasto['id']));?>
						<td><?php echo $gasto['referencia'];?></td>
						<td><?php echo $gasto['nfactura'];?></td>						
						<td><?php echo $this->Format->date($gasto['fecha']);?></td>
						<td><?php echo $gasto['descripcion'];?></td>
						<td><?php echo $this->Format->money($gasto['total']);?></td>
						<td><?php echo $this->Format->money($gasto['pendiente']);?></td>						
					</tr>
				<?php endforeach; ?>
				</table>
				<?php else: echo "<h2>No existen gastos asociados</h2>";endif; ?>
			</div>
		</div>
		
		<?php endif;?>	
	
	</div>
	<?php endif;?>	
</div>