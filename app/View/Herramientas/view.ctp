<div class="title">
<?php echo $this->Html->image($icono, array('title'=>$titulo,'class'=>'imagentitulo')) ;?><h1><?php echo $titulo;?></h1>
	<div class="actions">
	<?php
	echo $this->Html->link($this->Html->image("back.png"), array( 'action' => 'index'), array( 'escape' => false) );
	echo $this->Js->link($this->Html->image('edit.png',array('title'=>'Editar')),array( 'action'=>'edit',$herramienta['Herramienta']['id']),array('escape'=>false,'update' => 'maindata'),null,false);
	echo $this->Html->link($this->Html->image('del.png',array('title'=>'Eliminar')), array('action' => 'delete', $herramienta['Herramienta']['id']),array('escape' => false), sprintf('¿Seguro que desea eliminar la herramienta?', $herramienta['Herramienta']['id']));
	?>
	</div>	
</div>
<div class="herramientas view">
	<div id='maindata'>
		<dl><?php $i = 0; $class = ' class="altrow"';?>			
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Nº de serie'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $herramienta['Herramienta']['nserie']; ?>
				&nbsp;
			</dd>			
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Compra'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $this->Format->date($herramienta['Herramienta']['fechacompra']); ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Almacén'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $this->Html->link($herramienta['Almacen']['nombre'], array('controller' => 'almacenes', 'action' => 'view', $herramienta['Almacen']['id'])); ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Próx. revisión'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $this->Format->date($herramienta['Herramienta']['revision']); ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Próx. mantenimiento'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $this->Format->date($herramienta['Herramienta']['mantenimiento']); ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Nota'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $herramienta['Herramienta']['notas']; ?>
				&nbsp;
			</dd>
		</dl>
	</div>
	<?php 	echo $this->element('gestordocumental', array('documentos' =>$herramienta['Documento'],'fk_name' => 'herramienta_id','fk_id' =>$herramienta['Herramienta']['id']));?>
</div>
