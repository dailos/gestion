<?php
App::uses('AppModel', 'Model');
class Factura extends AppModel {

	public $displayField = 'descripcion';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $belongsTo = array(					
		'Proyecto' => array(
			'className' => 'Proyecto',
			'foreignKey' => 'proyecto_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)		
	);

	public $hasMany = array(
		'Apunte' => array(
			'className' => 'Apunte',
			'foreignKey' => 'factura_id',
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
			'foreignKey' => 'factura_id',
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
		'Tajo' => array(
			'className' => 'Tajo',
			'foreignKey' => 'factura_id',
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
	
	/*public function paginateCount($conditions = null, $recursive = 0, $extra = array()) {
    	$parameters = compact('conditions');
    	$this->recursive = $recursive;
    	$count = $this->find('count', array_merge($parameters, $extra));
    	if (isset($extra['group'])) {
        	$count = $this->getAffectedRows();
    	}
    	return $count;
	}*/

}
?>