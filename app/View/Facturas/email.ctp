<div class="title">
<?php echo $this->Html->image($icono, array('title'=>$titulo,'class'=>'imagentitulo')) ;?><h1><?php echo $titulo;?></h1>
	<div class="actions">
	<?php
	echo $this->Html->link($this->Html->image("back.png",array('title'=>'Volver a la factura')), array('action' => 'view',$factura['Factura']['id']), array( 'escape' => false) );	
	?>
	</div>	
</div>
<div class="tajos index">
<?php 
$fecha = $this->Format->date($factura['Factura']['fecha']); 
echo $this->Html->script('ckeditor/ckeditor'); 
echo $this->Form->create('Factura', array('action'=>'email',  'inputDefaults' => array('label' => false,'div' => false)));
	
echo $this->Form->input('id',array('value'=>$id));
echo $this->Form->hidden('nfactura',array('value'=>$factura['Factura']['nfactura']));
$hash = md5($id);	
$url = Router::url('/', true).'facturas/descargar/'. $id."/".$hash;
$texto = FAC_CUERPO1 . '<br><br>';
$texto .= 'Factura nº '.$factura['Factura']['nfactura'].', Fecha '.$fecha.'<br>';
$texto .=  'Descargar aquí: '.$this->Html->link($url,$url);	
$texto .= '<br><br>' . FAC_CUERPO2;
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