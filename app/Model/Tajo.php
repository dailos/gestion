<?php
App::uses('AppModel', 'Model');
class Tajo extends AppModel {

	public $displayField = 'referencia';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $belongsTo = array(		
		'Factura' => array(
			'className' => 'Factura',
			'foreignKey' => 'factura_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Proyecto' => array(
			'className' => 'Proyecto',
			'foreignKey' => 'proyecto_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
		
	);

	public $hasMany = array(
		'Documento' => array(
			'className' => 'Documento',
			'foreignKey' => 'tajo_id',
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
		'Empleado' => array(
			'className' => 'Empleado',
			'joinTable' => 'empleados_tajos',
			'foreignKey' => 'tajo_id',
			'associationForeignKey' => 'empleado_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		),
		'Material' => array(
			'className' => 'Material',
			'joinTable' => 'materiales_tajos',
			'foreignKey' => 'tajo_id',
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
		),
		'Servicio' => array(
			'className' => 'Servicio',
			'joinTable' => 'servicios_tajos',
			'foreignKey' => 'tajo_id',
			'associationForeignKey' => 'servicio_id',
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