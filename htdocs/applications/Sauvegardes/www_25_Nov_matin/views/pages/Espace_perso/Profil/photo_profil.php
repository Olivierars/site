<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<div class="container">

	<ul class="nav nav-pills">
	  	<li role="presentation" ><a href="<?php echo site_url('Espace_perso/Profil/mon_profil') ?>">Mon profil</a></li>
	  	<li role="presentation" class="active"><a href="<?php echo site_url('Espace_perso/Profil/photo_profil') ?>">Photo de profil</a></li>
	</ul>
	<br>
	<legend> Quoi de mieux qu'une photo pour agrémenter son profil ! </legend>
	
	<?php 
	$filename = "../assets/images/photos_profil/photo_profil_".$id.".jpg" ;
	if (file_exists($filename))
	{ ?>
		
		<img 	src=<?php echo "/assets/images/photos_profil/photo_profil_".$id.".jpg";?> width="120"  alt="photo de profil" />
		<img  src=<?php echo "/assets/images/photos_profil/photo_profil_".$id.".jpg";?> class="profile-image img-circle" width ="120" alt="photo de profil"> 
		<br> <br>

	<?php  
	}
	?>

	<?php echo $error;?>

	<?php echo form_open_multipart('Espace_perso/Profil/do_upload');?>

	<input type="file" name="userfile" size="20" />

	<br>

	<input type="submit" value="Enregistrer une  nouvelle photo de profil" />

	</form>


</div>