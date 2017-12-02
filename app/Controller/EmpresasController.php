<?php
App::uses('AppController', 'Controller');
class EmpresasController extends AppController {

	public function beforeFilter(){
		$this->set('relaciones',Configure::read('relaciones'));
		$this->set('estadosfactura',Configure::read('estadosfactura'));
		$this->set('estadosproyecto',Configure::read('estadosproyecto'));	
	}	
	
	public function index() {
		$filters = array(); 	
		if($this->request->data){
			$this->set('filtrado',true);
			$filters = array("nombre like '%".$this->request->data['Empresa']['filtro']."%'");		
		}		
		$this->Empresa->recursive = 0;
		$this->paginate = array('order' => array('Empresa.nombre' => 'asc'));
		$this->set('empresas', $this->paginate('Empresa',$filters));						
		$this->titulo('Listado de empresas');
	}

	public function view($id = null) {
		$this->Empresa->recursive = 3;
		$empresa = $this->Empresa->read(null, $id);
		$this->set('empresa',$empresa );
		if($id == 1) $this->titulo('Datos de la empresa');
		else $this->titulo('Empresa '.$empresa['Empresa']['nombre']);		
	}

	public function add() {
		if (!empty($this->request->data)) {
			$this->Empresa->create();
			if ($this->Empresa->save($this->request->data)) $this->okMsg();
			else $this->errorMsg();
		}		
		$this->titulo('Añadir empresa');
	}

	public function edit($id = null) {
		if (!empty($this->request->data)) {
			if ($this->Empresa->save($this->request->data)) $this->okMsg(array('action'=>'view',$id));
			else $this->errorMsg(array('action'=>'view',$id));			
		}
		if (empty($this->request->data)) $this->request->data = $this->Empresa->read(null, $id);
	}

	public function delete($id = null) {
		if (!$id) $this->errorMsg();
		$empresa =  $this->Empresa->read(null,$id);
		if(!empty($empresa['Factura']))$this->errorMsg('view/'.$id,'Existen facturas relacionadas, imposible eliminar');	
		if(!empty($empresa['Empleado']))$this->errorMsg('view/'.$id,'Existen empleados relacionados, imposible eliminar');	
		if(!empty($empresa['Presupuesto']))$this->errorMsg('view/'.$id,'Existen tiene presupuestos relacionados, imposible eliminar');	
		if(!empty($empresa['Proyecto']))$this->errorMsg('view/'.$id,'Existen tiene proyectos relacionados, imposible eliminar');	
		if(!empty($empresa['Albaran']))$this->errorMsg('view/'.$id,'Existen tiene albaranes relacionados, imposible eliminar');	
		if(!empty($empresa['Pedido']))$this->errorMsg('view/'.$id,'Existen tiene pedidos relacionados, imposible eliminar');	
		if(!empty($empresa['Gasto']))$this->errorMsg('view/'.$id,'Existen gastos relacionados, imposible eliminar');	
		if ($this->Empresa->delete($id)) $this->okMsg();
		$this->errorMsg();
	}
}
?>