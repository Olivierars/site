<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<div class="container">
  <ul class="nav nav-pills">
    <li role="presentation"><a href="<?php echo site_url('Espace_perso/Mes_reservations/recherche_trajet') ?>">Rechercher un trajet</a></li>
    <li role="presentation"><a href="<?php echo site_url('Espace_perso/Mes_reservations/attente_confirmation') ?>">En attente de confimation</a></li>
    <li role="presentation"><a href="<?php echo site_url('Espace_perso/Mes_reservations/confirme') ?>">Confirmées</a></li>
    <li role="presentation" class="active"><a href="<?php echo site_url('Espace_perso/Mes_reservations/archives') ?>">Archivées</a></li>
  </ul>
  
  <h3>Mes réservations archivées </h3>
 		<?php 
    $j = 0 ;
 		if(!empty($trajet_confirme))
 		{
 			$Nof_trajet_confirme = sizeof($trajet_confirme);
          
      for($i =0;$i<= $Nof_trajet_confirme-1 ; $i++ )
      {
        $date = strtotime($trajet_confirme[$i][0]->date_trajet);
        $current_date = time();
        $diff = $date - $current_date ; 

        if($diff<0)
        {
          $j = $j+1 ;
          $date_trajet  = date('d/m/y',$date);
          $heure_trajet   = date('H:i',$date);

  			  echo "--> ".ucfirst($trajet_confirme[$i][0]->ville_depart) . " >> ".ucfirst($trajet_confirme[$i][0]->ville_arrivee)." le ".$date_trajet." à ".$heure_trajet." h  " ;
 				  echo "proposé par ".ucfirst($data_posteur_confirme[$i][0]->prenom) . " " . ucfirst($data_posteur_confirme[$i][0]->nom)."<br>";
    	  }  
      } 
		}
		if($j==0)
		{
			echo "Vous n'avez pas de trajet archivé" ;
		}
 		?>
</div>