<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<div class="container">
  <ul class="nav nav-pills">
    <li role="presentation"><a href="<?php echo site_url('Espace_perso/Mes_reservations/recherche_trajet') ?>">Rechercher un trajet</a></li>
    <li role="presentation" class="active"><a href="<?php echo site_url('Espace_perso/Mes_reservations/attente_confirmation') ?>">En attente de confimation</a></li>
    <li role="presentation"><a href="<?php echo site_url('Espace_perso/Mes_reservations/confirme') ?>">Confirmés</a></li>
    <li role="presentation"><a href="<?php echo site_url('Espace_perso/Mes_reservations/archives') ?>">Archivés</a></li>
  </ul>

 		<h3>Mes accompagnements en attente de confirmation</h3>
 		<?php 

 		
 		if(!empty($trajet_en_attente))
 		{
 			$Nof_trajet_attente = sizeof($trajet_en_attente);
          
      for($i =0;$i<= $Nof_trajet_attente-1 ; $i++ )
      {
        $date         = strtotime($trajet_en_attente[$i][0]->date_trajet);
    		$date_trajet  = date('d/m/y',$date);
        $heure_trajet = date('H:i',$date);


    		echo "--> ".ucfirst($trajet_en_attente[$i][0]->ville_depart) . " >> ".ucfirst($trajet_en_attente[$i][0]->ville_arrivee)." le ".$date_trajet." à ".$heure_trajet." " ;
 				echo "proposé par ".ucfirst($data_posteur_attente[$i][0]->prenom) . " " . ucfirst($data_posteur_attente[$i][0]->nom);
        echo str_repeat("&nbsp;", 10); 
        echo anchor("Espace_perso/Mes_reservations/annule_reservation/".$id_resa[$i],"Annuler cette réservation ?"."<br>");

      }
		}
		else
		{
			echo "Vous n'avez pas  d'accompagnement en attente de confirmation" ;
		}
 		?>
</div>
 		