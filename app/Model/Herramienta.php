<?php
App::uses('AppModel', 'Model');
class Herramienta extends AppModel {

	public $displayField = 'nombre';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $belongsTo = array(
		'Almacen' => array(
			'className' => 'Almacen',
			'foreignKey' => 'almacen_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	public $hasMany = array(
		'Documento' => array(
			'className' => 'Documento',
			'foreignKey' => 'herramienta_id',
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