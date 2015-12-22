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

</div>

</html>