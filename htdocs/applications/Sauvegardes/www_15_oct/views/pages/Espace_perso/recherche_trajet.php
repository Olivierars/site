<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<div class="container">
	
	<!-- FORMULAIRE de recherche d'un trajet -->
	<h1>Rechercher un trajet </h1>
	
	<?php echo form_open('Espace_perso/recherche_trajet',['class'=>'form-inline']);?>

		<div class="form-group">
			<label for="ville_depart" >Départ :</label>
			<input type="text" class = 'form-control' name="ville_depart" />
			<?php echo form_error('ville_depart') ?>
		</div>

		<div class="form-group">
			<label for="ville_arrivee">Arrivée :</label>
			<input type="text" class = 'form-control' name="ville_arrivee" />
			<?php echo form_error('ville_arrivee') ?>
		</div>

		<div class="form-group">
				<button type="submit" class="btn btn-default">Rechercher ce trajet</button>
		</div>

		<?php form_close(); ?> 

	<!--AFFICHAGE des résultats de la recherche -->	
	<h3>Trajets disponibles</h3>	

	<?php

 		if(!empty($results))
 		{
			foreach($results as $data) 
			{		
				$date = strtotime($data->date_trajet);
    			$dat = date('d/m/y', $date);
    			$heure = strtotime($data->heure_trajet);
    			$tme 	= date('H', $heure);
    			if($data_posteur[0]->role = 'accompagné')
    			{
    				$text = ' propose un accompagnement sur le trajet du ' ;
    			}
    			if($data_posteur[0]->role = 'accompagnateur')
    			{
    				$text = ' souhaiterait être accompagné(e) sur le trajet du ' ; 
    			}

    			
    			echo "--> ".ucfirst($data_posteur[0]->prenom) . " ".ucfirst($data_posteur[0]->nom). $text .$dat." à ".$tme." h " ;
 				echo "de ".ucfirst($data->ville_depart) . " >> " . ucfirst($data->ville_arrivee);
 				echo anchor("Espace_perso/postule_trajet/".$data->id, str_repeat("&nbsp;", 10)." Contacter ".ucfirst($data_posteur[0]->prenom)." pour ce trajet ?"."<br>");
 			}
		}
		else
		{
			echo "Aucun trajet n'est disponible sur cet itinéraire" ;
		}
 		
 		?>
 		<!-- <p><?php echo $links; ?></p> -->


</div>

</html>