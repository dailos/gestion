<?php
App::uses('AppModel', 'Model');
class MaterialesTajo extends AppModel {

	public $displayField = 'nombre';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $belongsTo = array(
		'Material' => array(
			'className' => 'Material',
			'foreignKey' => 'material_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Tajo' => array(
			'className' => 'Tajo',
			'foreignKey' => 'tajo_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	 public $validate = array(
        'cantidad' => array(
            'rule' => array('comparison', '>', 0),
            'message' => 'La cantidad debe ser mayor que 0'
        ),
        'precio' => array(
            'rule' => array('comparison', '>', 0),
            'message' => 'La precio debe ser mayor que 0'
        ),
        'coste' => array(
            'rule' => array('comparison', '>', 0),
            'message' => 'La costo debe ser mayor que 0'
        ),
        'pdescuento' => array(
            'rule' => array('comparison', '>=', 0),
            'message' => 'La descuento debe ser mayor que 0'
        )                 
    );
 
}
?>