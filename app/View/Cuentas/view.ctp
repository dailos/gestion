<div class="title">
<?php echo $this->Html->image($icono, array('title'=>$titulo,'class'=>'imagentitulo')) ;?><h1><?php echo $titulo;?></h1>
	<div class="actions">
	<?php
	echo $this->Html->link($this->Html->image("back.png"), array( 'action' => 'index'), array( 'escape' => false) );
	echo $this->Js->link($this->Html->image('edit.png',array('title'=>'Editar')),array( 'action'=>'edit',$cuenta['Cuenta']['id']),array('escape'=>false,'update' => 'maindata'),null,false);
	echo $this->Html->link($this->Html->image('del.png',array('title'=>'Eliminar')), array('action' => 'delete', $cuenta['Cuenta']['id']),array('escape' => false), sprintf('¿Seguro que desea eliminar la cuenta?',$cuenta['Cuenta']['id']));
	?>
	</div>	
</div>

<div class="cuentas view">
	<div id="maindata">
	<dl><?php $i = 0; $class = ' class="altrow"';?>		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Ccc'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cuenta['Cuenta']['ccc']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Notas'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $cuenta['Cuenta']['notas']; ?>
			&nbsp;
		</dd>
	</dl>
	
	</div>
<?php echo $this->element('gestordocumental', array('documentos' =>$cuenta['Documento'],'fk_name' => 'cuenta_id','fk_id' =>$cuenta['Cuenta']['id']));?>
	<div id="tabs">
	    <ul>
	        <li id="tabHeaderActive"><a href="javascript:void(0)" onClick="toggleTab(1,1)"><span>Cobros y Pagos</span></a></li>	        
	    </ul>
	</div>

<div id="tabscontent">
	    <div id="tabContent1" class="tabContent" style="display:yes;">    						
			<div class="tabcontendata">
			<?php if (!empty($cuenta['Apunte'])):?>
				<table cellpadding = "0" cellspacing = "0">
				<tr>			
					<th><?php echo __('Fecha'); ?></th>	
					<th><?php echo __('Descripción'); ?></th>	
					<th><?php echo __('Empresa'); ?></th>						
					<th style="text-align:right;"><?php echo __('Cantidad'); ?></th>
					<th><?php echo __('Documento'); ?></th>	
					<th><?php echo __('Método'); ?></th>
					<th><?php echo __('Referencia'); ?></th>			
				</tr>
				<?php			
				$i = 0;
				foreach ($cuenta['Apunte'] as $apunte):
					$i++;												
					$pago = false;						
					if ($apunte['gasto_id'] || $apunte['metodo_id'] == TRAS_DEST) {
						$pago = true;
						$apunte['cantidad'] = -$apunte['cantidad'];											
					}
					
					echo $this->element('trclass',array('i' =>$i,'url' =>null));
				?>					
					<td><?php echo $this->Format->date($apunte['fecha']);?></td>	
					<td><?php echo $apunte['descripcion'];?></td>
					<td><?php  if ($pago)echo $this->Html->link($apunte['Gasto']['Empresa']['nombre'], array('controller' => 'empresas', 'action' => 'view', $apunte['Gasto']['Empresa']['id'])); 
				  			else  echo $this->Html->link($apunte['Factura']['Proyecto']['Empresa']['nombre'], array('controller' => 'facturas', 'action' => 'view', $apunte['Factura']['Proyecto']['Empresa']['id'])); ?></td>
					</td>
					<td style="text-align:right;"><?php echo $this->Format->money($apunte['cantidad']);?></td>
					<td><?php if ($pago) echo $this->Html->link($apunte['Gasto']['referencia'], array('controller' => 'gastos', 'action' => 'view', $apunte['Gasto']['id'])); 
				  			else  echo $this->Html->link($apunte['Factura']['nfactura'], array('controller' => 'facturas', 'action' => 'view', $apunte['Factura']['id'])); ?>
					</td>								 				
					<td><?php if ($apunte['metodo_id'] == TRAS_DEST || $apunte['metodo_id'] == TRAS_ORIG) echo 'Traspaso entre cuentas';
								else echo $metodospago[$apunte['metodo_id']]; ?>
					</td>		
					<td><?php echo $apunte['referencia'];?></td>								
					</tr>
				<?php endforeach; ?>
				</table>	
				<?php else: echo "<h2>No existen pagos o cobros asociados</h2>";endif; ?>
			</div>
		</div>
	</div>
</div>