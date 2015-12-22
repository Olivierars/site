<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<div class="container">

	<ul class="nav nav-pills">
	  <li role="presentation"><a href="<?php echo site_url('Espace_perso/Mes_annonces/propose_trajet') ?>">Proposez un trajet</a></li>
	  <li role="presentation" class="active"><a href="<?php echo site_url('Espace_perso/Mes_annonces/a_venir') ?>">Mes propositions en cours</a></li>
	  <li role="presentation"><a href="<?php echo site_url('Espace_perso/Mes_annonces/archives') ?>">Mes propositions archivées</a></li>
	</ul>

	<h3>Mes propositions en cours</h3>	
		<?php
 		if(empty($results))
 		{
 			echo "Vous n'avez pas encore proposé de trajet" ; 
 		}
		else
		{
			foreach($results as $data) 
			{
				$date 	= strtotime($data->date_trajet);
				$current_date = time();
    			$diff = $date - $current_date ; 
    			
    			if($diff>=0)
    			{
    				$date_trajet 	= date('d/m/y',$date);
    				$heure_trajet 	= date('H:i',$date);
 					echo "Id ".$data->id." --> ".ucfirst($data->ville_depart) . " >> " . ucfirst($data->ville_arrivee)  . " le ".$date_trajet." à ".$heure_trajet." ";
 					echo anchor("Espace_perso/Mes_annonces/supprime_trajet/".$data->id,str_repeat("&nbsp;", 10)."Supprimer ce trajet ?"."<br>");
    			}
    			
 			}
		}
 		
 		?>
 		<p><?php echo $links; ?></p>

</div>

</html>