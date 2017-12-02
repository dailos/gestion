<div class="title">
<?php echo $this->Html->image($icono, array('title'=>$titulo,'class'=>'imagentitulo')) ;?><h1><?php echo $titulo;?></h1>
	<div class="actions">
		<?php echo $this->Js->link($this->Html->image('add.png',array('title'=>'Crear nuevo')),array('action'=>'add'),array('escape'=>false,'update' => 'addimpuesto'),null,false);?>	
	</div>
</div>

<div class="impuestos index">
	<table cellpadding="0" cellspacing="0">
	<tr>			
		<th><?php echo $this->Paginator->sort('nombre');?></th>
		<th><?php echo $this->Paginator->sort('porcentaje');?></th>	
		<th class="actions"><?php echo __('Eliminar');?></th>	
	</tr>
	<?php
	$i = 0;
	foreach ($impuestos as $impuesto):
		if($impuesto['Impuesto']['id'] != SISTEMA):
			$i++;	
			echo $this->element('trclass',array('i' =>$i,'url' => ''));	
		?>		
			<td><?php echo $impuesto['Impuesto']['nombre']; ?>&nbsp;</td>
			<td><?php echo $impuesto['Impuesto']['porcentaje'].' %'; ?>&nbsp;</td>	
			<td><?php if ($impuesto['Impuesto']['id'] != SISTEMA )echo $this->Html->link($this->Html->image('del.png',array('title'=>'Eliminar')), array('action' =>'delete',$impuesto['Impuesto']['id']),array( 'escape' => false) );?></td>							
		</tr>
	<?php endif;
	endforeach; ?>
	</table>	
	<div id='addimpuesto'></div>
<?php echo $this->element('pagination'); ?>

</div>
