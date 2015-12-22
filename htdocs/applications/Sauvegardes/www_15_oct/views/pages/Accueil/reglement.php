<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<div class="container">

	<h2>Réglement </h2>

	<?php 
if($this->session->userdata('logged_in'))
{
	echo anchor('Espace_perso','Retour à mon espace perso') ;
}
?>
<br>
	On n'est pas la pour rigoler

</div>

</div>

</html>