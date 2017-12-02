<div class="title">
<?php echo $this->Html->image($icono, array('title'=>$titulo,'class'=>'imagentitulo')) ;?><h1><?php echo $titulo;?></h1>
	<div class="actions">
	<?php
	echo $this->Html->link($this->Html->image("back.png",array('title'=>'Volver al presupuesto')), array('action' => 'viewpresupuesto',$tajo['Tajo']['id']), array( 'escape' => false) );	
	?>
	</div>	
</div>
<div class="tajos index">
<?php 
$fecha = $this->Format->date($tajo['Tajo']['fecha']); 
echo $this->Html->script('ckeditor/ckeditor'); 
echo $this->Form->create('Tajo', array('action'=>'email',  'inputDefaults' => array('label' => false,'div' => false)));
	
echo $this->Form->input('id',array('value'=>$id));
echo $this->Form->hidden('npresupuesto',array('value'=>$tajo['Tajo']['npresupuesto']));
$hash = md5($id);	
$url = Router::url('/', true).'tajos/descargar/'. $id."/".$hash;
$texto = PRE_CUERPO1 . '<br><br>';
$texto .= 'Presupuesto nº '.$tajo['Tajo']['npresupuesto'].', Fecha '.$fecha.'<br>';
$texto .=  'Descargar aquí: '.$this->Html->link($url,$url);	
$texto .= '<br><br>' . PRE_CUERPO2;
$texto .= '<br><br><center>' .CIERRE_PAG.'</center>';
?>
<dl>
	<dt class="separador">Enviar a:</dt>
		<dd><?php echo $this->Form->input('email',array('value'=>$email,'style'=>'width:300px;')); ?></dd>	<br>
	<dt class="separador">Mensaje:</dt>
		<dd><?php echo $this->Form->textarea('cuerpo',array('value'=>$texto,'class'=>'ckeditor')); ?></dd>					
</dl>
<br>
<?php echo $this->Form->end('Enviar');?>
</div>