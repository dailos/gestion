<?php
App::uses('AppModel', 'Model');
class Apunte extends AppModel {

	public $displayField = 'descripcion';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $belongsTo = array(		
		'Cuenta' => array(
			'className' => 'Cuenta',
			'foreignKey' => 'cuenta_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Gasto' => array(
			'className' => 'Gasto',
			'foreignKey' => 'gasto_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),		
		'Factura' => array(
			'className' => 'Factura',
			'foreignKey' => 'factura_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	public $hasMany = array(
		'Documento' => array(
			'className' => 'Documento',
			'foreignKey' => 'apunte_id',
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