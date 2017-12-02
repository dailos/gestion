<?php
App::uses('AppModel', 'Model');
class Cuenta extends AppModel {
	
	public $displayField = 'nombre';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $hasMany = array(
		'Apunte' => array(
			'className' => 'Apunte',
			'foreignKey' => 'cuenta_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Documento' => array(
			'className' => 'Documento',
			'foreignKey' => 'cuenta_id',
			'dependent' => true,
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