<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<div class="container">
	
	<h1>Mes trajets </h1>

	<h3>Proposer un nouveau trajet </h3>

		<?php echo form_open('Espace_perso/propose_trajet',['class'=>'form-inline']);?>

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
			<label for="date_trajet" >Date :</label>
			<input type="date" class = 'form-control' name="date_trajet" />
			<?php echo form_error('date_trajet') ?>
		</div>

		<div class="form-group">
			<label for="heure_trajet" >Heure :</label>
			<input type="time" class = 'form-control' name="heure_trajet" />
			<?php echo form_error('heure_trajet') ?>
		</div>

		<div class="form-group">
				<button type="submit" class="btn btn-default">Poster ce trajet</button>
		</div>

		<?php form_close(); ?> 

	<h3>Récapitulatifs de mes propositions de  trajets</h3>	
		<?php
 		if(empty($results))
 		{
 			echo "Vous n'avez pas encore de trajet proposé " ; 
 			// echo anchor('Espace_perso/propose_trajet','Proposez un nouveau trajet !');
 		}
		else
		{
			foreach($results as $data) 
			{
				$date = strtotime($data->date_trajet);
    			$dat = date('d/m/y', $date);
    			$heure = strtotime($data->heure_trajet);
    			$tme 	= date('H', $heure);
    	
    			
 				echo "-> De ".ucfirst($data->ville_depart) . " à " . ucfirst($data->ville_arrivee)  . " le ".$dat." à ".$tme." h"."<br>";
 			}
		}
 		
 		?>
 		<p><?php echo $links; ?></p>

</div>

</html>