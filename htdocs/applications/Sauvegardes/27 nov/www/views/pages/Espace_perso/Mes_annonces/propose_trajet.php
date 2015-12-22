<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<div class="container">

	<ul class="nav nav-pills">
	  	<li role="presentation" class="active"><a href="<?php echo site_url('Espace_perso/Mes_annonces/propose_trajet') ?>">Solliciter un accompagnement</a></li>
	 	<li role="presentation"><a href="<?php echo site_url('Espace_perso/Mes_annonces/a_venir') ?>">Mes demandes en cours</a></li>
		<li role="presentation"><a href="<?php echo site_url('Espace_perso/Mes_annonces/archives') ?>">Mes demandes archivées</a></li>
	</ul>
	
	
	<h3>Solliciter un accompagnement</h3>

		<?php echo form_open('Espace_perso/Mes_annonces/propose_trajet',['class'=>'form-inline']);?>

		<div class="form-group">
			<label for="ville_depart" >De </label>
			<input type="text" class = 'form-control' name="ville_depart" id="ville" placeholder="Vile de départ" />
			<?php echo form_error('ville_depart') ?>
		</div>

		<div class="form-group">
			<label for="ville_arrivee"> vers </label>
			<input type="text" class = 'form-control' name="ville_arrivee" placeholder="Vile d'arrivée"/>
			<?php echo form_error('ville_arrivee') ?>
		</div>
		<br><br>
		<div class="form-group">
			<label for="date_trajet" >Le </label>
			<input type="date" class = 'form-control' name="date_trajet" placeholder = "jj/mm/aaaa" />
			<?php echo form_error('date_trajet') ?>
		</div>

		<div class="form-group">
			<label for="heure_trajet" > à </label>
			<input type="datetime" class = 'form-control' name="heure_trajet" placeholder = "hh:mm"/>
			<?php echo form_error('heure_trajet') ?>
		</div>
		<br><br>
		<div class="form-group">
			<label for="message"></label>
			<!-- <textarea name="demande" rows="5"><?php echo set_value('demande'); ?></textarea> -->
			<input type="text" class = 'form-control' name="message" placeholder ="Votre message" />
			<?php echo form_error('message') ?>
		</div>

		<br><br>
		<div class="form-group">
				<button type="submit" class="btn btn-default">Proposer ce trajet</button>
		</div>

		<?php form_close(); ?> 

</div>

</html>