<?php 
if(!empty($albaran['Albaran']['gasto_id']) ) $abierto = false;
else $abierto = true;
?>
<div class="title">
<?php echo $this->Html->image($icono, array('title'=>$titulo,'class'=>'imagentitulo')) ;?><h1><?php echo $titulo;?></h1>
	<div class="actions">
	<?php
	echo $this->Html->link($this->Html->image("back.png"), array('controller'=>'empresas', 'action' => 'view',$albaran['Albaran']['empresa_id']), array( 'escape' => false) );
	if($abierto){
		echo $this->Js->link($this->Html->image('edit.png',array('title'=>'Editar')),array( 'action'=>'edit',$albaran['Albaran']['id']),array('escape'=>false,'update' => 'maindata'),null,false);	
		echo $this->Html->link($this->Html->image('ejecutar.png',array('title'=>'Generar Gasto')), array('controller' => 'gastos', 'action' => 'add',$albaran['Albaran']['id']), array('escape' => false));
		echo $this->Html->link($this->Html->image('del.png',array('title'=>'Eliminar')), array('action' => 'delete', $albaran['Albaran']['id']),array('escape' => false), sprintf('¿Seguro que desea eliminar el albarán, los datos asociados se perderán', $albaran['Albaran']['id']));
	}else echo $this->Html->image('cerrado.png');
	?>
	</div>	
</div>

<div class="albaranes view">
	<div id="maindata">
	<?php if($edit) include_once '../View/Albaranes/edit.ctp';
	else{
	?>
		<dl><?php $i = 0; $class = ' class="altrow"';?>		
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Nº albaran'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $albaran['Albaran']['nalbaran']; ?>
				&nbsp;
			</dd>			
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Fecha'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $this->Format->date($albaran['Albaran']['fecha']); ?>
				&nbsp;
			</dd>			
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Descripción'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $albaran['Albaran']['descripcion']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Gasto'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php 
					if(!empty($albaran['Gasto']['referencia'])) echo $this->Html->link($albaran['Gasto']['referencia'], array('controller' => 'gastos', 'action' => 'view', $albaran['Gasto']['id']));
					else echo $this->Html->image('no.png');
				?>
				&nbsp;
			</dd>		
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Nº pedido'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php 
					if(!empty($albaran['Albaran']['npedido'])) echo $this->Html->link($albaran['Albaran']['npedido'], array('controller' => 'albaranes', 'action' => 'viewpedido', $albaran['Albaran']['id']));
					else echo $this->Html->image('no.png');
				?>
				&nbsp;
			</dd>		
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Notas'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $albaran['Albaran']['notas']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Empresa'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $this->Html->link($albaran['Empresa']['nombre'], array('controller' => 'empresas', 'action' => 'view', $albaran['Albaran']['empresa_id']));?>
				&nbsp;
			</dd>		
		</dl>
		<?php echo $this->element('economicos',array('datoseconomicos'=>$datoseconomicos));?>
		<?php }?>	
	</div>

