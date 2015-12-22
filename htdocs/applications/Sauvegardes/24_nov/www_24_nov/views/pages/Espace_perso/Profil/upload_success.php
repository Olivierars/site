<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<div class="container">

	<ul class="nav nav-pills">
	  	<li role="presentation" ><a href="<?php echo site_url('Espace_perso/Profil/mon_profil') ?>">Mon profil</a></li>
	  	<li role="presentation" class="active"><a href="<?php echo site_url('Espace_perso/Profil/photo_profil') ?>">Photo de profil</a></li>
	</ul>
	<br>
	<!-- <legend> Quoi de mieux qu'une photo pour agrémenter son profil ! </legend> -->
	<h4> Votre nouvelle photo de profil a bien été enregistrée ! </h4>
	<p>  Vous allez être redirigé vers votre profil dans un  instant</p>
	
	<script type="text/javascript"> 
		<!-- 
		var obj = 'window.location.replace("/www/Espace_perso/Profil/photo_profil");'; 
		setTimeout(obj,3000); 
		// --> 
	</script>

</div>