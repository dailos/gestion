<?php
App::uses('AppModel', 'Model');
class Material extends AppModel {

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
		'AlbaranesMaterial' => array(
			'className' => 'AlbaranesMaterial',
			'foreignKey' => 'material_id',
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
			'foreignKey' => 'material_id',
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
		'MaterialesTajo' => array(
			'className' => 'MaterialesTajo',
			'foreignKey' => 'material_id',
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