<div class="title">
<?php echo $this->Html->image($icono, array('title'=>$titulo,'class'=>'imagentitulo')) ;?><h1><?php echo $titulo;?></h1>
	<div class="actions">
	<?php
	echo $this->Html->link($this->Html->image("back.png"), array( 'action' => 'index'), array( 'escape' => false) );	
	if($gasto['Gasto']['estado_id'] == ABIERTA) {		
		echo $this->Js->link($this->Html->image('edit.png',array('title'=>'Editar')),array( 'action'=>'edit' ,$gasto['Gasto']['id']),array('escape'=>false,'update' => 'maindata'),null,false);	
		echo $this->Html->link($this->Html->image('del.png',array('title'=>'Eliminar')), array('action' => 'delete',  $gasto['Gasto']['id']),array('escape' => false), sprintf('¿Seguro que desea eliminar el gasto?'));
		echo $this->Html->link($this->Html->image("abierto_action.png",array('title'=>'Cerrar')), array('action' => 'cerrar',  $gasto['Gasto']['id']),array('escape' => false));	
	}else {		
		echo $this->Html->link($this->Html->image('cerrado_action.png',array('title'=>'Abrir')), array( 'action' => 'abrir',$gasto['Gasto']['id']), array( 'escape' => false) );	
	}
	?>
	</div>	
</div>

<div class="gastos view">
	<div id="maindata">
	<?php if($edit) include_once '../View/Gastos/edit.ctp';
	else{
	?>
		<dl><?php $i = 0; $class = ' class="altrow"';?>	
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Referencia'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $gasto['Gasto']['referencia']; ?>
				&nbsp;
			</dd>		
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Nº factura'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $gasto['Gasto']['nfactura']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Fecha'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php  echo $this->Format->date($gasto['Gasto']['fecha']);  ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Descripción'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $gasto['Gasto']['descripcion']; ?>
				&nbsp;
			</dd>				
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Total'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $gasto['Gasto']['total']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Pendiente'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $gasto['Gasto']['pendiente']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Estado'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $estadosgasto[$gasto['Gasto']['estado_id']]; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Empresa'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $this->Html->link($gasto['Empresa']['nombre'], array('controller' => 'empresas', 'action' => 'view', $gasto['Gasto']['empresa_id'])); ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Concepto contable'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $conceptos[$gasto['Gasto']['concepto_id']]; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Previsión de pago'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo  $this->Format->date($gasto['Gasto']['prevpago']); ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Notas'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $gasto['Gasto']['notas']; ?>
				&nbsp;
			</dd>
		</dl>
		<?php echo $this->element('economicos',array('datoseconomicos'=>$datoseconomicos));?>
		<?php }?>
	</div>
