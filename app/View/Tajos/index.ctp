<div class="title">
<?php echo $this->Html->image($icono, array('title'=>$titulo,'class'=>'imagentitulo')) ;?><h1><?php echo $titulo;?></h1>	
</div>

<div class="tajos index">
	<table cellpadding="0" cellspacing="0">
	<tr>			
			<th><?php echo $this->Paginator->sort('npresupuesto','nº presupuesto');?></th>
			<th><?php echo $this->Paginator->sort('referencia','referencia de tajo');?></th>			
			<th><?php echo $this->Paginator->sort('factura');?></th>
			<th><?php echo $this->Paginator->sort('fecha');?></th>	
			<th><?php echo $this->Paginator->sort('empresa');?></th>					
			<th><?php echo $this->Paginator->sort('proyecto');?></th>				
			<th><?php echo $this->Paginator->sort('fecha_entrega','Envío');?></th>	
			<th><?php echo $this->Paginator->sort('fecha_entrega','Recepción');?></th>	
	</tr>
	<?php
	$i = 0;
	foreach ($tajos as $tajo):
		$i++;	
		echo $this->element('trclass',array('i' =>$i,'url' => 'viewpresupuesto/'.$tajo['Tajo']['id']));	
	?>		
		<td><?php echo $tajo['Tajo']['npresupuesto']; ?>&nbsp;</td>
		<td><?php if (isset($tajo['Tajo']['referencia'])) echo $tajo['Tajo']['referencia']; 
				else  echo $this->Html->image('minino.png');?>&nbsp;</td>
		<td><?php if (isset ($tajo['Tajo']['factura_id'])) echo $this->Html->link($tajo['Factura']['nfactura'], array('controller'=>'facturas', 'action' => 'view',$tajo['Tajo']['factura_id']));
				else echo $this->Html->image('minino.png');?></td>
		<td><?php echo $this->Format->date($tajo['Tajo']['fecha']);  ?>&nbsp;</td>
		<td><?php echo $this->Html->link($tajo['Proyecto']['Empresa']['nombre'], array('controller'=>'empresas', 'action' => 'view',$tajo['Proyecto']['Empresa']['id']));?>&nbsp;</td>
		<td><?php if (isset ($tajo['Tajo']['proyecto_id'])) echo $this->Html->link($tajo['Proyecto']['titulo'], array('controller'=>'proyectos', 'action' => 'view',$tajo['Tajo']['proyecto_id']));
				else echo $this->Html->image('minino.png');?></td>			
		<td><?php if( $tajo['Tajo']['fecha_envio']) echo $this->Format->date($tajo['Tajo']['fecha_envio']);
					else   echo $this->Html->image('minino.png');?>&nbsp;</td>	
		<td><?php if( $tajo['Tajo']['fecha_recepcion']) echo 	$this->Format->date($tajo['Tajo']['fecha_recepcion']);
					else   echo $this->Html->image('minino.png');?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</table>
	<?php echo $this->element('pagination'); ?>
</div>