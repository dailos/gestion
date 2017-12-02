<div class="title">
<?php echo $this->Html->image($icono, array('title'=>$titulo,'class'=>'imagentitulo')) ;?><h1><?php echo $titulo;?></h1>
	<div class="actions">
	<?php
	echo $this->Html->link($this->Html->image("back.png",array('title'=>'Volver al proyecto')), array('controller'=>'proyectos', 'action' => 'view',$factura['Proyecto']['id']), array( 'escape' => false) );	
	if($factura['Factura']['estado_id'] == ABIERTA) {		
		echo $this->Js->link($this->Html->image('edit.png',array('title'=>'Editar')),array( 'action'=>'edit' ,$factura['Factura']['id']),array('escape'=>false,'update' => 'maindata'),null,false);
		echo $this->Html->link($this->Html->image('del.png',array('title'=>'Eliminar')), array('action' => 'delete',  $factura['Factura']['id']),array('escape' => false), sprintf('¿Seguro que desea eliminar la factura?'));
		echo $this->Html->link($this->Html->image('abierto_action.png',array('title'=>'Cerrar')), array( 'action' => 'cerrar',$factura['Factura']['id']), array( 'escape' => false) );		
	}else {		
		echo $this->Html->link($this->Html->image("preview.png",array('title'=>'Previsualizar')), array('action' => 'preview',  $factura['Factura']['id']),array('escape' => false));	
		echo $this->Html->link($this->Html->image("email.png",array('title'=>'Enviar por email')), array('action' => 'email',  $factura['Factura']['id'],$factura['Proyecto']['Empresa']['email']),array('escape' => false));	
		echo $this->Html->link($this->Html->image("pdf.png",array('title'=>'Descargar pdf')), array('action' => 'pdf',  $factura['Factura']['id'],md5($factura['Factura']['id'])),array('escape' => false));		
		echo $this->Html->link($this->Html->image('entregada.png',array('title'=>'Marcar como entregada')), array('action' => 'entregada',  $factura['Factura']['id']),array('escape' => false), sprintf('¿Seguro que desea marcar la factura como entregada?'));
		echo $this->Html->link($this->Html->image('cerrado_action.png',array('title'=>'Abrir')), array( 'action' => 'abrir',$factura['Factura']['id']), array( 'escape' => false) );	
	}
	?>
	</div>	
</div>

<div class="facturas view">
	<div id="maindata">
	<?php if($edit) include_once '../View/Facturas/edit.ctp';
	else{
	?>
		<dl><?php $i = 0; $class = ' class="altrow"';?>	
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Proyecto'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $this->Html->link($factura['Proyecto']['titulo'], array('controller' => 'proyectos', 'action' => 'view', $factura['Proyecto']['id'])); ?>
				&nbsp;
			</dd>		
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Nº factura'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $factura['Factura']['nfactura']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Fecha'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $this->Format->date($factura['Factura']['fecha']); ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Descripción'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $factura['Factura']['descripcion']; ?>
				&nbsp;
			</dd>														
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Pendiente'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $this->Format->money($factura['Factura']['pendiente']); ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Estado'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $estadosfactura[$factura['Factura']['estado_id']]; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Empresa'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $this->Html->link($factura['Proyecto']['Empresa']['nombre'], array('controller' => 'empresas', 'action' => 'view', $factura['Proyecto']['empresa_id'])); ?>
				&nbsp;
			</dd>
			
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Prev cobro'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $this->Format->date($factura['Factura']['prevcobro']);?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Fecha Envío'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php if( $factura['Factura']['fecha_envio']) echo $factura['Factura']['fecha_envio'];
					else   echo $this->Html->image('no.png');?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Fecha Recepción'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php if( $factura['Factura']['fecha_recepcion']) echo 	$factura['Factura']['fecha_recepcion'];
					else   echo $this->Html->image('no.png');?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Notas'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $factura['Factura']['notas']; ?>
				&nbsp;
			</dd>
		</dl>		
		<?php echo $this->element('economicos',array('datoseconomicos'=>$datoseconomicos));?>
	<?php }?>	
	</div>
