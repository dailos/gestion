<?php
App::uses('AppModel', 'Model');
class Almacen extends AppModel {
	public $name = 'Almacen';
	public $displayField = 'nombre';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $hasMany = array(
		'Documento' => array(
			'className' => 'Documento',
			'foreignKey' => 'almacen_id',
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
		'Herramienta' => array(
			'className' => 'Herramienta',
			'foreignKey' => 'almacen_id',
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
		'Material' => array(
			'className' => 'Material',
			'foreignKey' => 'almacen_id',
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
	);

}
?>