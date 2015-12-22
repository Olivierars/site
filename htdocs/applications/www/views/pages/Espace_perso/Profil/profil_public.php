<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<div class="container">

	<?php  
	if($data_profil[0]->id == $data_profil_public[0]->id)
	{?>
		<ul class="nav nav-pills">
	  		<li role="presentation" ><a href="<?php echo site_url('Espace_perso/Profil/mon_profil') ?>">Modifier mon profil</a></li>
	  		<li role="presentation" class="active"><a href="<?php echo site_url('Espace_perso/Profil/profil_public/'.$data_profil_public[0]->id) ?>">Profil public</a></li>
		</ul>
	<?php 
	}
	?>
	
	<br>
<legend>Profil public </legend>
	<?php 
	$filename = "../assets/images/photos_profil/photo_profil_".$data_profil_public[0]->id.".png" ;
	if (file_exists($filename))
	{ ?>
		<img  src=<?php echo "/assets/images/photos_profil/photo_profil_".$data_profil_public[0]->id.".png";?> class="profile-image img-circle" width ="80" alt="photo de profil"> 
	<?php  
	}
	$filename = "../assets/images/photos_profil/photo_profil_".$data_profil_public[0]->id.".jpg" ;
	if (file_exists($filename))
	{ ?>
		<img  src=<?php echo "/assets/images/photos_profil/photo_profil_".$data_profil_public[0]->id.".jpg";?> class="profile-image img-circle" width ="80" alt="photo de profil"> 
	<?php  
	}
	?>
	<br>
	Prénom : <?php echo $data_profil_public[0]->prenom ; ?> <br>
	Nom : <?php echo $data_profil_public[0]->nom ;?><br>
	Age : <?php  echo $data_profil_public[0]->age;?><br>
	Hobbies : <?php $hobbies = json_decode($data_profil_public[0]->hobbies); ?>

	<?php 
	if(!is_null($hobbies))
	{
		if(isset($hobbies->lecture)){	if($hobbies->lecture){ ?>  	<i class="fa fa-book fa-2x" titre="lecture"></i> <?php }}
		if(isset($hobbies->sport)){		if($hobbies->sport){ ?>  	<i class="fa fa-futbol-o fa-2x" titre="sport"></i> <?php }}
		if(isset($hobbies->musique)){	if($hobbies->musique){ ?>  	<i class="fa fa-music fa-2x" titre="musique"></i> <?php }}
		if(isset($hobbies->cinema)){	if($hobbies->cinema){ ?>  	<i class="fa fa-film fa-2x" titre="cinema"></i> <?php }}
		if(isset($hobbies->voyage)){	if($hobbies->voyage){ ?>  	<i class="fa fa-plane fa-2x" titre="voyage"></i> <?php }}
		if(isset($hobbies->sorties)){	if($hobbies->sorties){ ?>  	<i class="fa fa-beer fa-2x" titre="sorties"></i> <?php }}
		if(isset($hobbies->photo)){		if($hobbies->photo){ ?>  	<i class="fa fa-camera-retro fa-2x" titre="photo"></i> <?php }}

	}
	?> 

			




</div>
</html>