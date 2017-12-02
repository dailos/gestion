<div class="title">
<?php echo $this->Html->image($icono, array('title'=>$titulo,'class'=>'imagentitulo')) ;?><h1><?php echo $titulo;?></h1>	
</div>

<div class="albaranes index">
	<table cellpadding="0" cellspacing="0">
	<tr>			
		<th><?php echo $this->Paginator->sort('fecha');?></th>	
		<th><?php echo $this->Paginator->sort('empresa_id');?></th>	
		<th><?php echo $this->Paginator->sort('descripcion');?></th>		
		<th><?php echo $this->Paginator->sort('nalbaran','nº albaran');?></th>	
		<th><?php echo $this->Paginator->sort('npedido', 'nº pedido');?></th>	
		<th><?php echo $this->Paginator->sort('referencia');?></th>				
		<th><?php echo $this->Paginator->sort('gasto_id');?></th>		
	</tr>
	<?php
	$i = 0;
	foreach ($albaranes as $albaran):
		$i++;	
		echo $this->element('trclass',array('i' =>$i,'url' => 'viewpedido/'.$albaran['Albaran']['id']));	
	?>				
		<td><?php echo $this->Format->date($albaran['Albaran']['fecha']); ?>&nbsp;</td>
		<td><?php echo $this->Html->link($albaran['Empresa']['nombre'], array('controller'=>'empresas', 'action' => 'view',$albaran['Albaran']['empresa_id']));?></td>
		<td><?php echo $albaran['Albaran']['descripcion']; ?>&nbsp;</td>		
		<td><?php if (isset ($albaran['Albaran']['nalbaran']))echo $albaran['Albaran']['nalbaran']; else echo $this->Html->image('minino.png'); ?>&nbsp;</td>	
		<td><?php if (isset ($albaran['Albaran']['npedido'])) echo $albaran['Albaran']['npedido']; else echo $this->Html->image('minino.png');?>&nbsp;</td>			
		<td><?php if (isset ($albaran['Albaran']['referencia']))echo $albaran['Albaran']['referencia']; else echo $this->Html->image('minino.png');?>&nbsp;</td>			
		<td><?php if (isset ($albaran['Albaran']['gasto_id'])) echo $this->Html->link($albaran['Gasto']['referencia'], array('controller'=>'gastos', 'action' => 'view',$albaran['Albaran']['gasto_id']));
				else echo $this->Html->image('minino.png');?></td>			
	</tr>
<?php endforeach; ?>
	</table>	
<?php echo $this->element('pagination'); ?>

</div>
