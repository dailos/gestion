<?php
App::uses('AppController', 'Controller');
class MaterialesController extends AppController {

	public function index() {
		$filters = array(); 	
		if($this->request->data){
			$this->set('filtrado',true);
			$filters = array("Material.nombre like '%".$this->request->data['Material']['filtro']."%'");
		}	
		$this->Material->recursive = 0;
		$this->paginate = array('order' => array('Material.nombre' => 'asc'));
		$this->set('materiales', $this->paginate('Material',$filters));				
		$this->titulo('Listado de materiales');
	}

	public function view($id = null) {
		if (!$id) $this->errorMsg();
		
		$this->loadModel('Tajo');
		$tajos = $this->Tajo->query('SELECT `Tajo`.`id`, `Tajo`.`referencia`, `Tajo`.`descripcion`, `Tajo`.`fecha`, `Tajo`.`npresupuesto`,
		 	`Tajo`.`proyecto_id`, `Proyecto`.`id`, `Proyecto`.`titulo`,`MaterialesTajo`.`material_id`,
		 	`MaterialesTajo`.`tajo_id`,`MaterialesTajo`.`cantidad`
			FROM `tajos` AS `Tajo` 			
			LEFT JOIN `proyectos` AS `Proyecto` ON (`Tajo`.`proyecto_id` = `Proyecto`.`id`)  
			LEFT JOIN `materiales_tajos` AS `MaterialesTajo` ON (`MaterialesTajo`.`tajo_id` = `Tajo`.`id`) 
			WHERE `MaterialesTajo`.`material_id` = '.$id );
		$this->loadModel('Albaran');
		$albaranes = $this->Tajo->query('SELECT `Albaran`.`id`, `Albaran`.`referencia`, `Albaran`.`descripcion`, `Albaran`.`fecha`, `Albaran`.`npedido`,
		 	`Albaran`.`nalbaran`,`AlbaranesMaterial`.`material_id`,`AlbaranesMaterial`.`albaran_id`,`AlbaranesMaterial`.`cantidad`
			FROM `albaranes` AS `Albaran` 					
			LEFT JOIN `albaranes_materiales` AS `AlbaranesMaterial` ON (`AlbaranesMaterial`.`albaran_id` = `Albaran`.`id`) 
			WHERE `AlbaranesMaterial`.`material_id` = '.$id );
				
		$this->Material->recursive = 1;
		$material = $this->Material->read(null, $id);	
		
		$this->set(compact('tajos', 'albaranes','material'));		
		$this->titulo('Material '.$material['Material']['nombre']);
	}	
	
	public function add() {
		if (!empty($this->request->data)) {
			$this->Material->create();
			$this->request->data['Material']['fecha'] = date("Y-m-d H:i:s");	
			if ($this->Material->save($this->request->data)) $this->okMsg();
			else $this->errorMsg();
		}
		$almacenes = $this->Material->Almacen->find('list');
		$this->set(compact('almacenes'));
		$this->titulo('Añadir material');
	}		

	public function edit($id = null) {
		if (!$id && empty($this->request->data)) $this->errorMsg();
		if (!empty($this->request->data)) {
			$this->request->data['Material']['fecha'] = date("Y-m-d H:i:s");	
			if ($this->Material->save($this->request->data)) $this->okMsg(array('action' =>'view',$this->request->data['Material']['id']));
			else $this->errorMsg();	
		}
		if (empty($this->request->data))  $this->request->data = $this->Material->read(null, $id);
		$almacenes = $this->Material->Almacen->find('list');
		$this->set(compact('almacenes'));		
	}
	
	public function delete($id = null) {
		if (!$id) $this->errorMsg();
		
		$material = $this->Material->read(null,$id);
		if(!empty ($material['AlbaranesMaterial']) ) $this->errorMsg('view/'.$id,'Existen Albaranes asociados, imposible eliminar el material');
		if(!empty($material['MaterialesTajo'])) $this->errorMsg('view/'.$id,'Existen tajos asociados, imposible eliminar el material');
		if ($this->Material->delete($id))$this->okMsg();
		$this->errorMsg();				
	}
		
		
	public function select($id =null,$controlador = null){	
		if(!$id || !$controlador) $this->errorMsg();
		$filter = array(); 	
		if($this->request->data){
			$this->set('filtrado',true);
			$filter = array("Material.nombre like '%".$this->request->data['Material']['filtro']."%'");									
			SessionComponent::write('filter.Material', $filter);	
		}	
				
		$filter = SessionComponent::read('filter.Material');		
		$this->set('filter',$filter);			
		$this->Material->recursive = 0;
		$this->set('id',$id);
		$this->set('controladororigen',$controlador);		
		$this->paginate = array('limit' => 10,'order' => array('Material.nombre' => 'asc'));
		$materiales = $this->paginate('Material',$filter);
		$this->set('materiales',$materiales);				
		$this->titulo('Selecciona Material');				 
	}
	
	
}
?>