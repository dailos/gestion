<?php
App::uses('AppModel', 'Model');
class Documento extends AppModel {
	
	public $displayField = 'nombre';	
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $belongsTo = array('Albaran','Almacen','Cuenta','Empleado','Empresa','Factura','Gasto','Herramienta',
							'Incidencia','Material','Proyecto','Servicio','Tajo','Vehiculo','Apunte');

}
?>