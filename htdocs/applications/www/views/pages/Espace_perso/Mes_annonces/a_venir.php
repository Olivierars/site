<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<div class="container">

	<ul class="nav nav-pills">
	  	<li role="presentation"><a href="<?php echo site_url('Espace_perso/Mes_annonces/propose_trajet') ?>">Solliciter un accompagnement</a></li>
	  	<li role="presentation" class="active"><a href="<?php echo site_url('Espace_perso/Mes_annonces/a_venir') ?>">Mes demandes en cours</a></li>
	  	<li role="presentation"><a href="<?php echo site_url('Espace_perso/Mes_annonces/archives') ?>">Mes demandes archivées</a></li>
	</ul>
	<br> 
	<?php  
	$compteur = 0 ;
	$indice = 0 ; 
	foreach($results as $data) 
	{  
		$indice++ ;
		$date 	= strtotime($data->date_trajet);
		$current_date = time();
		$diff = $date - $current_date ; 
		
		if($diff>=0)
		{
			$compteur ++ ; 
			$date_trajet 	= date('d/m/y',$date);
			$heure_trajet 	= date('H:i',$date);
			?>
			<div class="panel panel-primary">
				<ul class="list-group">
					<div class="panel-body" id="listing_message">
						<?php
	 					echo "Trajet <strong>".ucfirst($data->ville_depart) . " >> " . ucfirst($data->ville_arrivee)  . "</strong> le ".$date_trajet." à ".$heure_trajet." ";
	 					echo str_repeat("&nbsp;", 10);
	 					?>
	 					<!-- Détail traejt -->
			            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="<?php echo '#myModal'.$indice ; ?>">
			               <?php echo $data->Nof_candidats." candidat(s)" ; ?>
			            </button>
			            <div class="modal fade" id="<?php echo 'myModal'.$indice ; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			           		<div class="modal-dialog" role="document">
			                  	<div class="modal-content">
			                    	<div class="modal-header">
			                      		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			                      		<h4 class="modal-title" id="myModalLabel">Candidats</h4>
			                    	</div>
				                    <div class="modal-body">
				                      	<?php

				                      	for($i = 0 ; $i < $data->Nof_candidats ; $i ++)
				                      	{
											$filename = "../assets/images/photos_profil/photo_profil_".$data_profil_public[$i][0]->id.".png" ;
											if (file_exists($filename))
											{ ?>
												<img  src=<?php echo "/assets/images/photos_profil/photo_profil_".$data_profil_public[$i][0]->id.".png";?> class="profile-image img-circle" width ="80" alt="photo de profil"> 
											<?php  
											}
											$filename = "../assets/images/photos_profil/photo_profil_".$data_profil_public[$i][0]->id.".jpg" ;
											if (file_exists($filename))
											{ ?>
												<img  src=<?php echo "/assets/images/photos_profil/photo_profil_".$data_profil_public[$i][0]->id.".jpg";?> class="profile-image img-circle" width ="80" alt="photo de profil"> 
											<?php  
											}
											?>
											<br>
											Prénom : <?php echo $data_profil_public[$i][0]->prenom ; ?> <br>
											Nom : <?php echo $data_profil_public[$i][0]->nom ;?><br>
											Age : <?php  echo $data_profil_public[$i][0]->age;?><br>
											Hobbies : <?php $hobbies = json_decode($data_profil_public[$i][0]->hobbies); ?>

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
											echo "<br><br>";
				                      	}
	 	
				                      	?>
				                    </div>
			                  	</div>
			           	    </div>
			            </div>
			            <?php
	 					 
	 					echo str_repeat("&nbsp;", 10);
	 					?>

	 					<!-- Détail traejt -->
			            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="<?php echo '#myModal'.$indice ; ?>">
			               Voir détail trajet
			            </button>
			            <div class="modal fade" id="<?php echo 'myModal'.$indice ; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			           		<div class="modal-dialog" role="document">
			                  	<div class="modal-content">
			                    	<div class="modal-header">
			                      		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			                      		<h4 class="modal-title" id="myModalLabel">Détail du trajet</h4>
			                    	</div>
				                    <div class="modal-body">
				                      	<?php
				                      	$ville_depart   = $data->ville_depart;
				                      	$ville_arrivee  = $data->ville_arrivee ;
				                      	// $date_trajet  = $trajet[0]->date_trajet ;
				                      	$message    = $data->data_trajet[0]->message;
				                      	$nom_posteur  = $data_profil[0]->nom ;
				                      	$prenom_posteur = $data_profil[0]->prenom ;
				                      	
				                      
				                      	echo "Trajet proposé par ".ucfirst($prenom_posteur)." ".ucfirst($nom_posteur)."<br>"; 
				                      	echo "De ".ucfirst($ville_depart) . " >> " . ucfirst($ville_arrivee)."<br>" ;
				                      	echo "Le ".$date_trajet . " à ".$heure_trajet."<br><br>";
				                      	echo "Message : ".$message."<br><br>"; 
				                      	?>
				                    </div>
			                  	</div>
			           	    </div>
			            </div>

	 					<?php 
	 					echo str_repeat("&nbsp;", 10);
	 					echo anchor("Espace_perso/Mes_annonces/supprime_trajet/".$data->id,"Supprimer ce trajet ?");
			    		?>
	    			</div>
    			</ul> 
			</div>
		<?php 
    	}
	}
	if($compteur == 0)
	{
		echo "Vous n'avez pas encore proposé de trajet, "  ; ?>
		<a href="<?php echo site_url('Espace_perso/Mes_annonces/propose_trajet') ?>">n'hésitez pas à solliciter un accompagnement</a> <?php 
	}
 	?>
</div>
</html>