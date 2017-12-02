<?php
App::uses('AppController', 'Controller');
class ServiciosController extends AppController {

	public function index() {
		$filters = array(); 	
		if($this->request->data){
			$this->set('filtrado',true);
			$filters = array("nombre like '%".$this->request->data['Servicio']['filtro']."%'");
		}		
		$this->Servicio->recursive = 0;
		$this->paginate = array('order' => array('Servicio.nombre' => 'asc'));
		$this->set('servicios', $this->paginate('Servicio',$filters));						
		$this->titulo('Listado de servicios');
	}
		

	public function view($id = null) {
		if (!$id) $this->errorMsg();
		
		$this->loadModel('Tajo');
		$tajos = $this->Tajo->query('SELECT `Tajo`.`id`, `Tajo`.`referencia`, `Tajo`.`descripcion`, `Tajo`.`fecha`, `Tajo`.`npresupuesto`,
		 	`Tajo`.`proyecto_id`, `Proyecto`.`id`, `Proyecto`.`titulo`,`ServiciosTajo`.`servicio_id`,`ServiciosTajo`.`tajo_id`,`ServiciosTajo`.`cantidad`
			FROM `tajos` AS `Tajo` 			
			LEFT JOIN `proyectos` AS `Proyecto` ON (`Tajo`.`proyecto_id` = `Proyecto`.`id`)  
			LEFT JOIN `servicios_tajos` AS `ServiciosTajo` ON (`ServiciosTajo`.`tajo_id` = `Tajo`.`id`) 
			WHERE `ServiciosTajo`.`servicio_id` = '.$id );
				
		$this->Servicio->recursive = 1;
		$servicio = $this->Servicio->read(null, $id);					
		$this->set(compact('servicio' ,'tajos'));		
		$this->titulo('Servicio '.$servicio['Servicio']['nombre']);	
	}
	
	public function select($tajo_id =null){	
		if(!$tajo_id) $this->errorMsg();
		$filter = array(); 		
		if($this->request->data){
			$this->set('filtrado',true);			
			$filter = array("Servicio.nombre like '%".$this->request->data['Servicio']['filtro']."%'");
			SessionComponent::write('filter.Servicio', $filter);
		}
		$filter = SessionComponent::read('filter.Servicio');			
		$this->Servicio->recursive = 0;
		$this->set('tajo_id',$tajo_id);
		$this->paginate = array('limit' => 10,'order' => array('Servicio.nombre' => 'asc'));	
		$this->set('servicios', $this->paginate('Servicio',$filter));			
		$this->titulo('Selecciona Servicio');		
	}

	public function add() {
		if (!empty($this->request->data)) {
			$this->Servicio->create();
			if ($this->Servicio->save($this->request->data)) $this->okMsg();
			else $this->errorMsg();				
		}
		$this->titulo('Añadir servicio');		
	}

	public function edit($id = null) {
		if (!$id && empty($this->request->data)) $this->errorMsg();	
		
		if (!empty($this->request->data)) {
			if ($this->Servicio->save($this->request->data)) $this->okMsg();
			else $this->errorMsg();				
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Servicio->read(null, $id);
		}		
	}

	public function delete($id = null) {
		if (!$id) $this->errorMsg();
			
		$servicio = $this->Servicio->read(null,$id);
		if(!empty($servicio['ServiciosTajo']))$this->errorMsg('view/'.$id,'El servicio tiene tajos relacionados, imposible eliminar');	
		if ($this->Servicio->delete($id))$this->okMsg();
		$this->errorMsg();		
	}
}
?>