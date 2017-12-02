<div class="title">
<?php echo $this->Html->image($icono, array('title'=>$titulo,'class'=>'imagentitulo')) ;?><h1><?php echo $titulo;?></h1>	
<div class="actions">
	<?php
	echo $this->Html->link($this->Html->image("back.png"), array('action' => 'index'), array( 'escape' => false) );	
	?>
	</div>	
</div>
<?php 
$cantidad = $apunte['Apunte']['cantidad'];
if (isset($apunte['Apunte']['gasto_id']) || $apunte['Apunte']['matodo_id'] = TRAS_ORIG) $cantidad = -$cantidad;
?>
<div class="cobros view">
	<div id="maindata">	
	<dl><?php $i = 0; $class = ' class="altrow"';?>			
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Referencia'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $apunte['Apunte']['referencia']; ?>
			&nbsp;
		</dd>		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Descripción'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $apunte['Apunte']['descripcion']; ?>
			&nbsp;
		</dd>	
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Empresa'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo  $this->Html->link($apunte['Factura']['Proyecto']['Empresa']['nombre'], array('controller' => 'empresas', 'action' => 'view',$apunte['Factura']['Proyecto']['Empresa']['id'])); 
			  	  echo  $this->Html->link($apunte['Gasto']['Empresa']['nombre'], array('controller' => 'empresas', 'action' => 'view',$apunte['Gasto']['Empresa']['id']));
			?>			
			&nbsp;
		</dd>		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Cantidad'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Format->money($cantidad); ?>
			&nbsp;
		</dd>		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Documento'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
		<?php echo  $this->Html->link($apunte['Factura']['nfactura'], array('controller' => 'facturas', 'action' => 'view',$apunte['Factura']['id'])); 
			  echo  $this->Html->link($apunte['Gasto']['referencia'], array('controller' => 'gastos', 'action' => 'view',$apunte['Gasto']['id']));
		?>			
			&nbsp;
		</dd>		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Fecha'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Format->date($apunte['Apunte']['fecha']); ?>
			&nbsp;
		</dd>		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Cuenta'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo  $this->Html->link($apunte['Cuenta']['nombre'], array('controller' => 'cuentas', 'action' => 'view',$cobro['Cuenta']['id'])); ?>
			&nbsp;
		</dd>		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Método de pago'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $metodospago[$apunte['Apunte']['metodo_id']]; ?>
			&nbsp;
		</dd>			
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Notas'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $apunte['Apunte']['notas']; ?>
			&nbsp;
		</dd>
	</dl>
	</div>
	
	
<?php echo $this->element('gestordocumental', array('documentos' =>$cobro['Documento'],'fk_name' => 'cobro_id','fk_id' =>$cobro['Cobro']['id']));?>
	
</div>