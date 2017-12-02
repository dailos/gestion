<?php
App::uses('AppModel', 'Model');
class Vehiculo extends AppModel {

	public $displayField = 'matricula';
	
	public $hasMany = array(
		'Documento' => array(
			'className' => 'Documento',
			'foreignKey' => 'vehiculo_id',
			'dependent' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
	);
}
?>