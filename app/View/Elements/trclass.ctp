<?php
	$class = "normalrow";
	if ($i % 2 == 0) $class = "altrow";		
	
	if ($url) $onclick = "onclick=\"location.href='". $this->Html->url( $url) . "';\" ";
	else $onclick = "";
	echo "<tr class = '$class' $onclick   onmouseover=\"this.className='selrow';\" onmouseout=\"this.className='$class';\"".">";
?>	