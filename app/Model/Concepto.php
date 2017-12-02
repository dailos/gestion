<?php
App::uses('AppModel', 'Model');
class Concepto extends AppModel {
	
	public $displayField = 'nombre';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $hasMany = array(		
		'Gasto' => array(
			'className' => 'Gasto',
			'foreignKey' => 'concepto_id',
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