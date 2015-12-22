<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<div class="container">

<?php 
if($this->session->userdata('logged_in'))
{
	echo anchor('Espace_perso','Retour à mon espace perso') ;
}
?>

<br>
PLan du site 

Utile pour le référencement  

</div>
</html>