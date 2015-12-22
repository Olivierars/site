<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html> 
<div class="container">

	<!-- Formulaire d'inscription  --> 
	<section>
	<?php echo form_open('Utilisateur/inscription');?>

	<form method="post" action="">

		<h3 id="titre_form"> Pas encore membre ? Inscrivez-vous gratuitement ! </h3>

		<p id='form_sub_title'>
		Déjà membre ? <a href="<?php echo site_url('Utilisateur/connexion') ?>">CONNECTEZ VOUS !</a>
		</p>

		<div class="form-group">
			<label for="civilite">Civilité </label>
			<select name="civilite" class="form-control">
				<option value="Mlle">Mlle</option>
				<option value="Mme" >Mme</option>
				<option value="M">M</option>
			</select>

		</div>

		<div class="form-group">
			<label for="prenom">Prénom </label>
			<input type="text" class="form-control" name="prenom" value="<?php echo set_value('prenom'); ?>" />
			<?php echo form_error('prenom'); ?>
		</div>
		
		<div class="form-group">
			<label>Nom </label>
			<input type="text" class="form-control" name="nom" value="<?php echo set_value('nom'); ?>" />
			<?php echo form_error('nom'); ?>
		</div>
		
		<div class="form-group">
			<label>Adresse email </label>
			<input type="text" class="form-control" name="email" value="<?php echo set_value('email'); ?>" />
			<?php echo form_error('email'); ?>
		</div>
					
		<div class="form-group">
			<label>Mot de passe </label>
			<input type="password" class="form-control" name="mdp" value="<?php echo set_value('mdp'); ?>" />
			<?php echo form_error('mdp'); ?>
		</div>
		
		<div class="form-group">
			<label>Confirmation mot de passe </label>
			<input type="password" class="form-control" name="mdp2" value="<?php echo set_value('mdp2'); ?>" />
			<?php echo form_error('mdp2'); ?>
		</div>
		

		<div class="form-group">
			<label>Rôle </label>&nbsp;
			<input type="checkbox" name="role" value="accompagnateur"> &nbsp; Accompagnateur &nbsp;
			<input type="checkbox" name="role" value="accompagne" >  &nbsp;  Accompagné 
			<?php echo form_error('role'); ?>
		</div>

		<div class="form-group" id="valid_form_button">
			<button  type="submit" class="btn btn-primary">Valider votre inscription</button>
		</div>
	</form>
	</section>

</body>
</html>

</div>
