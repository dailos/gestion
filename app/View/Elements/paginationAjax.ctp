<div id="paginacion">
<div class="paging">
<?php
	$this->Paginator->options(array('update' => '#selectAjax','evalScripts' => true));
	
	echo $this->Paginator->first('<< primero');
	echo $this->Paginator->prev('< ' . __('anterior'), array(), null, array('class' => 'prev disabled'));
	echo $this->Paginator->numbers(array('separator' => ''));
	echo $this->Paginator->next(__('siguiente') . ' >', array(), null, array('class' => 'next disabled'));
	echo $this->Paginator->last('último >>');	
	echo $this->Js->writeBuffer(array('onDomReady' => false, 'inline' => true)); 
?>
</div>
</div>
