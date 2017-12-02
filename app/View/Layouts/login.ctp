<?php

$cakeDescription = __d('Gestmadel', 'Gestión de Feromadel S.L.');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('cake.generic');
		echo $this->Html->css('tabs');
		echo $this->Html->script('prototype');
		echo $this->Html->script('scriptaculous');
		echo $this->Html->script('tabs');
		
		echo $scripts_for_layout;		
	?>
</head>

<body>
	<div id="container">
		<div id="header">						
			<h1><?php echo $this->Html->link('Gestmadel: Gestión de Feromadel S.L.', 'http://feromadel.com'); ?></h1>								
		</div>		
		<div id="content">					
			<?php 
			echo $this->Session->flash();
			echo $content_for_layout; 
			?>				
		</div>						
	</div>
	<?php echo $this->element('bonos'); ?>		
	<?php echo $this->Js->writeBuffer(array('cached'=>true)); ?>
</body>
</html>

