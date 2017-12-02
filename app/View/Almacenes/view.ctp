<div class="title">
<?php echo $this->Html->image($icono, array('title'=>$titulo,'class'=>'imagentitulo')) ;?><h1><?php echo $titulo;?></h1>
	<div class="actions">
	<?php
	echo $this->Html->link($this->Html->image("back.png"), array( 'action' => 'index'), array( 'escape' => false) );
	echo $this->Js->link($this->Html->image('edit.png',array('title'=>'Editar')),array( 'action'=>'edit',$almacen['Almacen']['id']),array('escape'=>false,'update' => 'maindata'),null,false);
	echo $this->Html->link($this->Html->image('del.png',array('title'=>'Eliminar')), array('action' => 'delete', $almacen['Almacen']['id']),array('escape' => false), sprintf('¿Seguro que desea eliminar el almacen?', $almacen['Almacen']['id']));
	?>
	</div>	
</div>
<div class="almacenes view">
	<div id="maindata">
		<dl><?php $i = 0; $class = ' class="altrow"';?>			
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Ubicacion'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $almacen['Almacen']['ubicacion']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Notas'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $almacen['Almacen']['notas']; ?>
				&nbsp;
			</dd>
		</dl>
	</div>
<?php echo $this->element('gestordocumental', array('documentos' =>$almacen['Documento'],'fk_name' => 'almacen_id','fk_id' =>$almacen['Almacen']['id']));?>
	<div id="tabs">
	    <ul>
	        <li id="tabHeaderActive"><a href="javascript:void(0)" onClick="toggleTab(1,2)"><span>Materiales</span></a></li>
	        <li id="tabHeader2"><a href="javascript:void(0)" onClick="toggleTab(2,2)" ><span>Herramientas</span></a></li>       
	    </ul>
	</div>
	
	<div id="tabscontent">
	    <div id="tabContent1" class="tabContent" style="display:yes;">    						
			<div class="tabcontendata">
			<?php if (!empty($almacen['Material'])):?>
				<table cellpadding = "0" cellspacing = "0">
				<tr>			
					<th><?php echo __('Nombre'); ?></th>
					<th><?php echo __('Cantidad'); ?></th>			
					<th><?php echo __('Coste'); ?></th>
					<th><?php echo __('Notas'); ?></th>					
				</tr>
				<?php			
				$i = 0;
				foreach ($almacen['Material'] as $material):
					$i++;
					echo $this->element('trclass',array('i' =>$i,'url' => '/materiales/view/'.$material['id']));
				?>					
						<td><?php echo $material['nombre'];?></td>
						<td><?php echo $material['cantidad'];?></td>				
						<td><?php echo $material['coste'];?></td>
						<td><?php echo $material['notas'];?></td>						
					</tr>
				<?php endforeach; ?>
				</table>	
				<?php else: echo "<h2>No existen materiales asociados</h2>";endif; ?>
			</div>
		</div>
		<div id="tabContent2" class="tabContent" style="display:none;">    				
			<div class="tabcontendata">
			<?php if (!empty($almacen['Herramienta'])):?>
				<table cellpadding = "0" cellspacing = "0">
				<tr>
					<th><?php echo __('Nº de serie'); ?></th>
					<th><?php echo __('Nombre'); ?></th>
					<th><?php echo __('Fecha de compra'); ?></th>					
					<th><?php echo __('Revisión'); ?></th>
					<th><?php echo __('Mantenimiento'); ?></th>		
				</tr>
				<?php
				$i = 0;
				foreach ($almacen['Herramienta'] as $herramienta):
					$i++;
					echo $this->element('trclass',array('i' =>$i,'url' => '/herramientas/view/'.$herramienta['id']));
				?>	
					<td><?php echo $herramienta['nserie'];?></td>
					<td><?php echo $herramienta['nombre'];?></td>
					<td><?php echo $herramienta['fechacompra'];?></td>					
					<td><?php echo $herramienta['revision'];?></td>
					<td><?php echo $herramienta['mantenimiento'];?></td>			
				</tr>
				<?php endforeach; ?>
				</table>
				<?php else: echo "<h2>No existen herramientas asociadas</h2>";endif; ?>
			</div>
		</div>
	</div>
</div>