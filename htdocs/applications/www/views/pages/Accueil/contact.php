<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<div class="container">
	
	<div class="row" >
		<div class="col-xs-12 col-sm-9 col-md-9 col-lg-6 col-lg-offset-1"> 
			<section>
				<?php echo form_open('Accueil/contact');?>
				<h3 id="titre_form"> Nous vous répondons dans les meilleurs délais !</h3>

				<div class="form-group">
					<label  for="prenom">Prénom</label>
					<input type="text" class="form-control" name="prenom" value="<?php echo set_value('prenom') ;?>"/>
					<?php echo form_error('prenom') ?>
				</div>

				<div class="form-group">
					<label for="email" >Votre Email </label>
					<input type="text" class="form-control" name="email" value="<?php echo set_value('email') ;?>" />
					<?php echo form_error('email') ?>
				</div>

				<div class="form-group">
					<label for="sujet">Sujet</label>
					<input type="text" class="form-control" name="sujet" value="<?php echo set_value('sujet') ;?>"/>
					<?php echo form_error('sujet') ?>
				</div>

				<div class="form-group">
					<label for="message" >Message </label>
					<textarea name="message" class="form-control" rows="5"><?php echo set_value('message'); ?></textarea>
					<?php echo form_error('message') ?>
				</div>

				<div class="form-group" id="valid_form_button">
					<button type="submit" class="btn btn-primary">Envoyer ma demande</button>
				</div>

				<?php form_close(); ?> 
				
			</section>


		</div>
		<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 col-lg-offset-1"> 
			<aside>
				<address>
	  				<h4><strong>Association  XXXX </strong></h4>
					135 rue d'Alesia,<br>
				  	75014 Paris<br>
				</address>
				
				<address>    
				<div id="anne">
				  <strong> <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
				  	Anne KEISSER</strong><br>
				  <span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span>
				  	06 81 22 11 81
				  <a href="mailto:#">anne.keisser@gmail.com</a>
				  </div>
				  <br>	<br> 
				  <div id="olivier">
				  <strong> <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span>
				  	Olivier ARSAC</strong><br>
				  <span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span>
				  	06 89 98 94 44
				  <a href="mailto:#">olivier.arsacb@gmail.com</a>
				  </div>
				</address> 
			</aside>


		</div>
	</div>
</div>
</html>