<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">


	<!DOCTYPE html> 
	<html lang="fr">

	<body>
		<!-- Formulaire de connexion  --> 

		<h2> Connectez vous !</h2>
		<?php echo validation_errors(); ?>
		<?php echo form_open('Utilisateur/verif_login'); ?>	
		Pas encore inscrit <a href="<?php echo site_url('Utilisateur/inscription') ?>">C'est par ici !</a>
		<br><br>
		<div>
			<label>
				Email : <?php echo str_repeat("&nbsp;", 16); ?>
				<input type="text" name="email" value="<?php echo set_value('email'); ?>" />
			</label>
			<?php echo form_error('email'); ?>
		</div>
		<br>
		<div>
			<label>
				Mot de passe :  <?php echo str_repeat("&nbsp;", 2); ?>
				<input type="password" name="mdp" />
			</label>
			<?php echo form_error('mdp'); ?>
		</div>
		<br>
		<div>
			<label>
				<input type="checkbox" name="remind_login" value="<?php echo set_value('remind_login'); ?>" /> se souvenir de moi !!!! NE MARCHE PAS POUR LE MOMENT !!!!
			</label>
			<?php echo form_error('remind_login'); ?>
		</div>
		<br>
		<p>
			<input type="submit" value="Connexion" />
			<a href="<?php echo site_url('Utilisateur/mdp_perdu') ?>"> <?php echo str_repeat("&nbsp;", 2);?> Mot de passe égaré ?</a>
		</p>
		<br>


	</form>
</body>
</html>
</div>




