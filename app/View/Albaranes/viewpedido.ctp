<?php 
if(empty($pedido['Albaran']['referencia']) && empty($pedido['Albaran']['gasto_id']) ) $abierto = true;
else $abierto = false;
?>
<div class="title">
<?php echo $this->Html->image($icono, array('title'=>$titulo,'class'=>'imagentitulo')) ;?><h1><?php echo $titulo;?></h1>
	<div class="actions">
	<?php
	echo $this->Html->link($this->Html->image("back.png"), array('controller'=>'empresas', 'action' => 'view',$pedido['Albaran']['empresa_id']), array( 'escape' => false) );
	if($abierto){		
		echo $this->Html->link($this->Html->image('ejecutar.png',array('title'=>'Generar albarán')), array('controller' => 'albaranes', 'action' => 'albaranfrompedido',$pedido['Albaran']['id']), array('escape' => false));
		echo $this->Js->link($this->Html->image('edit.png',array('title'=>'Editar')),array( 'action'=>'editpedido',$pedido['Albaran']['id']),array('escape'=>false,'update' => 'maindata'),null,false);	
		echo $this->Html->link($this->Html->image('del.png',array('title'=>'Eliminar')), array('action' => 'delete', $pedido['Albaran']['id']),array('escape' => false), sprintf('¿Seguro que desea eliminar el pedido, los datos asociados se perderán', $pedido['Albaran']['id']));
	}else echo $this->Html->image('cerrado.png');
	?>
	</div>	
</div>

<div class="albaranes view">
	<div id="maindata">
		<dl><?php $i = 0; $class = ' class="altrow"';?>		
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Albarán Ref.'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php if(!empty($pedido['Albaran']['referencia']))echo $this->Html->link($pedido['Albaran']['referencia'], array('controller' => 'albaranes', 'action' => 'view', $pedido['Albaran']['id']));
						else echo $this->Html->image('no.png');
				?>
				&nbsp;
			</dd>			
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Fecha'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $this->Format->date($pedido['Albaran']['fecha']); ?>
				&nbsp;
			</dd>			
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Descripción'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $pedido['Albaran']['descripcion']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Empresa'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $this->Html->link($pedido['Empresa']['nombre'], array('controller' => 'empresas', 'action' => 'view', $pedido['Albaran']['empresa_id']));?>
				&nbsp;
			</dd>		
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Gasto'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php 
					if(!empty($pedido['Gasto']['referencia'])) echo $this->Html->link($pedido['Gasto']['referencia'], array('controller' => 'gastos', 'action' => 'view', $pedido['Gasto']['id']));
					else echo $this->Html->image('no.png');
				?>
				&nbsp;
			</dd>		
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Notas'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $pedido['Albaran']['notas']; ?>
				&nbsp;
			</dd>			
		</dl>		
	</div>
	
<?php echo $this->element('gestordocumental', array('documentos' =>$albaran['Documento'],'fk_name' => 'albaran_id','fk_id' =>$albaran['Albaran']['id']));?>

	<div id="tabs">
	    <ul>
	        <li id="tabHeaderActive"><a href="javascript:void(0)" onClick="toggleTab(1,1)"><span>Materiales</span></a></li>  	       
	    </ul>
	</div>
	<div id="tabscontent">
	    <div id="tabContent1" class="tabContent" style="display:yes;">      		
    		<div class="actionstabs">			
				<?php if($abierto) echo $this->Js->link($this->Html->image('add.png',array('title'=>'Crear nuevo')), array('controller' => 'materiales', 'action' => 'select',$pedido['Albaran']['id'],'albaranes'), array('escape' => false,'update' => '#selectlist','evalScripts' => true,'htmlAttributes' => array('id' => 'linkaddmaterial')),null,false);?>
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
					if (!empty($pedido['Material'])):	
						$i = 0;
						foreach ($pedido['Material'] as $material):
							$material = $material['AlbaranesMaterial'];							
							$i++;
							echo $this->element('trclass',array('i' =>$i,'url' => '/materiales/view/'.$material['material_id']));
					?>									
						<td><?php echo $material['nombre'];?></td>
						<td><?php echo $material['cantidad'];?></td>																				
						<td><?php echo $material['notas'];?></td>
						<td><?php if($abierto) echo $this->Html->link($this->Html->image('del.png',array('title'=>'Eliminar')), array('controller' => 'AlbaranesMateriales','action' =>'delete',$material['id'],$pedido['Albaran']['id']),array( 'escape' => false) );?></td>
					</tr>
					<?php endforeach; 		
				 		endif; ?>
				</table>
				<div id="selectmaterial"></div>
			</div>			
			
		</div>		  
		 
	</div>
</div>

<?php 	echo $this->Js->get('#linkaddmaterial')->event('click','ocultardoc()');	?>

	


