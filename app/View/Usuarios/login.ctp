<center><div class="login">
<?php echo $this->Form->create('Usuario', array('action' => 'login'));
    echo $this->Form->input('username',array('label' => 'Usuario')); 
    echo $this->Form->input('password',array('label' => 'Contraseña'));  
	echo $this->Form->end('Login');?>
</div>
</center>

