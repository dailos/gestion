<?php
App::uses('AppModel', 'Model');
class Albaran extends AppModel {
	public $displayField = 'referencia';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $belongsTo = array(
		'Empresa' => array(
			'className' => 'Empresa',
			'foreignKey' => 'empresa_id',
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
		)
		
	);
	public $hasMany = array(
		'Conceptoalbaran' => array(
			'className' => 'Conceptoalbaran',
			'foreignKey' => 'albaran_id',
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
		'Documento' => array(
			'className' => 'Documento',
			'foreignKey' => 'albaran_id',
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
	public $hasAndBelongsToMany = array(
		'Material' => array(
			'className' => 'Material',
			'joinTable' => 'albaranes_materiales',
			'foreignKey' => 'albaran_id',
			'associationForeignKey' => 'material_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)		
	);
	
	

}
?>