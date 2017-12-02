<div class="filtro">
<?php  
$year = date('Y');
echo $this->Form->create('Apunte'); 
?>

<div class="opcionesfiltro">
<?php
echo $this->Form->input('filtro',array('label'=>'Buscar: '));	
echo $this->Form->input('fechainicio',array('label'=>'Desde: ', 'type' => 'datetime',
							 'selected'=> $year.'-01-01','dateFormat'=> 'DMY','timeFormat'=>null));	
echo $this->Form->input('fechafin',array('label'=>'Hasta: ', 'type' => 'datetime',
							'selected'=> $year.'-12-31','dateFormat'=> 'DMY','timeFormat'=>null));

?>
</div>
<div class="opcionesfiltro">
<?php
echo $this->Form->checkbox('pagos', array('checked' =>true));
echo $this->Form->label('Pagos');
	
echo $this->Form->checkbox('cobros', array('checked' =>true));
echo $this->Form->label('Cobros');

echo $this->Form->checkbox('traspasos', array('checked' =>true));
echo $this->Form->label('Traspasos');

echo $this->Form->checkbox('resumen', array('checked' =>false));
echo $this->Form->label('Mostrar Resumen');

echo $this->Form->input('cuenta', array('label' => false, 'selected' => 0));



$this->Js->get('#ApunteIndexForm');
$this->Js->event('keyup', $this->Js->request(array('action' => 'index'),
					array('update'=>'#filtrado','dataExpression'=>true,  'evalScripts'=>true,
					'data'=> $this->Js->serializeForm(array('isForm' => true, 'inline' => true)))));

$this->Js->get('#ApunteIndexForm');
$this->Js->event('change', $this->Js->request(array('action' => 'index'),
					array('update'=>'#filtrado','dataExpression'=>true,  'evalScripts'=>true,
					'data'=> $this->Js->serializeForm(array('isForm' => true, 'inline' => true)))));	

					$this->Js->get('#ApunteIndexForm');
$this->Js->event('checked', $this->Js->request(array('action' => 'index'),
					array('update'=>'#filtrado','dataExpression'=>true,  'evalScripts'=>true,
					'data'=> $this->Js->serializeForm(array('isForm' => true, 'inline' => true)))));
					
echo $this->Html->scriptBlock('document.getElementById("ApunteFiltro").focus();');
echo $this->Js->writeBuffer(array('onDomReady' => false, 'inline' => true)); 
?>
</div>

</div>