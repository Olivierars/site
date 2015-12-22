<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html> 
<div class="container">

	<!-- Formulaire de connexion  --> 
	<section>
	
	<?php echo form_open('Utilisateur/verif_login'); ?>	
	<h3 id="titre_form"> Connectez vous !</h3>

	<p id='form_sub_title'>
	Pas encore membre ? <a href="<?php echo site_url('Utilisateur/inscription') ?>">INSCRIVEZ VOUS !</a>
	</p>

	<div class="form-group">
		<label for="email"> Adresse email </label>
		<input type="text" class="form-control" name="email" value="<?php echo set_value('email'); ?>" />
		<?php echo form_error('email'); ?>
	</div>

	<div class="form-group">
		<label for="mdp"> Mot de passe </label>
		<input type="password" class="form-control" name="mdp" value="<?php echo set_value('mdp'); ?>" />
		<?php echo form_error('mdp'); ?>
	</div>

	<!-- <div class="form-group">
		<input type="checkbox" name="remind_login" value="<?php echo set_value('remind_login'); ?>" /> se souvenir de moi !!!! NE MARCHE PAS POUR LE MOMENT !!!!
		<?php echo form_error('remind_login'); ?>
	</div> -->
	
	<div class="form-group" id="valid_form_button">
		<button  type="submit" class="btn btn-primary">Connexion</button>  <?php echo str_repeat("&nbsp;", 2);?>
		<a href="<?php echo site_url('Utilisateur/mdp_perdu') ?>"> Mot de passe égaré ?</a>
	</div>


	</form>
	</section>

</body>
</html>
</div>




