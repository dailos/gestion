<?php if(!$resumen):?>
<div id="paginacion">
<p>
<?php
echo $this->Paginator->counter(array('format' => 'Página %page% de %pages%, mostrando  %current% elementos de un total de %count%, desde el %start% al %end%'));
?>	
</p>

<div class="paging">
<?php
	echo $this->Paginator->first('<< primero');
	echo $this->Paginator->prev('< ' . __('anterior'), array(), null, array('class' => 'prev disabled'));
	echo $this->Paginator->numbers(array('separator' => ''));
	echo $this->Paginator->next(__('siguiente') . ' >', array(), null, array('class' => 'next disabled'));
	echo $this->Paginator->last('último >>');
?>
</div>
</div>
<?php endif; ?>