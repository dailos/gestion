<?php if(!$filtrado):?>
<div class="title">
<?php echo $this->Html->image($icono, array('title'=>$titulo,'class'=>'imagentitulo')) ;?><h1><?php echo $titulo;?></h1>
	<div class="actions">
		<?php echo $this->Html->link($this->Html->image("back.png"), array( 'action' => 'index'), array( 'escape' => false) );	?>
	</div>	
	<div class=filtro>
		<?php  	
		echo $this->Form->create('Grafica'); 
		?>
		
		<div class="opcionesfiltro">
			<?php 
			$years = array('2012' => '2012', '2013' => '2013', '2014' => '2014','2015' => '2015');		
			echo $this->Form->input('year', array('label'=>'Año: ','options' => $years, 'default' => date('Y')));
			
			foreach ($series as $valor => $nombre){
				echo $this->Form->checkbox($nombre, array('checked' =>true));
				echo $this->Form->label($nombre);	
			}					
			
			$this->Js->get('#Grafica'.ucfirst($action).'Form');
			$this->Js->event('change', $this->Js->request(array('action' => $action),
								array('update'=>'#filtrado','dataExpression'=>true,  'evalScripts'=>true,
								'data'=> $this->Js->serializeForm(array('isForm' => true, 'inline' => true)))));	
			
			$this->Js->get('#Grafica'.ucfirst($action).'Form');
			$this->Js->event('checked', $this->Js->request(array('action' => $action),
								array('update'=>'#filtrado','dataExpression'=>true,  'evalScripts'=>true,
								'data'=> $this->Js->serializeForm(array('isForm' => true, 'inline' => true)))));									
			echo $this->Js->writeBuffer(array('onDomReady' => false, 'inline' => true)); 
			?>
		</div>	
	</div>
</div>
<div  id="filtrado" class="view">
<?php endif;?>
	<center>
		<div id="grafica">
			<?php echo $grafica;?>
		</div>
	</center>
	<div  id="resumen" >	
		<div>
		<?php
			if(is_array($nombre)) {
				$i = 0; $class = ' class="altrow"';?>	
				<dl class="anchofijo">
				<?php foreach($nombre as $key=> $value ){ ?>				
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo $value; ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $this->Format->money($valor[$key] ); ?>
					&nbsp;
				</dd>			
		<?php 		
				}
			}
		?>
		</dl>
		</div>
	</div>
	
<?php if(!$filtrado):?>
</div>
<?php endif;?>