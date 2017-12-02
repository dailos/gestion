<div class="title">
<?php echo $this->Html->image($icono, array('title'=>$titulo,'class'=>'imagentitulo')) ;?><h1><?php echo $titulo;?></h1>
	<div class="actions">
	<?php
	echo $this->Html->link($this->Html->image("back.png"), array( 'action' => 'index'), array( 'escape' => false) );
	echo $this->Js->link($this->Html->image('edit.png',array('title'=>'Editar')),array( 'action'=>'edit',$concepto['Concepto']['id']),array('escape'=>false,'update' => 'maindata'),null,false);
	echo $this->Html->link($this->Html->image('del.png',array('title'=>'Eliminar')), array('action' => 'delete', $concepto['Concepto']['id']),array('escape' => false), sprintf('¿Seguro que desea eliminar el concepto?',$concepto['Concepto']['id']));
	?>
	</div>	
</div>

<div class="conceptos view">
	<div id="maindata">
	<dl><?php $i = 0; $class = ' class="altrow"';?>		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Nombre'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $concepto['Concepto']['nombre']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Cuenta Contable'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $concepto['Concepto']['cuentacontable']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Notas'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $concepto['Concepto']['notas']; ?>
			&nbsp;
		</dd>
	</dl>
	</div>


	<div id="tabs">
	    <ul>
	        <li id="tabHeaderActive"><a href="javascript:void(0)" onClick="toggleTab(1,1)"><span>Gastos</span></a></li>	  	       	      
	    </ul>
	</div>

	
	<div id="tabscontent">			
		 <div id="tabContent1" class="tabContent" style="display:yes;">    						
			<div class="tabcontendata">
			<?php if (!empty($concepto['Gasto'])):?>
				<table cellpadding = "0" cellspacing = "0">
				<tr>	
					<th><?php echo __('Nº Factura'); ?></th>	
					<th><?php echo __('Referencia'); ?></th>	
					<th><?php echo __('Fecha'); ?></th>
					<th><?php echo __('Descripcion'); ?></th>
					<th><?php echo __('Empresa'); ?></th>
					<th><?php echo __('Total'); ?></th>					
					<th><?php echo __('Pendiente'); ?></th>
					<th><?php echo __('Notas'); ?></th>		
				</tr>
				<?php			
				$i = 0;
				foreach ($concepto['Gasto'] as $gasto):
					$i++;
					echo $this->element('trclass',array('i' =>$i,'url' => '/gastos/view/'.$gasto['id']));
				?>		
					<td><?php echo $gasto['nfactura'];?></td>
					<td><?php echo $gasto['referencia'];?></td>			
					<td><?php echo $this->Format->date($gasto['fecha']);?></td>
					<td><?php echo $gasto['descripcion'];?></td>
					<td><?php echo $gasto['empresa_id'];?></td>
					<td><?php echo $gasto['total'];?></td>					
					<td><?php echo $gasto['pendiente'];?></td>					
					<td><?php echo $gasto['notas'];?></td>				
					</tr>
				<?php endforeach; ?>
				</table>	
				<?php else: echo "<h2>No existen gastos asociados</h2>";endif; ?>
			</div>
		</div>
	
	</div>
</div>