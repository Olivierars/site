<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<div class="container">
	<ul class="nav nav-pills">
	  	<li role="presentation" class="active"><a href="<?php echo site_url('Espace_perso/Mes_reservations/recherche_trajet') ?>">Rechercher un trajet</a></li>
	  	<li role="presentation"><a href="<?php echo site_url('Espace_perso/Mes_reservations/attente_confirmation') ?>">En attente de confimation</a></li>
	  	<li role="presentation"><a href="<?php echo site_url('Espace_perso/Mes_reservations/confirme') ?>">Confirmées</a></li>
	  	<li role="presentation"><a href="<?php echo site_url('Espace_perso/Mes_reservations/archives') ?>">Archivées</a></li>
	</ul>
	<br>
	<!-- FORMULAIRE de recherche d'un trajet -->
	
	<?php echo form_open('Espace_perso/Mes_reservations/recherche_trajet',['class'=>'form-inline']);?>
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
    			$date_trajet 	= date('d/m/y',$date);
    			$heure_trajet 	= date('H:i',$date);

    			if($data_posteur[0]->role = 'accompagné')
    			{
    				$text = ' propose un accompagnement sur le trajet du ' ;
    			}
    			if($data_posteur[0]->role = 'accompagnateur')
    			{
    				$text = ' souhaiterait être accompagné(e) sur le trajet du ' ; 
    			}

    			
    			echo "--> ".ucfirst($data_posteur[0]->prenom) . " ".ucfirst($data_posteur[0]->nom). $text .$date_trajet." à ".$heure_trajet." " ;
 				echo "de ".ucfirst($data->ville_depart) . " >> " . ucfirst($data->ville_arrivee);
 				echo str_repeat("&nbsp;", 10);
 				echo anchor("Espace_perso/Mes_reservations/trajet/".$data->id,"Voir détail trajet");
 				// echo str_repeat("&nbsp;", 10);
 				// echo anchor("Espace_perso/Mes_reservations/postule_trajet/".$data->id," Contacter ".ucfirst($data_posteur[0]->prenom)." pour ce trajet ?"."<br>");
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