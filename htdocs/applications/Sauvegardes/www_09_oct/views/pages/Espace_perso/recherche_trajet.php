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
	<?php
 		if(!empty($results))
 		{
 			echo "Voici les trajets correspondant à votre recherche :" ; 

			foreach($results as $data) 
			{
				$date = strtotime($data->date_trajet);
    			$dat = date('d/m/y', $date);
    			$heure = strtotime($data->heure_trajet);
    			$tme 	= date('H', $heure);
    			echo $data->nom . "propose un trajet le ".$dat." à ".$tme." h" ;
 				echo "de ".ucfirst($data->ville_depart) . " à " . ucfirst($data->ville_arrivee);
 			}
		}
 		
 		?>
 		<p><?php echo $links; ?></p>


</div>

</html>