<?php 	echo $this->element('gestordocumental', array('documentos' =>$gasto['Documento'],'fk_name' => 'gasto_id','fk_id' =>$gasto['Gasto']['id']));?>	
	<div id="tabs">
	    <ul>
	        <li id="tabHeaderActive"><a href="javascript:void(0)" onClick="toggleTab(1,2)"><span>Albaranes</span></a></li>
	        <li id="tabHeader2"><a href="javascript:void(0)" onClick="toggleTab(2,2)" ><span>Pagos</span></a></li>       
	    </ul>
	</div>

	<div id="tabscontent">	    
		
		<div id="tabContent1" class="tabContent" style="display:yes;">   
			<div class="actionstabs">
				<?php if($gasto['Gasto']['estado_id'] == ABIERTA) 
				 echo $this->Js->link($this->Html->image('add.png',array('title'=>'Crear nuevo')),array('controller'=>'albaranes', 'action'=>'select',$gasto['Gasto']['id'], $gasto['Empresa']['id']),array('escape'=>false,'update' => '#selectlist','evalScripts' => true,'htmlAttributes' => array('id' => 'linkaddalbaran')),null,false);?>				
			</div> 				
			<div class="tabcontendata">
			<?php if (!empty($gasto['Albaran'])):?>
				<table cellpadding = "0" cellspacing = "0">
				<tr>
					<th><?php echo __('Referencia'); ?></th>
					<th><?php echo __('Fecha'); ?></th>	
					<th><?php echo __('Total'); ?></th>							
						<?php if($gasto['Gasto']['estado_id'] == ABIERTA):?>  
						<th class="actions"><?php echo __('Eliminar');?></th>		
					<?php endif;?>								
				</tr>
				<?php
				$i = 0;
				foreach ($gasto['Albaran'] as $albaran):
					$i++;
					echo $this->element('trclass',array('i' =>$i,'url' => '/albaranes/view/'.$albaran['id']));
				?>	
					<td><?php echo $albaran['referencia'];?></td>
					<td><?php echo $this->Format->date($albaran['fecha']);?></td>	
					<td><?php echo $this->Format->money($albaran['total']);?></td>	
					<?php if($gasto['Gasto']['estado_id'] == ABIERTA) : ?>			
					<td><?php echo $this->Html->link($this->Html->image('del.png',array('title'=>'Desvincular')), array('controller' => 'albaranes','action' =>'unsetgasto',$albaran['id'],$gasto['Gasto']['id']),array( 'escape' => false) );?></td>							
					<?php endif;?>
				</tr>
				<?php endforeach; ?>
				</table>
				<?php else: echo "<h2>No existen albaranes asociados</h2>";endif; ?>				
			</div>
		</div>
		
		
		<div id="tabContent2" class="tabContent" style="display:none;"> 
			<div class="actionstabs">
				<?php
				if($gasto['Gasto']['estado_id'] == CERRADA)  echo $this->Html->link($this->Html->image('add.png',array('title'=>'Crear nuevo')), array('controller' => 'apuntes', 'action' => 'addpago',$gasto['Gasto']['id'],$gasto['Gasto']['pendiente']), array('escape' => false));?>
			</div>  						
			<div class="tabcontendata">
			<?php if (!empty($gasto['Apunte'])):?>
				<table cellpadding = "0" cellspacing = "0">
				<tr>			
					<th><?php echo __('Referencia'); ?></th>					
					<th><?php echo __('Descripcion'); ?></th>			
					<th><?php echo __('Cantidad'); ?></th>					
					<th><?php echo __('Fecha'); ?></th>
					<th><?php echo __('Cuenta'); ?></th>
					<th><?php echo __('Método'); ?></th>					
					<th><?php echo __('Notas'); ?></th>		
						<?php if($gasto['Gasto']['estado_id'] == ABIERTA):?>  
						<th class="actions"><?php echo __('Eliminar');?></th>		
					<?php endif;?>						
				</tr>
				<?php			
				$i = 0;
				foreach ($gasto['Apunte'] as $apunte):
					$i++;
					echo $this->element('trclass',array('i' =>$i,'url' => null));
				?>										
					<td><?php echo $apunte['referencia'];?></td>
					<td><?php echo $apunte['descripcion'];?></td>					
					<td><?php echo $this->Format->money($apunte['cantidad']);?></td>					
					<td><?php echo $this->Format->date($apunte['fecha']);?></td>
					<td><?php echo $this->Html->link($apunte['Cuenta']['nombre'],array('controller' => 'cuentas', 'action' =>'view',$apunte['cuenta_id']));?></td>
					<td><?php echo $metodospago[$apunte['metodo_id']];?></td>					
					<td><?php echo $apunte['notas'];?></td>	
					<?php if($gasto['Gasto']['estado_id'] == ABIERTA):?> 
						<td><?php echo $this->Html->link($this->Html->image('del.png',array('title'=>'Eliminar')), array('controller' => 'apuntes','action' =>'deletepago',$apunte['id']),array( 'escape' => false) );?></td>							
					<?php endif;?>				
					</tr>
				<?php endforeach; ?>
				</table>	
				<?php else: echo "<h2>No existen pagos asociados</h2>";endif; ?>
			</div>
		</div>		
	</div>
</div>
<?php 	echo $this->Js->get('#linkaddalbaran')->event('click','ocultardoc()');	?>		