<div class="title">
<?php echo $this->Html->image($icono, array('title'=>$titulo,'class'=>'imagentitulo')) ;?><h1><?php echo $titulo;?></h1>
	<div class="actions">
		<?php echo $this->Html->link($this->Html->image('add.png',array('title'=>'Crear nuevo')), array('action' => 'add'), array('escape' => false));?>		
	</div>
</div>

<div class="conceptos index">

	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?php echo $this->Paginator->sort('nombre');?></th>
		<th><?php echo $this->Paginator->sort('cuentacontable','Cuenta Contable');?></th>
		<th><?php echo $this->Paginator->sort('notas');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($conceptos as $concepto):
		$i++;	
		echo $this->element('trclass',array('i' =>$i,'url' => 'view/'. $concepto['Concepto']['id']));	
	?>		
		<td><?php echo $concepto['Concepto']['nombre']; ?>&nbsp;</td>
		<td><?php echo $concepto['Concepto']['cuentacontable']; ?>&nbsp;</td>
		<td><?php echo $concepto['Concepto']['notas']; ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</table>
	<?php echo $this->element('pagination'); ?>
</div>
