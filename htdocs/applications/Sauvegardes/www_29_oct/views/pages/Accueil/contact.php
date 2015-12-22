<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<div class="container">
	<legend>N'hésitez pas à nous contacter</legend>
	<div class="row" >
	</div>

	<div class="row" >
		<div class="col-xs-12 col-sm-9 col-md-9 col-lg-6 col-lg-offset-1"> 
			
			<?php echo form_open('Accueil/contact',['class'=>'form-horizontal']);?>

			<div class="form-group">
				<label class="col-lg-3 control-label" for="prenom">Prénom : </label>
				<div class="col-lg-9">
					<input type="text" name="prenom" value="<?php echo set_value('prenom') ;?>"/>
				</div>
				<?php echo form_error('prenom') ?>
			</div>

			<div class="form-group">
				<label class="col-lg-3 control-label"  for="email" >Votre Email : </label>
				<div class="col-lg-9">
					<input type="text" name="email" value="<?php echo set_value('email') ;?>"/>
				</div>
				<?php echo form_error('email') ?>
			</div>

			<div class="form-group">
				<label class="col-lg-3 control-label" for="sujet">Sujet : </label>
				<div class="col-lg-9">
					<input type="text" name="sujet" value="<?php echo set_value('sujet') ;?>"/>
				</div>
				<?php echo form_error('sujet') ?>
			</div>

			<div class="form-group">
				<label class="col-lg-3 control-label" for="message" >Message : </label>
				<div class="col-lg-9">
					<textarea name="message" rows="5"><?php echo set_value('message'); ?></textarea>
				</div>
				<?php echo form_error('message') ?>
			</div>
			<br>
			<div class="form-group">
				<label class="col-lg-3 control-label"></label>
				<div class="col-lg-9 controls">
					<button type="submit" class="btn btn-default">Envoyer ma demande</button>
				</div>
			</div>

			<?php form_close(); ?> 

		</div>
		<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 col-lg-offset-1"> 
			<address>
  				<strong>Association  XXXX </strong><br>
				135 rue d'Alesia,<br>
			  	75014 Paris<br>
			</address>

			<address>    
			  <strong> <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
			  	Anne KEISSER</strong><br>
			  <span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span>
			  	06 81 22 11 81
			  <a href="mailto:#">anne.keisser@gmail.com</a>
			  <br><br> et <br>	<br> 
			  <strong> <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
			  	Olivier ARSAC</strong><br>
			  <span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span>
			  	06 89 98 94 44
			  <a href="mailto:#">olivier.arsacb@gmail.com</a>

			</address> 

		</div>
	</div>

	


	


</div>
</html>