<?php echo $this->element('gestordocumental', array('documentos' =>$albaran['Documento'],'fk_name' => 'albaran_id','fk_id' =>$albaran['Albaran']['id']));?>
	<div id="tabs">
	    <ul>
	        <li id="tabHeaderActive"><a href="javascript:void(0)" onClick="toggleTab(1,2)"><span>Conceptos</span></a></li>  
	         <li id="tabHeader2"><a href="javascript:void(0)" onClick="toggleTab(2,2)" ><span>Materiales</span></a></li>  
	    </ul>
	</div>
	<div id="tabscontent">
	    <div id="tabContent1" class="tabContent" style="display:yes;">      		
    		<div class="actionstabs">			
			 	<?php if($abierto) echo $this->Js->link($this->Html->image('add.png',array('title'=>'Crear nuevo')),array('controller'=>'conceptoalbaranes', 'action'=>'add',$albaran['Albaran']['id']),array('escape'=>false,'update' => 'addconcepto'),null,false);?>				
			</div>
			
			<div class="tabcontendata">
				<table cellpadding = "0" cellspacing = "0">
				<tr>			
					<th><?php echo __('Concepto'); ?></th>
					<th><?php echo __('Cantidad'); ?></th>
					<th><?php echo __('Coste (u)'); ?></th>	
					<th><?php echo __('Impuesto 1'); ?></th>	
					<th><?php echo __('Impuesto 2'); ?></th>	
					<th><?php echo __('Descuento'); ?></th>	
					<th><?php echo __('Subtotal'); ?></th>									
					<th><?php echo __('Notas'); ?></th>	
					<th class="actions"><?php if($abierto) echo __('Editar');?></th>						
					<th class="actions"><?php if($abierto) echo __('Eliminar');?></th>
				</tr>					
				<?php		
				if (!empty($albaran['Conceptoalbaran'])):	
					$i = 0;					
					foreach ($albaran['Conceptoalbaran'] as $concepto):						
						$i++;
						echo $this->element('trclass',array('i' =>$i,'url' => ''));					
				?>									
						<td><?php echo $concepto['concepto'];?></td>
						<td><?php echo $concepto['cantidad'];?></td>
						<td><?php echo $this->Format->money($concepto['coste']);?></td>	
						<td><?php echo $taxes[$concepto['impuesto1_id']]['nombre'];?></td>	
						<td><?php echo $taxes[$concepto['impuesto2_id']]['nombre'];?></td>	
						<td><?php echo $concepto['pdescuento'].' %';?></td>	
						<td><?php echo $this->Format->money($concepto['cantidad']*$concepto['coste']) ;?></td>						
						<td><?php echo $concepto['notas'];?></td>	
						<td><?php if($abierto) echo $this->Js->link($this->Html->image('edit.png',array('title'=>'Editar')),array('controller'=>'conceptoalbaranes', 'action'=>'edit',$concepto['id'],$concepto['albaran_id']),array('escape'=>false,'update' => 'addconcepto'),null,false);?></td>						
						<td><?php if($abierto) echo $this->Html->link($this->Html->image('del.png',array('title'=>'Eliminar')), array('controller' => 'conceptoalbaranes','action' =>'delete',$concepto['id'],$concepto['albaran_id']),array( 'escape' => false) );?></td>
					</tr>
				<?php endforeach;
					 endif; ?>
				</table>
				<div id="addconcepto"></div>								
			</div>
						
			
		</div>
		<div id="tabContent2" class="tabContent" style="display:none;">  
			<div class="actionstabs">			
				<?php if($abierto) echo $this->Js->link($this->Html->image('add.png',array('title'=>'Crear nuevo')), array('controller' => 'materiales', 'action' => 'select',$albaran['Albaran']['id'],'albaranes'), array('escape' => false,'update' => '#selectlist','evalScripts' => true,'htmlAttributes' => array('id' => 'linkaddmaterial')),null,false);?>
			</div>		
			<div class="tabcontendata">
				<table cellpadding = "0" cellspacing = "0">
				<tr>
					<th><?php echo __('Nombre'); ?></th>
					<th><?php echo __('Cantidad'); ?></th>									
					<th><?php echo __('Notas'); ?></th>
					<th class="actions"><?php if($abierto) echo __('Eliminar');?></th>
				</tr>
				<?php		
					if (!empty($albaran['Material'])):	
						$i = 0;
						foreach ($albaran['Material'] as $material):
							$material = $material['AlbaranesMaterial'];							
							$i++;
							echo $this->element('trclass',array('i' =>$i,'url' => '/materiales/view/'.$material['material_id']));
					?>									
						<td><?php echo $material['nombre'];?></td>
						<td><?php echo $material['cantidad'];?></td>																		
						<td><?php echo $material['notas'];?></td>
						<td><?php if($abierto) echo $this->Html->link($this->Html->image('del.png',array('title'=>'Eliminar')), array('controller' => 'albaranes_materiales','action' =>'delete',$material['id'],$albaran['Albaran']['id']),array( 'escape' => false) );?></td>
					</tr>
					<?php endforeach; 		
				 		endif; ?>
				</table>
				<div id="selectmaterial"></div>
			</div>	
			 		
	   </div>	
	       <?php echo $this->element('sinimpuestos',array('sinimpuestos'=>$datoseconomicos['sinimpuestos']));?>
	</div>
</div>

<?php 	echo $this->Js->get('#linkaddmaterial')->event('click','ocultardoc()');	?>

	


