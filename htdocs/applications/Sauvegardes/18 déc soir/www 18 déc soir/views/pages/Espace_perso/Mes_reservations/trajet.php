<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<div class="container">
	<ul class="nav nav-pills">
	<li role="presentation"  class="active"><a href="<?php echo site_url('Espace_perso/Mes_reservations/recherche_trajet') ?>">Rechercher un trajet</a></li>
    <li role="presentation"><a href="<?php echo site_url('Espace_perso/Mes_reservations/en_cours') ?>">Mes réservations en cours</a></li>
    <li role="presentation"><a href="<?php echo site_url('Espace_perso/Mes_reservations/archives') ?>">Mes réservations archivées</a></li>
	</ul>
	<br>

	<h3>Détail du trajet</h3>

	<?php
	// Détail du trajet  
		$id_trajet 		= $data_trajet[0]->id;
		$ville_depart 	= $data_trajet[0]->ville_depart;
		$ville_arrivee 	= $data_trajet[0]->ville_arrivee ;
		$date_trajet 	= $data_trajet[0]->date_trajet ;
		$message 		= $data_trajet[0]->message;
		$nom_posteur	= $data_posteur[0]->nom;
		$prenom_posteur	= $data_posteur[0]->prenom;
		$date 			= strtotime($date_trajet);
   		$date_trajet 	= date('d/m/y',$date);
    	$heure_trajet 	= date('H:i',$date);
	
	echo "Trajet proposé par ".ucfirst($prenom_posteur)." ".ucfirst($nom_posteur)."<br>"; 
	echo "De ".ucfirst($ville_depart) . " >> " . ucfirst($ville_arrivee)."<br>" ;
	echo "Le ".$date_trajet . " à ".$heure_trajet."<br>";
	echo "Message : ".$message."<br><br>"; ?>


	<section>
	<?php echo validation_errors(); ?>
	<?php echo form_open('Espace_perso/Mes_reservations/postule_trajet/'.$id_trajet,['class'=>'form-horizontal']);?>

	<h3 id="titre_form"> Proposez votre accompagnement sur ce trajet !	</h3>
	<div class="form-group">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
		 		<label for="message"></label>
				<input type="text" class = 'form-control' name="message" placeholder ="<?php echo "Laissez une message à ".$prenom_posteur." ".$nom_posteur ?>"/>
				<?php echo form_error('message') ?>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="row">
			<div class="col-md-offset-5">
				<button type="submit" class="btn btn-success">Proposer un accompagnement</button>
			</div>
		</div>
	</div>

	<?php form_close(); ?>

</section>

</div>

</html>