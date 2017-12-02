<?php 
$i = 0;

function icono($ruta){
	$imagen = array('jpg','png','gif','bmp');
	$documento = array('doc','txt','docx');		
	$ext = $ext = substr(strrchr($ruta, '.'), 1);
	$ext = strtolower($ext);
	
	if(in_array($ext,$imagen)) $ico = 'ico_img';
	else if(in_array($ext,$documento)) $ico = 'ico_doc';
	else if ($ext = 'pdf') $ico = 'ico_pdf';
	else $ico = 'ico_desc';
	
	return $ico;
			
}

?>
<div id="gestordocumental">
	<div class="titledocumentos">		
		Documentos relacionados
		<div class="actions">
		<?php echo $this->Js->link($this->Html->image('miniadd.png',array('title'=>'Crear nuevo')),array( 'controller'=>'documentos','action'=>'add',$fk_name,$fk_id),array('escape'=>false,'update' => 'adddocumento'),null,false);?>
		</div>
	</div>
	
	<div class="tabcontendatadocuments">
	<?php if (!empty($documentos)):?>
		<table cellpadding = "0" cellspacing = "0">
		<tr>
			<th><?php echo __('Tipo'); ?></th>
			<th><?php echo __('Nombre'); ?></th>
			<th class="actions"><?php echo __('Eliminar');?></th>
		</tr>
		<?php foreach ($documentos as $documento):
			$i++;
			echo $this->element('trclass',array('i' =>$i,'url' => '/documentos/view/'.$documento['id']));?>							
			<td><?php echo $this->Html->image(icono($documento['ruta']).".png");?></td>
			<td><?php echo $documento['nombre'];?></td>														
			<td><?php echo $this->Html->link($this->Html->image("minidel.png",array('title'=> 'Eliminar')), array('controller' => 'documentos','action' =>'delete',$documento['id']),array( 'escape' => false) );?></td>
		</tr>
		<?php endforeach; ?>
		</table>
	<?php else: 
			echo "<h2>No existen documentos asociados</h2>";
		endif; ?>
		
		<div id="adddocumento"></div>
	</div>
</div>

<div id='selectlist'>
</div>
