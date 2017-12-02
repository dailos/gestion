<div class="filtro">
<?php  
echo $this->Form->create($model); 
?>

<div class="opcionesfiltro">
<?php
echo $this->Form->input('filtro',array('label'=>'Buscar: ','value' =>$filter['text']));	
echo $this->Form->input('fechainicio',array('label'=>'Desde: ', 'type' => 'datetime',
							 'selected'=> $filter['inidate'],'dateFormat'=> 'DMY','timeFormat'=>null));	
echo $this->Form->input('fechafin',array('label'=>'Hasta: ', 'type' => 'datetime',
							'selected'=> $filter['enddate'],'dateFormat'=> 'DMY','timeFormat'=>null));

?>
</div>
<div class="opcionesfiltro">
<?php 

foreach ($estados as $valor => $nombre){
	if(in_array($valor,$filter['checkbox']) )
		echo $this->Form->checkbox($nombre, array('checked' =>true));
	else
		echo $this->Form->checkbox($nombre, array('checked' =>false));
	echo $this->Form->label($nombre);	
}
echo $this->Form->checkbox('resumen', array('checked' =>false));
echo $this->Form->label('Mostrar Resumen');


$this->Js->get('#'.$model.'IndexForm');
$this->Js->event('keyup', $this->Js->request(array('action' => 'index'),
					array('update'=>'#filtrado','dataExpression'=>true,  'evalScripts'=>true,
					'data'=> $this->Js->serializeForm(array('isForm' => true, 'inline' => true)))));

$this->Js->get('#'.$model.'IndexForm');
$this->Js->event('change', $this->Js->request(array('action' => 'index'),
					array('update'=>'#filtrado','dataExpression'=>true,  'evalScripts'=>true,
					'data'=> $this->Js->serializeForm(array('isForm' => true, 'inline' => true)))));	

					$this->Js->get('#'.$model.'IndexForm');
$this->Js->event('checked', $this->Js->request(array('action' => 'index'),
					array('update'=>'#filtrado','dataExpression'=>true,  'evalScripts'=>true,
					'data'=> $this->Js->serializeForm(array('isForm' => true, 'inline' => true)))));
					
echo $this->Html->scriptBlock('document.getElementById("'.$model.'Filtro").focus();');
echo $this->Js->writeBuffer(array('onDomReady' => false, 'inline' => true)); 
?>
</div>

</div>