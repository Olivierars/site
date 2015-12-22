<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<div class="container">

	<ul class="nav nav-pills">
		<li role="presentation" ><a href="<?php echo site_url('Espace_perso/Messagerie/messages_en_cours') ?>">Messages en cours </a></li>
		<li role="presentation" class="active"><a href="<?php echo site_url('Espace_perso/Messagerie/messages_archives') ?>">Messages archivés</a></li>
	</ul>
	<br>
	
	<?php 
	$compteur =0 ;
	if(!empty($liste_id_interloc))
	{
		$Nof_interloc 			= sizeof($liste_id_interloc);
		// $id_reponse = 0 ;  // curseur pour les formulaire de nouveau message

 		for($i=0 ; $i<=$Nof_interloc-1 ; $i++)  // Pour chaque interloc .... 
 		{
 			$Nof_trajet = sizeof($liste_id_trajet[$i]);

			for ($j = 0 ; $j <= $Nof_trajet -1 ; $j++)  // Pour chaque trajet 
			{	
				//  Vérification de la date du trajet 
				$date 	= strtotime($data_trajet[$i][$j][0]->date_trajet);
				$current_date = time();
				$diff = $date - $current_date ; 
				if($diff<0)  
				{ 			
					$compteur ++ ; 
					?>

				 	<div class="container">
					<div class="panel panel-primary">
						<ul class="list-group">
							<div class="panel-body" id="listing_message">
								<a display:block href="<?php echo site_url('Espace_perso/Messagerie/conversation/'.$data_interloc[$i][0]->id) ?>">
								<!-- PHOTO  -->
								<div class="col-md-1">
									<?php
									$filename = "../assets/images/photos_profil/photo_profil_".$data_interloc[$i][0]->id.".jpg" ;
									if (file_exists($filename))
										{ ?>
									<img id='message_profil_pict' src=<?php echo "/assets/images/photos_profil/photo_profil_".$data_interloc[$i][0]->id.".jpg";?> class="profile-image img-circle" alt="photo de profil"> 
									<br> 
									<?php  
									}
									else
										{ ?>
									<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
									<?php 
									}?>
								</div> 
								<!-- NOM & PRENOM -->
								<div class="col-md-1">
									<?php 
									echo ucfirst($data_interloc[$i][0]->prenom)." ".ucfirst($data_interloc[$i][0]->nom);
									?>
								</div> 

							

								<!-- TRAJET ET HEURE -->
								<div class="col-md-3">
									<?php 
									$date_trajet 	= date('d/m/y',$date);
									$heure_trajet 	= date('H:i',$date);
									echo "<strong>".$data_trajet[$i][$j][0]->ville_depart." >> ".$data_trajet[$i][$j][0]->ville_arrivee."</strong><br> ";
									echo "<i>le ".$date_trajet." à ".$heure_trajet."<br></i>" ; 
									?>
								</div> <?php 

								$Nof_messages  = sizeof($liste_id_messages[$i][$j]);
								?>
								<!-- TEXTE DU DERNIER MESSAGE -->
								<div class="col-md-4"> <?php 

									$date_post 	= strtotime($data_message[$i][$j][0][0]->date_creation);
									$date_message 	= date('d/m/y',$date_post);
									$heure_message 	= date('H:i',$date_post);
									if($data_message[$i][$j][0][0]->id_exped == $id)
									{
										echo ucfirst($data_profil[0]->prenom).", le ".$date_message." à ".$heure_message." : ";
									}
									else
									{
										echo ucfirst($data_interloc[$i][0]->prenom).", le ".$date_message." à ".$heure_message." : ";
									}	
									echo "<i> \"".$data_message[$i][$j][0][0]->texte."\"</i>" ;
									?>
								</div> <?php 
								echo "</a>";
							}?>
						</div>
					</ul>
				</div></div>  <?php 
			}					
		}
	}
	if($compteur == 0)
	{?>
		<div class="container">
			<?php echo "Vous n'avez pas de message concernant des trajets archivés "  ;  ?>
		</div>
		<?php
	}?>				
</div>
</html>