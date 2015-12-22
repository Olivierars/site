<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<div class="container">
  <ul class="nav nav-pills">
    <li role="presentation"><a href="<?php echo site_url('Espace_perso/Mes_reservations/recherche_trajet') ?>">Rechercher un trajet</a></li>
    <li role="presentation"><a href="<?php echo site_url('Espace_perso/Mes_reservations/en_cours') ?>">Mes réservations en cours</a></li>
    <li role="presentation" class="active"><a href="<?php echo site_url('Espace_perso/Mes_reservations/archives') ?>">Mes réservations archivées</a></li>
  </ul>
  <br>
 		<?php 
    $compteur = 0 ;
 		if(!empty($trajet))
 		{
 			$Nof_trajet = sizeof($trajet);
          
      for($i =0;$i<= $Nof_trajet-1 ; $i++ )
      {
        $date = strtotime($trajet[$i][0]->date_trajet);
        $current_date = time();
        $diff = $date - $current_date ; 

        if($diff<0)
        {
          $compteur++ ;
          $date_trajet  = date('d/m/y',$date);
          $heure_trajet   = date('H:i',$date);

          ?>
        <div class="panel panel-primary">
          <ul class="list-group">
            <div class="panel-body" id="listing_message">
            <?php
  		      echo "--> ".ucfirst($trajet[$i][0]->ville_depart) . " >> ".ucfirst($trajet[$i][0]->ville_arrivee)." le ".$date_trajet." à ".$heure_trajet." " ;
 			      echo "proposé par ".ucfirst($data_posteur[$i][0]->prenom) . " " . ucfirst($data_posteur[$i][0]->nom)."<br>";
            ?>
            </div>
          </ul> 
        </div>
        <?php 
    	  }  
      } 
		}
		if($compteur==0)
		{
			echo "Vous n'avez pas d'accompagnement en cours" ;
		}
 		?>
</div>