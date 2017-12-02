<?php
App::uses('AppModel', 'Model');
class Servicio extends AppModel {

	public $displayField = 'nombre';
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	
	public $hasMany = array(
		'Documento' => array(
			'className' => 'Documento',
			'foreignKey' => 'servicio_id',
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
		'ServiciosTajo' => array(
			'className' => 'ServiciosTajo',
			'foreignKey' => 'servicio_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
?>