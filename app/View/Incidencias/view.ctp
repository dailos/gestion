<div class="title">
<?php echo $this->Html->image($icono, array('title'=>$titulo,'class'=>'imagentitulo')) ;?><h1><?php echo $titulo;?></h1>
	<div class="actions">
	<?php
	echo $this->Html->link($this->Html->image("back.png"), array('controller'=>'empleados', 'action' => 'view',$incidencia['Incidencia']['empleado_id']), array( 'escape' => false) );
	echo $this->Js->link($this->Html->image('edit.png',array('title'=>'Editar')),array( 'action'=>'edit',$incidencia['Incidencia']['id']),array('escape'=>false,'update' => 'maindata'),null,false);
	echo $this->Html->link($this->Html->image('del.png',array('title'=>'Eliminar')), array('action' => 'delete', $incidencia['Incidencia']['id']),array('escape' => false), sprintf('¿Seguro que desea eliminar la incidencia?', $incidencia['Incidencia']['id']));
	?>
	</div>	
</div>

<div class="incidencias view">
	<div id='maindata'>
	<dl><?php $i = 0; $class = ' class="altrow"';?>	
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Descripcion'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $incidencia['Incidencia']['descripcion']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Fechainicio'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Format->date($incidencia['Incidencia']['fechainicio']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Fechafin'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Format->date($incidencia['Incidencia']['fechafin']); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Tipo'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $incidencia['Incidencia']['tipo']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Notas'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $incidencia['Incidencia']['notas']; ?>
			&nbsp;
		</dd>
	</dl>
	</div>
</div>

<?php 	echo $this->element('gestordocumental', array('documentos' =>$incidencia['Documento'],'fk_name' => 'incidencia_id','fk_id' =>$incidencia['Incidencia']['id']));?>