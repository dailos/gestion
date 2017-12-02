<?php
App::uses('AppController', 'Controller');
class DocumentosController extends AppController {

	public function add($fk_name = null,$fk_id = null) {
		if (!empty($this->request->data)) {
			$this->Documento->create();	
			if ($this->Documento->save($this->request->data)){
				if(is_uploaded_file($this->request->data['Documento']['archivo']['tmp_name'])){
					$archivo = $this->Documento->id."_".$this->request->data['Documento']['archivo']['name'];					
					$ruta = 'files'.DS.$archivo;					
					if(!move_uploaded_file($this->request->data['Documento']['archivo']['tmp_name'],WWW_ROOT.$ruta))
						$this->errorMsg($this->request->data['Documento']['referer']);
					else 
						$this->Documento->saveField('ruta',$ruta);											
				}else{
					$this->errorMsg($this->request->data['Documento']['referer']);
				}		
				$this->okMsg($this->request->data['Documento']['referer']);										
			}else {
				$this->errorMsg($this->request->data['Documento']['referer']);	
			}
		}
		$this->set(compact('fk_name','fk_id'));
		$this->set('referer',$this->referer());
	}

	public function view ($id = null){
		if (!$id) $this->errorMsg($this->referer());
		$archivo = $this->Documento->read(null,$id);	
		$ruta = $archivo['Documento']['ruta'];
		$ext = substr(strrchr($ruta, '.'), 1);	
        header ("Content-Disposition: attachment;
				filename=".$archivo['Documento']['nombre'].".".$ext."\n\n");
        header ("Content-Type: application/octet-stream");
        header ("Content-Length: ".filesize($ruta));
        readfile($ruta);
		
	}
	public function delete($id = null) {
		if (!$id) $this->errorMsg();
		$archivo = $this->Documento->read(null,$id);						
		if ($this->Documento->delete($id)){
			unlink($archivo['Documento']['ruta']);
			$this->okMsg($this->referer());		
		}
		$this->errorMsg($this->referer());
	}
}
?>