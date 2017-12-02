<?php
App::uses('AppModel', 'Model');
class EmpleadosTajo extends AppModel {
	
	public $displayField = 'nombre';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $belongsTo = array(
		'Empleado' => array(
			'className' => 'Empleado',
			'foreignKey' => 'empleado_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Tajo' => array(
			'className' => 'Tajo',
			'foreignKey' => 'tajo_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>