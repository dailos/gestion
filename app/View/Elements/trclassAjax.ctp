<?php
	$id= rand(1,999999999);
	$class = "normalrow";
	if ($i % 2 == 0) $class = "altrow";		
	echo "<tr id='tr$id' class = '$class'  
						onclick=\"event.returnValue = false; return false;\" 
						onmouseover=\"this.className='selrow';\" 
						onmouseout=\"this.className='$class';\"".">";
	
	$this->Js->get('#tr'.$id)->event('click',$this->Js->request($url, array('async' => true,'update' => $update,  'evalScripts' =>true)));		
	echo $this->Js->writeBuffer(array('onDomReady' => false, 'inline' => true)); 
?>	