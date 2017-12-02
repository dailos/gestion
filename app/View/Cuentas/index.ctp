<div class="title">
<?php echo $this->Html->image($icono, array('title'=>$titulo,'class'=>'imagentitulo')) ;?><h1><?php echo $titulo;?></h1>
	<div class="actions">
		<?php echo $this->Html->link($this->Html->image('add.png',array('title'=>'Crear nuevo')), array('action' => 'add'), array('escape' => false));?>		
	</div>
</div>

<div class="cuentas index">	
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('nombre');?></th>
			<th><?php echo $this->Paginator->sort('ccc');?></th>
			<th><?php echo $this->Paginator->sort('notas');?></th>			
	</tr>
	<?php
	$i = 0;
	foreach ($cuentas as $cuenta):
		$i++;	
		echo $this->element('trclass',array('i' =>$i,'url' => 'view/'. $cuenta['Cuenta']['id']));	
	?>		
		<td><?php echo $cuenta['Cuenta']['nombre']; ?>&nbsp;</td>
		<td><?php echo $cuenta['Cuenta']['ccc']; ?>&nbsp;</td>
		<td><?php echo $cuenta['Cuenta']['notas']; ?>&nbsp;</td>		
	</tr>
<?php endforeach; ?>
	</table>
<?php echo $this->element('pagination'); ?>
</div>