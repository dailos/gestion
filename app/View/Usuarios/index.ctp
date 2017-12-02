<div class="title">
<?php echo $this->Html->image($icono, array('title'=>$titulo,'class'=>'imagentitulo')) ;?><h1><?php echo $titulo;?></h1>
	<div class="actions">
		<?php echo $this->Js->link($this->Html->image('add.png',array('title'=>'Crear nuevo')),array( 'action'=>'add'),array('escape'=>false,'update' => 'addusuario'),null,false);?>
	</div>
</div>

<div class="usuarios index">
	<table cellpadding="0" cellspacing="0">
	<tr>		
			<th><?php echo $this->Paginator->sort('usuario');?></th>		
			<th><?php echo $this->Paginator->sort('nombre');?></th>
			<th><?php echo $this->Paginator->sort('apellidos');?></th>
			<th><?php echo $this->Paginator->sort('email');?></th>
			<th class="actions"><?php echo __('Eliminar');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($usuarios as $usuario):
		$i++;	
		echo $this->element('trclass',array('i' =>$i,'url' => ''));	
	?>			
		<td><?php echo $usuario['Usuario']['username']; ?>&nbsp;</td>		
		<td><?php echo $usuario['Usuario']['nombre']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['apellidos']; ?>&nbsp;</td>
		<td><?php echo $usuario['Usuario']['email']; ?>&nbsp;</td>				
		<td><?php if($usuario['Usuario']['id'] != SISTEMA) echo  $this->Html->link($this->Html->image('del.png',array('title'=>'Eliminar')), array('controller' => 'usuarios','action' =>'delete',$usuario['Usuario']['id']),array( 'escape' => false) ); ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</table>
	<div id="addusuario"></div>
	<?php echo $this->element('pagination'); ?>
</div>