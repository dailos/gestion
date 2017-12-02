<div class="title">
<?php echo $this->Html->image($icono, array('title'=>$titulo,'class'=>'imagentitulo')) ;?><h1><?php echo $titulo;?></h1>
	<div class="actions">
	<?php
	echo $this->Html->link($this->Html->image("back.png"), array( 'action' => 'index'), array( 'escape' => false) );
	echo $this->Js->link($this->Html->image('edit.png',array('title'=>'Editar')),array( 'action'=>'edit',$vehiculo['Vehiculo']['id']),array('escape'=>false,'update' => 'maindata'),null,false);
	echo $this->Html->link($this->Html->image('del.png',array('title'=>'Eliminar')), array('action' => 'delete', $vehiculo['Vehiculo']['id']),array('escape' => false), sprintf('¿Seguro que desea eliminar el vehículo?', $vehiculo['Vehiculo']['id']));
	?>
	</div>	
</div>

<div class="vehiculos view">
	<div id='maindata'>
		<dl><?php $i = 0; $class = ' class="altrow"';?>			
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Marca'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $vehiculo['Vehiculo']['marca']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Modelo'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $vehiculo['Vehiculo']['modelo']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Matriculación'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $this->Format->date($vehiculo['Vehiculo']['matriculacion']); ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Próx. ITV'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $this->Format->date($vehiculo['Vehiculo']['itv']); ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Próx. revisión(km)'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $vehiculo['Vehiculo']['revisionkm']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Próx. aceite(km)'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $vehiculo['Vehiculo']['aceitekm']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Km actuales'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $vehiculo['Vehiculo']['km']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Nota'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $vehiculo['Vehiculo']['notas']; ?>
				&nbsp;
			</dd>						
		</dl>
	</div>
<?php 	echo $this->element('gestordocumental', array('documentos' =>$vehiculo['Documento'],'fk_name' => 'vehiculo_id','fk_id' =>$vehiculo['Vehiculo']['id']));?>

</div>

