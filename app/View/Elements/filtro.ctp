<div class="filtro">
	<div class="opcionesfiltro">
	<?php  
	if(!$url) $url = array('action' => 'index');
	echo $this->Form->create($model); 
	echo $this->Form->input('filtro',array('label'=>'Buscar: '));	
	$this->Js->get('#'.$model.'Filtro');
	$this->Js->event('keyup', $this->Js->request($url,
						array('update'=>'#filtrado','dataExpression'=>true,  'evalScripts'=>true,
						'data'=> $this->Js->serializeForm(array('isForm' => true, 'inline' => true)))));			
						
	echo $this->Html->scriptBlock('document.getElementById("'.$model.'Filtro").focus();');
	echo $this->Js->writeBuffer(array('onDomReady' => false, 'inline' => true)); 
	?>
	</div>
</div>
