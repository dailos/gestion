<?php
App::uses('AppModel', 'Model');
class Conceptoalbaran extends AppModel {

	public $displayField = 'concepto';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $belongsTo = array(		
		'Albaran' => array(
			'className' => 'Albaran',
			'foreignKey' => 'albaran_id',
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