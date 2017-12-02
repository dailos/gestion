<?php
App::uses('AppController', 'Controller');
class ProyectosController extends AppController {
	
	public function beforeFilter(){		
		$this->set('estadosfactura',Configure::read('estadosfactura'));
		$this->set('estadosproyecto',Configure::read('estadosproyecto'));
		$this->loadtaxes();
	}
	
	public function index() {		
		if($this->request->data['Proyecto'])
			$this->getconditions($this->request->data['Proyecto'],'Proyecto', Configure::read('estadosproyecto'),
									array('campofecha'=>'fechapedido','filtro'=> array('Proyecto.titulo')));
		$filter = SessionComponent::read('filter.Proyecto');
		if(!$conditions = SessionComponent::read('sqlconditions.Proyecto')){		
			$conditions = "";
			$filter = Configure::read('filter.Proyecto');
			foreach ($filter['checkbox'] as $valor){				
				$conditions.= "  Proyecto.estado_id like '$valor' OR ";						
			}
			$conditions = substr($conditions,0,-4);
		}		
		$this->set('filter',$filter);	
		
		$this->Proyecto->recursive = 1;				
		if($this->request->data['Proyecto']['resumen']){			
			$this->set('proyectos', $this->Proyecto->find('all',array('conditions'=>$conditions)));
			$this->set('resumen', true);
		}else{								
			$this->paginate = array('order' => array('Proyecto.fechapedido' => 'desc'));
			$this->set('proyectos', $this->paginate('Proyecto',$conditions));
			$this->set('resumen', false);
		}					
		$this->titulo('Listado de Proyectos');		
		$this->set('filtrado', $this->request->isAjax());
	}

	public function view($id = null) {
		if (!$id) $this->errorMsg();		
		$this->setproyectstate($id);		
		$this->Proyecto->recursive = 3;		
		$proyecto = $this->Proyecto->read(null,$id);	
		$this->set(compact('proyecto'));
		$this->titulo('Proyecto '.$proyecto['Proyecto']['titulo']);	
	}
	
	public function add($empresa_id = null) {		
		if (!empty($this->request->data)) {		
			$this->Proyecto->create();
			if ($this->Proyecto->save($this->request->data)) $this->okMsg(array('action' => 'view',$this->Proyecto->id,true));			
			else $this->errorMsg();		
		}
		if($empresa_id==null) $this->errorMsg();
		$this->titulo('Crear nuevo proyecto');
		$this->set('empresa_id',$empresa_id);
	}		

	public function edit($id = null) {
		if (!$id && empty($this->request->data)) $this->errorMsg();

		if (!empty($this->request->data)) {
			if ($this->Proyecto->save($this->request->data)) $this->okMsg(array('action' => 'view',$id));				
			else $this->errorMsg();
		}
		
		if (empty($this->request->data)){
			$this->request->data = $this->Proyecto->read(null, $id);
			$this->loadModel("Empresa");		
			$empresas = $this->Empresa->find('list',array('conditions'=>'Empresa.relacion_id like '. CLIENTE .' OR Empresa.relacion_id like ' . CLIENTEYPROVEEDOR));			
			$this->set(compact('empresas'));
		}
	}

	public function delete($id = null) {
		if (!$id) $this->errorMsg();
		$proyecto =  $this->Proyecto->read(null,$id);		
		if(!empty($proyecto['Factura']))$this->errorMsg('view/'.$id,'Existen facturas relacionadas, imposible eliminar');		
		if(!empty($proyecto['Tajo']))$this->errorMsg('view/'.$id,'Existen tajos o presupuestos relacionados, imposible eliminar');							
		if ($this->Proyecto->delete($id)) $this->okMsg();		
		else $this->errorMsg();
	}
}
?>