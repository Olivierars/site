<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<div class="container">

	<ul class="nav nav-pills">
	  	<li role="presentation" class="active"><a href="<?php echo site_url('Espace_perso/Mes_annonces/propose_trajet') ?>">Solliciter un accompagnement</a></li>
	 	<li role="presentation"><a href="<?php echo site_url('Espace_perso/Mes_annonces/a_venir') ?>">Mes demandes en cours</a></li>
		<li role="presentation"><a href="<?php echo site_url('Espace_perso/Mes_annonces/archives') ?>">Mes demandes archivées</a></li>
	</ul>
	<br><br>
		<section>

		<?php echo form_open('Espace_perso/Mes_annonces/propose_trajet');?>

		<h3 id="titre_form"> Demandez d'être accompagné lors de votre prochain trajet !	</h3>

		<div class="form-group">
			<div class="row">
				<div class="col-md-1 col-md-offset-1">
					<label for="ville_depart" >De </label>
				</div>
				<div class="col-md-9">
					<input type="text" class = 'form-control' name="ville_depart" id="ville" placeholder="Vile de départ" />
					<?php echo form_error('ville_depart') ?>
				</div>
			</div>
		</div>

		<div class="form-group">
			<div class="row">
				<div class="col-md-1 col-md-offset-1">
					<label for="ville_arrivee"> Vers </label>
				</div>
				<div class="col-md-9">
					<input type="text" class = 'form-control' name="ville_arrivee" placeholder="Vile d'arrivée"/>
					<?php echo form_error('ville_arrivee') ?>
				</div>
			</div>
		</div>

		<div class="form-group">
			<div class="row">
				<div class="col-md-1 col-md-offset-1">
					<label for="date_trajet" >Date </label>
				</div>
				<div class="col-md-9">
					<input type="date" class = 'form-control' name="date_trajet" placeholder = "jj/mm/aaaa" />
					<?php echo form_error('date_trajet') ?>
				</div>
			</div>
		</div>

		<div class="form-group">
			<div class="row">
				<div class="col-md-1 col-md-offset-1">
					<label for="heure_trajet" > Heure </label>
				</div>
				<div class="col-md-9">
					<input type="datetime" class = 'form-control' name="heure_trajet" placeholder = "hh:mm"/>
					<?php echo form_error('heure_trajet') ?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-md-10 col-md-offset-1">
					<input type="text" class = 'form-control' name="message" placeholder ="Laisser un message pour votre futur accompagnateur" />
					<?php echo form_error('message') ?>
				</div>
			</div>
		</div>

		<div class="form-group">
				<div class="col-md-offset-4">
				<button type="submit" class="btn btn-success">Solliciter un accompagnement</button>
		</div>

		<?php form_close(); ?> 
				</section>


</div>

</html>