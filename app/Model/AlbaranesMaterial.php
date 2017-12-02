<?php
App::uses('AppModel', 'Model');
class AlbaranesMaterial extends AppModel {

	public $displayField = 'nombre';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $belongsTo = array(
		'Albaran' => array(
			'className' => 'Albaran',
			'foreignKey' => 'albaran_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),		
		'Material' => array(
			'className' => 'Material',
			'foreignKey' => 'material_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
		
	);
	
	 public $validate = array(
        'cantidad' => array(
            'rule' => array('comparison', '>', 0),
            'message' => 'La cantidad debe ser mayor que 0'
        )
    );
 
}
?>