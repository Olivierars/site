<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<div class="container">

	<ul class="nav nav-pills">
		<li role="presentation"><a href="<?php echo site_url('Espace_perso/Messagerie/messages_en_cours') ?>">Messages en cours </a></li>		
 	</ul>
 	<br>
		
	<div class="row" id="texte_centre">
		<div class="col-md-7 col-md-offset-1">
			<?php 
			$date 	= strtotime($data_trajet[0]->date_trajet);
			$date_trajet 	= date('d/m/y',$date);
			$heure_trajet 	= date('H:i',$date);
			echo "<strong><h4 style='display:inline'>"." Conversation avec ".ucfirst($data_interloc[0]->prenom)." ".ucfirst($data_interloc[0]->nom);
			echo " : ".$data_trajet[0]->ville_depart." >> ".$data_trajet[0]->ville_arrivee."</strong></h4><br> ";
			echo "<i>le ".$date_trajet." à ".$heure_trajet."<br><br></i>" ;
			?>
		</div>
	</div>

	<?php 

	// Formulaire de conversation
	echo form_open("Espace_perso/Messagerie/repondre/");?>
	<div class="row" >
		<div class="col-md-7 col-md-offset-1">

			<div class="form-group">
				<label for="message"></label>
				<input type="text" class = 'form-control' name="message" placeholder ="Votre message" />
				<?php echo form_error('message') ;?>
			</div>
		</div>

		<div class="form-group">
			<input type="hidden" name="id_trajet" 		value="<?php echo $data_trajet[0]->id;?>" />
			<input type="hidden" name="id_exped" 	value="<?php echo $data_profil[0]->id;?> " />
			<input type="hidden" name="id_dest" 	value="<?php echo $data_interloc[0]->id ;?>" />
		</div>
	</div>
	<div class="row">
		<div class="col-md-2 col-md-offset-6">
			<div class="form-group">
				<button type="submit" class="btn btn-primary" name="bouton_repondre" value="poster" > Envoyer un message</button>
			</div>
		</div>
	</div>
	<br>
	<?php form_close();
	


	$Nof_messages  = sizeof($liste_id_messages);

	for ($j=0 ; $j<=$Nof_messages-1 ; $j++) // Pour chaque message ....  
	{	
	
		$date_post 	= strtotime($data_message[$j][0]->date_creation);
		$date_message 	= date('d/m/y',$date_post);
		$heure_message 	= date('H:i',$date_post);

		if($data_message[$j][0]->id_exped == $id)
		{?>
			
			<div class="row">
				<div class="col-md-1">
				</div>
				<div class="col-md-7">
					<div class="row">
						<div class="bubble_right"> <?php 
							echo "<i> \"".$data_message[$j][0]->texte."\"</i>" ; ?>
    					</div>
					</div>
					<div class="row" id="date_message"><?php  
						echo $date_message." à ".$heure_message;
						?>
					</div>

				</div>
				<div class="col-md-1">
					<?php 
					$filename = "../assets/images/photos_profil/photo_profil_".$data_message[$j][0]->id_exped.".jpg" ;
					if (file_exists($filename))
					{ ?>
						<img id='message_profil_pict' src=<?php echo "/assets/images/photos_profil/photo_profil_".$data_message[$j][0]->id_exped.".jpg";?> class="profile-image img-circle" alt="photo de profil"> 
						 
					<?php  
					}
					else
					{ ?>
						<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
					<?php 
					}	
					?>
				</div>	
			</div>

		<?php
		}
		else
		{?>
			<div class="row">
				<div class="col-md-1">
					<?php 
					$filename = "../assets/images/photos_profil/photo_profil_".$data_message[$j][0]->id_exped.".jpg" ;
					if (file_exists($filename))
					{ ?>
						<img id='message_profil_pict' src=<?php echo "/assets/images/photos_profil/photo_profil_".$data_message[$j][0]->id_exped.".jpg";?> class="profile-image img-circle" alt="photo de profil"> 
					<?php  
					}
					else
					{ ?>
						<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
					<?php 
					}	
					?>
				</div>
				<div class="col-md-7">
					<div class="row">
						<div class="bubble_left"> <?php
							echo "<i> \"".$data_message[$j][0]->texte."\"</i>" ;?>
						</div>
					</div>
					<div class="row" id="date_message"><?php  
						echo $date_message." à ".$heure_message;
						?>
					</div>
				</div>	
				<div class="col-md-6">
				</div>
			</div>

			<?php 
		}	
		echo "<br>";
	} 
	?>
</div>
</html>




