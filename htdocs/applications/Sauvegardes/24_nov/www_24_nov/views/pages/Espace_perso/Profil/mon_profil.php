<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<div class="container">

	<ul class="nav nav-pills">
	  	<li role="presentation" class="active"><a href="<?php echo site_url('Espace_perso/Profil/mon_profil') ?>">Mon profil</a></li>
	  	<li role="presentation"><a href="<?php echo site_url('Espace_perso/Profil/photo_profil') ?>">Photo de profil</a></li>
	</ul>
	<br>
	<legend> Un profil détaillé met de suite en confiance, n'hésitez pas à le compléter ! </legend>
	<?php echo validation_errors(); ?>
	<?php echo form_open('Espace_perso/Profil/modif_profil',['class'=>'form-horizontal']);?>

	  <div class="form-group">
	    <label for="prenom" class="col-sm-2 control-label">Prénom</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" name="prenom" id="prenom" value="<?php echo $data_profil[0]->prenom ; ?>">
	    </div>
	  </div>

	  <div class="form-group">
	    <label for="nom" class="col-sm-2 control-label">Nom</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" name ="nom" id="nom" value="<?php echo $data_profil[0]->nom ; ?>">
	    </div>
	  </div>

	  <div class="form-group">
	    <label for="profession" class="col-sm-2 control-label">Age</label>
	    <div class="col-sm-10">
	    	<input type="number" name="age" id="age" min="1" max="99" value="<?php echo $data_profil[0]->age ; ?>"> ans
	    </div>
	  </div>


	  <div class="form-group">
	    <label for="inputPassword3" class="col-sm-2 control-label">Email</label>
	    <div class="col-sm-10">
	      <input type="email" class="form-control" name="email" id="email" value="<?php echo $data_profil[0]->email ; ?>">
	    </div>
	  </div>

	  <div class="form-group">
	    <label for="role" class="col-sm-2 control-label">Statut</label>
	    <div class="col-sm-10">
	    	<input type="radio" name="role" value="accompagnateur" id="role" <?php if(strcmp($data_profil[0]->role,"accompagnateur")==0){?> checked <?php } ?> > Accompagnateur&nbsp;&nbsp;
	    	<input type="radio" name="role" value="accompagne" id="role" <?php if(strcmp($data_profil[0]->role,"accompagne")==0){?> checked <?php } ?> > Accompagné
	    </div>
	  </div>

	  <div class="form-group">
	    <label for="profession" class="col-sm-2 control-label">Profession</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" name ="profession" id="profession" value="<?php echo $data_profil[0]->profession ; ?>">
	    </div>
	  </div>

	  

	  <?php 
	  if(strcmp($data_profil[0]->role,"accompagne")==0)
 	{
 		?>
 		<div class="checkbox">
			<label for="handicap" class="col-sm-2 control-label"> <strong>  Type de handicap </strong>  </label>
			<div class="col-sm-10">
				<?php $type_handi = json_decode($data_profil[0]->type_handi); ?>
				<br>
  				<input type="checkbox" id="handicap" name="type_handi[moteur]" value="true" class="col-sm-2 control-label" <?php if(isset($type_handi->moteur)){if($type_handi->moteur){?> checked <?php }} ?>> Moteur <br>
  				<input type="checkbox" id="handicap" name="type_handi[mental]" value="true" class="col-sm-2 control-label" <?php if(isset($type_handi->mental)){if($type_handi->mental){?> checked <?php }} ?>> Mental <br>
  				<input type="checkbox" id="handicap" name="type_handi[visuel]" value="true" class="col-sm-2 control-label" <?php if(isset($type_handi->visuel)){if($type_handi->visuel){?> checked <?php }} ?>> Visuel <br>
  				<input type="checkbox" id="handicap" name="type_handi[auditif]" value="true" class="col-sm-2 control-label" <?php if(isset($type_handi->auditif)){if($type_handi->auditif){?> checked <?php }} ?>> Auditif <br>
  			</div>
			
  		</div>
  		<br><br> <br> <br>

 	 	<?php 
 	}
 	 ?>  
 	
 	<div class="form-group">
	    <label for="texte_pres" class="col-sm-2 control-label">Présentation</label>
	    <div class="col-sm-10">
		    <input type="text" class="form-control" name="texte_pres" id="texte_pres" value="<?php 
		    	if(empty($data_profil[0]->texte_pres))
		      	{
		      		echo "Présentez vous en quelques mots !";
		      	}
		      	else
		      	{
		      		echo $data_profil[0]->texte_pres ;
		      	}	
		    ?>">
	    </div>
	 </div>

	
	   
	 <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
	      <button type="submit" class="btn btn-default">Enregistrer les modifications </button>
	    </div>
	 </div>
	</form>


</div>