<?php 	echo $this->element('gestordocumental', array('documentos' =>$factura['Documento'],'fk_name' => 'factura_id','fk_id' =>$factura['Factura']['id']));?>
	<div id="tabs">
	    <ul>
	        <li id="tabHeaderActive"><a href="javascript:void(0)" onClick="toggleTab(1,2)"><span>Tajos</span></a></li>
	        <li id="tabHeader2"><a href="javascript:void(0)" onClick="toggleTab(2,2)" ><span>Cobros</span></a></li>       
	    </ul>
	</div>

	<div id="tabscontent">	    
		
		<div id="tabContent1" class="tabContent" style="display:yes;">   
			<div class="actionstabs">
				<?php
				if($factura['Factura']['estado_id'] == ABIERTA)  
					echo $this->Js->link($this->Html->image('add.png',array('title'=>'Crear nuevo')),array('controller'=>'tajos', 'action'=>'select',$factura['Factura']['id'], $factura['Proyecto']['id']),array('escape'=>false,'update' => '#selectlist','htmlAttributes' => array('id' => 'linkaddtajo'),'evalScripts' => true),null,false);
				?>				
			</div> 				
			<div class="tabcontendata">
			<?php if (!empty($factura['Tajo'])):?>
				<table cellpadding = "0" cellspacing = "0">
				<tr>
					<th><?php echo __('Referencia'); ?></th>
					<th><?php echo __('Fecha'); ?></th>
					<th><?php echo __('Descripción'); ?></th>	
					<th><?php echo __('Total'); ?></th>	
				<?php if($factura['Factura']['estado_id'] == ABIERTA):?>  
						<th class="actions"><?php echo __('Eliminar');?></th>		
					<?php endif;?>		
					
				</tr>
				<?php
				$i = 0;
				foreach ($factura['Tajo'] as $tajo):
					$i++;
					echo $this->element('trclass',array('i' =>$i,'url' => '/tajos/view/'.$tajo['id']));
				?>	
					<td><?php echo $tajo['referencia'];?></td>
					<td><?php echo $this->Format->date($tajo['fecha']);?></td>
					<td><?php echo $tajo['descripcion'];?></td>
					<td><?php echo $this->Format->money($tajo['total']);?></td>
					<?php if($factura['Factura']['estado_id'] == ABIERTA):?> 
						<td><?php echo $this->Html->link($this->Html->image('del.png',array('title'=>'Desvincular')), array('controller' => 'tajos','action' =>'unsetfactura',$tajo['id'],$factura['Factura']['id']),array( 'escape' => false) );?></td>							
					<?php endif;?>
				</tr>
				<?php endforeach; ?>
				</table>
				<?php else: echo "<h2>No existen tajos asociados</h2>";endif; ?>				
			</div>
		</div>
		
		
		<div id="tabContent2" class="tabContent" style="display:none;"> 
			<div class="actionstabs">
				<?php
				if($factura['Factura']['estado_id'] == CERRADA) 
					echo $this->Html->link($this->Html->image('add.png',array('title'=>'Crear nuevo')), array('controller' => 'apuntes', 'action' => 'addcobro',$factura['Factura']['id'],$factura['Factura']['pendiente']), array('escape' => false));
				?>
			</div>  						
			<div class="tabcontendata">
			<?php if (!empty($factura['Apunte'])):?>
				<table cellpadding = "0" cellspacing = "0">
				<tr>			
					<th><?php echo __('Referencia'); ?></th>					
					<th><?php echo __('Descripcion'); ?></th>			
					<th><?php echo __('Cantidad'); ?></th>					
					<th><?php echo __('Fecha'); ?></th>
					<th><?php echo __('Cuenta'); ?></th>
					<th><?php echo __('Método'); ?></th>					
					<?php if($factura['Factura']['estado_id'] == ABIERTA):?>  
						<th class="actions"><?php echo __('Eliminar');?></th>		
					<?php endif;?>					
				</tr>
				<?php			
				$i = 0;
				foreach ($factura['Apunte'] as $apunte):
					$i++;
					echo $this->element('trclass',array('i' =>$i,'url' =>'/apuntes/view/'.$apunte['id']));
				?>										
					<td><?php echo $apunte['referencia'];?></td>
					<td><?php echo $apunte['descripcion'];?></td>					
					<td><?php echo $this->Format->money($apunte['cantidad']);?></td>					
					<td><?php echo $this->Format->date($apunte['fecha']);?></td>
					<td><?php echo $this->Html->link($apunte['Cuenta']['nombre'],array('controller' => 'cuentas', 'action' =>'view',$cobro['cuenta_id']));?></td>
					<td><?php echo $metodospago[$apunte['metodo_id']];?></td>					
					<?php if($factura['Factura']['estado_id'] == ABIERTA):?> 
						<td><?php echo $this->Html->link($this->Html->image('del.png',array('title'=>'Eliminar')), array('controller' => 'apuntes','action' =>'deletecobro',$apunte['id']),array( 'escape' => false) );?></td>							
					<?php endif;?>		
					</tr>
				<?php endforeach; ?>
				</table>	
				<?php else: echo "<h2>No existen cobros asociados</h2>";endif; ?>
			</div>
		</div>	
		 <?php echo $this->element('sinimpuestos',array('sinimpuestos'=>$datoseconomicos['sinimpuestos']));?>	
	</div>
</div>
		
<?php 	echo $this->Js->get('#linkaddtajo')->event('click','ocultardoc()');	?>
