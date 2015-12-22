<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container">


<!DOCTYPE html> 
<html lang="fr">
	
	<body>
		
		<!-- Formulaire d'inscription  --> 

		<form method="post" action="">
			<h2> Le formulaire d'inscription qui va bien !</h2>

			Vous êtes déjà inscrit ? <a href="<?php echo site_url('Utilisateur/connexion') ?>">Connectez vous !</a>
			<br><br>
			<div>
				<label>Civilité : <?php echo str_repeat("&nbsp;", 24); ?></label>
				<select name="civilite">
				  <option value="Mlle">Mlle</option>
				  <option value="Mme" >Mme</option>
				  <option value="M">M.</option>
				</select>
			</div>
			<div>
				<label>
					Prénom : <?php echo str_repeat("&nbsp;", 24); ?>
					<input type="text" name="prenom" value="<?php echo set_value('prenom'); ?>" />
				</label>
				<?php echo form_error('prenom'); ?>
			</div>
			<br>
			<div>
				<label>
					Nom : <?php echo str_repeat("&nbsp;", 19); ?>
					<input type="text" name="nom" value="<?php echo set_value('nom'); ?>" />
				</label>
				<?php echo form_error('nom'); ?>
			</div>
			<br>
			<div>
				<label>
					Email : <?php echo str_repeat("&nbsp;", 23); ?>
					<input type="text" name="email" value="<?php echo set_value('email'); ?>" />
				</label>
				<?php echo form_error('email'); ?>
			</div>
			<br>
			<div>
				<label>
					Mdp : <?php echo str_repeat("&nbsp;", 25); ?>
					<input type="password" name="mdp" value="<?php echo set_value('mdp'); ?>" />
				</label>
				<?php echo form_error('mdp'); ?>
			</div>
			<br>
			<div>
				<label>
					Mdp confirmation : <?php echo str_repeat("&nbsp;", 2); ?>
					<input type="password" name="mdp2" value="<?php echo set_value('mdp2'); ?>" />
				</label>
				<?php echo form_error('mdp2'); ?>
			</div>
			<br>
			<div>
				<label>
					Role : <?php echo str_repeat("&nbsp;", 2); ?>
					<input type="checkbox" name="role" 	value="accompagnateur"> &nbsp; Accompagnateur
					<?php echo str_repeat("&nbsp;", 2); ?>
					<input type="checkbox" name="role" 	value="accompagné" >  &nbsp;  Accompagné 
					<br/>
				</label>
				<?php echo form_error('role'); ?>
			</div>
			<br>
			<p>
				<input type="submit" value="Valider votre inscription" />
			</p>
		</form>
	</body>
</html>

</div>
