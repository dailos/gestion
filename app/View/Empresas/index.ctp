<?php if(!$filtrado):?>
<div class="title">
<?php echo $this->Html->image($icono, array('title'=>$titulo,'class'=>'imagentitulo')) ;?><h1><?php echo $titulo;?></h1>	
	<div class="actions">
		<?php echo $this->Html->link($this->Html->image('add.png',array('title'=>'Crear nuevo')), array('action' => 'add'), array('escape' => false));?>	
	</div>	
	<?php echo $this->element('filtro',array('model' =>'Empresa'));?>
</div>

<div  id="filtrado" class="empresas index">	
<?php endif;?>
	<table cellpadding="0" cellspacing="0">
	<tr>
		<th><?php echo $this->Paginator->sort('nombre');?></th>
		<th><?php echo $this->Paginator->sort('relacion','Relación');?></th>	
		<th><?php echo $this->Paginator->sort('telefono_fijo','Teléfono fijo');?></th>
		<th><?php echo $this->Paginator->sort('telefono_movil','Teléfono movil');?></th>
		<th><?php echo $this->Paginator->sort('fax');?></th>
		<th><?php echo $this->Paginator->sort('email');?></th>				
	</tr>
	<?php
	$i = 0;
	foreach ($empresas as $empresa):
	if($empresa['Empresa']['id'] != 1):
		$i++;	
		echo $this->element('trclass',array('i' =>$i,'url' => 'view/'.$empresa['Empresa']['id']));	
	?>
		<td><?php echo $empresa['Empresa']['nombre']; ?>&nbsp;</td>
		<td><?php echo $relaciones[$empresa['Empresa']['relacion_id']]; ?>&nbsp;</td>	
		<td><?php echo $empresa['Empresa']['telefono_fijo']; ?>&nbsp;</td>
		<td><?php echo $empresa['Empresa']['telefono_movil']; ?>&nbsp;</td>
		<td><?php echo $empresa['Empresa']['fax']; ?>&nbsp;</td>	
		<td><?php echo $empresa['Empresa']['email']; ?>&nbsp;</td>						
	</tr>
<?php endif; endforeach; ?>
	</table>
<?php echo $this->element('pagination'); ?>

<?php if(!$filtrado):?>
</div>
<?php endif;?>