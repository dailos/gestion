<?php
$mostrar = false;
if($empleado['Empresa']['id'] == SISTEMA)  $mostrar = true;	
?>
<div class="title">
<?php echo $this->Html->image($icono, array('title'=>$titulo,'class'=>'imagentitulo')) ;?><h1><?php echo $titulo;?></h1>
	<div class="actions">
	<?php
	echo $this->Html->link($this->Html->image("back.png"), array('controller'=>'empresas', 'action' => 'view', $empleado['Empresa']['id']), array( 'escape' => false) );
	echo $this->Js->link($this->Html->image('edit.png',array('title'=>'Editar')),array( 'action'=>'edit',$empleado['Empleado']['id']),array('escape'=>false,'update' => 'maindata'),null,false);
	echo $this->Html->link($this->Html->image('del.png',array('title'=>'Eliminar')), array('action' => 'delete', $empleado['Empleado']['id']),array('escape' => false), sprintf('¿Seguro que desea eliminar al empleado?', $empleado['Empleado']['id']));
	?>
	</div>	
</div>

<div class="empleados view">
	<div id='maindata'>
		<dl><?php $i = 0; $class = ' class="altrow"';?>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Empresa'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $this->Html->link($empleado['Empresa']['nombre'],array( 'controller'=>'empresas','action'=>'view',$empleado['Empresa']['id'])); ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Cargo'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $empleado['Empleado']['cargo']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Horario'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $empleado['Empleado']['horario']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Teléfono'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $empleado['Empleado']['telefono']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Móvil'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $empleado['Empleado']['movil']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('E-mail'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $empleado['Empleado']['email']; ?>
				&nbsp;
			</dd>		
			<?php if($mostrar): ?>	
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Costexmes'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $empleado['Empleado']['costexmes']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Horasxmes'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $empleado['Empleado']['horasxmes']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Fechacontratacion'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $this->Format->date($empleado['Empleado']['fechacontratacion']); ?>
				&nbsp;
			</dd>
			<?php endif;?>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Notas'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $empleado['Empleado']['notas']; ?>
				&nbsp;
			</dd>
		</dl>
	</div>

<?php echo $this->element('gestordocumental', array('documentos' =>$empleado['Documento'],'fk_name' => 'empleado_id','fk_id' =>$empleado['Empleado']['id']));?>

	<div id="tabs">
	    <ul>
		<?php if ($mostrar){?>
	    
	        <li id="tabHeaderActive"><a href="javascript:void(0)" onClick="toggleTab(1,2)"><span>Incidencias</span></a></li>
	        <li id="tabHeader2"><a href="javascript:void(0)" onClick="toggleTab(2,2)" ><span>Tajos</span></a></li>       	    
	    <?php }else{?>
				<li id="tabHeaderActive"><a href="javascript:void(0)" onClick="toggleTab(1,1)"><span>Incidencias</span></a></li>    
	    <?php }?>
	    </ul>
	</div>
	
	<div id="tabscontent">
		
		 <div id="tabContent1" class="tabContent" style="display:yes;">    
				<div class="actionstabs">
				 	<?php echo $this->Html->link($this->Html->image('add.png',array('title'=>'Crear nuevo')),array('controller'=>'incidencias', 'action'=>'add',$empleado['Empleado']['id']),array('escape'=>false));?>				
				</div>				
				<div class="tabcontendata">
					<?php if (!empty($empleado['Incidencia'])):?>
					<table cellpadding = "0" cellspacing = "0">
					<tr>													
						<th><?php echo __('Descripción'); ?></th>
						<th><?php echo __('Inicio'); ?></th>
						<th><?php echo __('Fin'); ?></th>
						<th><?php echo __('Tipo'); ?></th>
						<th><?php echo __('Notas'); ?></th>						
					</tr>
					<?php 									
					foreach ($empleado['Incidencia'] as $incidencia):				
					$i++;
					echo $this->element('trclass',array('i' =>$i,'url' => '/incidencias/view/'.$incidencia['id']));
					?>													
							<td><?php echo $incidencia['descripcion'];?></td>
							<td><?php echo $incidencia['fechainicio'];?></td>
							<td><?php echo $incidencia['fechafin'];?></td>
							<td><?php echo $incidencia['tipo'];?></td>
							<td><?php echo $incidencia['notas'];?></td>							
						</tr>
					<?php endforeach;?>						 
					</table>
					<?php else: echo "<h2>No existen incidencias asociadas</h2>";endif; ?>				
				</div>
	   </div>
		<?php if ($mostrar):?>
	 	<div id="tabContent2" class="tabContent" style="display:none;">    				
			<div class="tabcontendata">
			<?php if (!empty($empleado['Tajo'])):?>
				<table cellpadding = "0" cellspacing = "0">
				<tr>
					<th><?php echo __('Referencia'); ?></th>
					<th><?php echo __('Fecha'); ?></th>					
					<th><?php echo __('Proyecto'); ?></th>
					<th><?php echo __('Notas'); ?></th>				
				</tr>
				<?php 						
					foreach ($empleado['Tajo'] as $tajo):				
					$i++;
					echo $this->element('trclass',array('i' =>$i,'url' => '/tajos/view/'.$tajo['id']));
				?>			
						<td><?php echo $tajo['referencia'];?></td>
						<td><?php echo $this->Format->date($tajo['fecha']);?></td>						
						<td><?php echo $tajo['Proyecto']['titulo'];?></td>
						<td><?php echo $tajo['notas'];?></td>						
					</tr>
					<?php endforeach;?>
				</table>
				<?php else: echo "<h2>No existen tajos asociados</h2>";endif; ?>				
			</div>
	    </div>
	    <?php endif;?>
	</div>
</div>
