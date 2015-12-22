<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<div class="container">
<h1>Votre espace personnel</h1>

Bonjour tu as l'identifiant <?php echo $id; ?> et l'email <?php echo $email; ?> <br>

<?php 
foreach($data_profil as $data) 
	{	
		$id 	= $data->id;
		$nom 	= $data->nom;
		$prenom = $data->prenom ;
		$email 	= $data->email ;
		$role 	= $data->role;
	}
 ?>


<?php echo "Bonjour " .ucfirst($prenom)." ".ucfirst($nom);?> <br>
<?php echo "Tu es un ".$role ; ?>



</div>

</html>