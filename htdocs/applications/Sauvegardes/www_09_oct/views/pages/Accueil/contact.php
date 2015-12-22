<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<div class="container">
	<h2>
		Comment nous contacter ? 
	</h2><br>
	
	Vous pouvez nous contacter par mail à l'adresse xxxxxxx@xxx.com (mettre un lien direct à leur boite mail) <br><br>
	ou via le formulaire suivant <br><br>


	<?php echo form_open('Accueil/contact',['class'=>'form-horizontal']);?>

	<div class="form-group">
		<label for="nom" class="col-sm-2 control-label">Nom :</label>
		<div class="col-sm-10">
			<input type="text" name="nom" value="<?php echo set_value('nom') ;?>"/>
		</div>
		<?php echo form_error('nom') ?>
	</div>


	<div class="form-group">
		<label for="email" class="col-sm-2 control-label">Votre Email :</label>
		<div class="col-sm-10">
			<input type="text" name="email" value="<?php echo set_value('email') ;?>"/>
		</div>
		<?php echo form_error('email') ?>
	</div>

	<div class="form-group">
		<label for="demande" class="col-sm-2 control-label">Votre demande :</label>
		<div class="col-sm-10">
			<textarea name="demande"><?php echo set_value('demande'); ?></textarea>
		</div>
		<?php echo form_error('demande') ?>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">Envoyer ma demande</button>
		</div>
	</div>

	<?php form_close(); ?> 

	Nous sommes ici : Association XXXXX, 135 rue d'Alesia, 75014 Paris <br> <br>

</div>
</html>