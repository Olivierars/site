<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<div class="container">
	<ul class="nav nav-pills">
	  	<li role="presentation" class="active"><a href="<?php echo site_url('Espace_perso/Mes_reservations/recherche_trajet') ?>">Rechercher un trajet</a></li>
	  	<li role="presentation"><a href="<?php echo site_url('Espace_perso/Mes_reservations/en_cours') ?>">Mes réservations en cours</a></li>
	  	<li role="presentation"><a href="<?php echo site_url('Espace_perso/Mes_reservations/archives') ?>">Mes réservations archivées</a></li>
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

		<input type="hidden" name="compteur" value="1">

		<div class="form-group">
			<button type="submit" class="btn btn-success">Rechercher ce trajet</button>
		</div>

		<?php form_close(); ?> 
		<br> <br>
	<!--AFFICHAGE des résultats de la recherche -->	
	<?php
 		if(!empty($results))
 		{
			foreach($results as $data) 
			{		
				$date = strtotime($data->date_trajet);
    			$date_trajet 	= date('d/m/y',$date);
    			$heure_trajet 	= date('H:i',$date);

    			?>
				<div class="panel panel-primary">
					<ul class="list-group">
						<div class="panel-body" id="listing_message">
							
							<?php
							echo "Accompagnez <strong> ".strtoupper($data_posteur[0]->prenom);
							echo " </strong> sur le trajet <strong> ".ucfirst($data->ville_depart) . " >> " . ucfirst($data->ville_arrivee)."</strong>";
			    			echo " le ".$date_trajet." à ".$heure_trajet." ! " ;
			 				?>
			 				<a href="<?php echo site_url('Espace_perso/Mes_reservations/trajet/'.$data->id) ?>" > Voir le détail du trajet </a>
		    			</div>
	    			</ul> 		
				</div>
			<?php 
 			}
		}
		else
		{	
			if ($compteur == 1) {
				echo "Il n'y a pour le moment pas de demande d'accompagnement sur cet itinéraire" ;					
			}		
		}
 	?>


</div>

</html>