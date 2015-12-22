<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<div class="container">
	
	<h1>Proposition de trajets </h1>
	<!-- FORMULAIRE de proposition d'un trajet -->
	<h3>Proposer un nouveau trajet </h3>

		<?php echo form_open('Espace_perso/propose_trajet',['class'=>'form-inline']);?>

		<div class="form-group">
			<label for="ville_depart" ></label>
			<input type="text" class = 'form-control' name="ville_depart" id="ville" placeholder="Vile de départ" />
			<?php echo form_error('ville_depart') ?>
		</div>

		<div class="form-group">
			<label for="ville_arrivee"></label>
			<input type="text" class = 'form-control' name="ville_arrivee" placeholder="Vile d'arrivée"/>
			<?php echo form_error('ville_arrivee') ?>
		</div>

		<div class="form-group">
			<label for="date_trajet" ></label>
			<input type="date" class = 'form-control' name="date_trajet" />
			<?php echo form_error('date_trajet') ?>
		</div>

		<div class="form-group">
			<label for="heure_trajet" ></label>
			<input type="time" class = 'form-control' name="heure_trajet"/>
			<?php echo form_error('heure_trajet') ?>
		</div>

		<div class="form-group">
			<label for="message"></label>
			<!-- <textarea name="demande" rows="5"><?php echo set_value('demande'); ?></textarea> -->
			<input type="text" class = 'form-control' name="message" placeholder ="Votre message"/>
			<?php echo form_error('message') ?>
		</div>


		<div class="form-group">
				<button type="submit" class="btn btn-default">Poster ce trajet</button>
		</div>

		<?php form_close(); ?> 


	<!--AFFICHAGE des trajets proposés -->	
	<h3>Mes propositions</h3>	
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
    			$tme_h 	= date('H', $heure);   // si h (et non H) -> 12h  (et non plus 24h)
    			$tme_m 	= date('i', $heure);
    			
 				echo "Id ".$data->id." --> ".ucfirst($data->ville_depart) . " >> " . ucfirst($data->ville_arrivee)  . " le ".$dat." à ".$tme_h."h".$tme_m." ";
 				echo anchor("Espace_perso/supprime_trajet/".$data->id,str_repeat("&nbsp;", 10)."Supprimer ce trajet ?"."<br>");
 			}
		}
 		
 		?>
 		<p><?php echo $links; ?></p>

</div>

</html>