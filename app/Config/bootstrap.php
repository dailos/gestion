<?php
/**
 * This file is loaded automatically by the app/webroot/index.php file after core.php
 *
 * This file should load/create any application wide configuration settings, such as 
 * Caching, Logging, loading additional configuration files.
 *
 * You should also use this file to include any files that provide global functions/constants
 * that your application uses.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.10.8.2117
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

// Setup a 'default' cache configuration for use in the application.
Cache::config('default', array('engine' => 'File'));
App::import('Core', 'Debugger');
/**
 * The settings below can be used to set additional paths to models, views and controllers.
 *
 * App::build(array(
 *     'Plugin' => array('/full/path/to/plugins/', '/next/full/path/to/plugins/'),
 *     'Model' =>  array('/full/path/to/models/', '/next/full/path/to/models/'),
 *     'View' => array('/full/path/to/views/', '/next/full/path/to/views/'),
 *     'Controller' => array('/full/path/to/controllers/', '/next/full/path/to/controllers/'),
 *     'Model/Datasource' => array('/full/path/to/datasources/', '/next/full/path/to/datasources/'),
 *     'Model/Behavior' => array('/full/path/to/behaviors/', '/next/full/path/to/behaviors/'),
 *     'Controller/Component' => array('/full/path/to/components/', '/next/full/path/to/components/'),
 *     'View/Helper' => array('/full/path/to/helpers/', '/next/full/path/to/helpers/'),
 *     'Vendor' => array('/full/path/to/vendors/', '/next/full/path/to/vendors/'),
 *     'Console/Command' => array('/full/path/to/shells/', '/next/full/path/to/shells/'),
 *     'locales' => array('/full/path/to/locale/', '/next/full/path/to/locale/')
 * ));
 *
 */

/**
 * Custom Inflector rules, can be set to correctly pluralize or singularize table, model, controller names or whatever other
 * string is passed to the inflection functions
 *
 * Inflector::rules('singular', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 * Inflector::rules('plural', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 *
 */
Inflector::rules('singular', array('/([d|j|m|n|l|r|s|y|z])es$/i' => '\1','/as$/i' => 'a','/([ti])a$/i' => '\1a'));
Inflector::rules('plural', array('/([d|j|m|n|l|r|s|y|z])$/i' => '\1es','/a$/i' => '\1as',));
/**
 * Plugins need to be loaded manually, you can either load them one by one or all of them in a single call
 * Uncomment one of the lines below, as you need. make sure you read the documentation on CakePlugin to use more
 * advanced ways of loading plugins
 *
 * CakePlugin::loadAll(); // Loads all plugins at once
 * CakePlugin::load('DebugKit'); //Loads a single plugin named DebugKit
 *
 */

define('ACCION_OK','Acción realizada correctamente');
define('ACCION_FAIL','Se ha producido un error al intentar realizar la acción solicitada');
define('SISTEMA',1);
define('ADMIN_EMAIL','claudio@feromadel.com');	
define('FORMA_DE_PAGO','Transferencia Bancaria CCC  1491 0001 29 2073042224');
define('VALIDEZ_PRESUPUESTO','Este presupuesto tiene una validez de un mes');
define('LEMA_EMPRESARIAL','Montajes y reparaciones eléctricas');
define('FAC_CUERPO1', 'Su factura está lista para descargar en el siguiente enlace:');
define('FAC_CUERPO2', 'Reciba un atento saludo.');
define('PRE_CUERPO1', 'Su presupuesto está listo para descargar en el siguiente enlace:');
define('PRE_CUERPO2', 'Reciba un atento saludo.');
define('CIERRE_PAG', 'Devanado de motores generadores y transformadores - Reparaciones navales e industriales <br> Registro Mercantil de Las Palmas, Tomo 952 Folio 117 Hoja G.C. 5264 - Insc.<br><br><center><a href="http://feromadel.com" title="feromadel.com">feromadel.com</a></center>');
define('IMPUESTODEFECTO',6);
/*Relaciones entre empresas*/
define('OTRA',1);
define('CLIENTE',2);
define('PROVEEDOR',3);
define('CLIENTEYPROVEEDOR',4);
Configure::write('relaciones', array(1 =>'Otra',2=>'Cliente', 3=> 'Proveedor',4=>'Cliente y proveedor' ));

/*Metodos de pago y traspasos*/
define('OTRO',1);
define('TRANSFERENCIA',2);
define('EFECTIVO',3);
define('CHEQUE',4);
define('TARJETA',5);
define('RECIBO',6);
define('PAGARE',7);
define('TRAS_ORIG',8);
define('TRAS_DEST',9);
Configure::write('metodospago', array(1 =>'Otro',2=>'Transferencia Bancaria', 3=> 'Efectivo',4=>'Cheque',5=>'Tarjeta de crédito',
					6=> 'Recibo bancario',7=>'Pagaré'));
 
 /*Estado de las facturas y gastos*/
define('ABIERTA',2);
define('CERRADA',3);
define('COBRADA',4);
define('PAGADA',4);
Configure::write('estadosfactura', array(2 =>'Abierta',3=>'Cerrada', 4=>'Cobrada'));
Configure::write('estadosgasto', array(2 =>'Abierto',3=>'Cerrado', 4=>'Pagado'));

/*Estado de los proyectos*/
define('SININICIAR',0);
define('PRESUPUESTADO',1);
define('INICIADO',2);
define('FACTURADO',3); // Todas los tajos relacionados con facturas, y esas facturas cerradas
define('COBRADO',4);
Configure::write('estadosproyecto', array(0=>'Sin iniciar',1 =>'Presupuestado',2=>'Pendiente Facturar', 3=> 'Pendiente de cobro',4=>'Cobrado'));

/*Filtros*/
Configure::write('filter',array('Proyecto' => array('checkbox' =>array(SININICIAR,PRESUPUESTADO,INICIADO,FACTURADO),'inidate' => '2012-01-01', 'enddate' =>  '2013-12-31'),
								'Factura'  => array('checkbox' => array(ABIERTA,CERRADA),   'inidate' => '2012-01-01', 'enddate' =>  '2013-12-31'),
								'Gasto'    => array('checkbox' => array(ABIERTA,CERRADA),   'inidate' => '2012-01-01', 'enddate' =>  '2013-12-31')));
?>