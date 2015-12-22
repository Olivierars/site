<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<div class="container">

	<ul class="nav nav-pills">
		<li role="presentation"><a href="<?php echo site_url('Espace_perso/Messagerie/messages_en_cours') ?>">Messages en cours </a></li>
		<li role="presentation"><a href="<?php echo site_url('Espace_perso/Messagerie/messages_archives') ?>">Messages archivés</a></li>
	</ul>
	<?php
	// print_r($data_interloc); 
	echo "<br><strong><h4>"."Conversation avec ".ucfirst($data_interloc[0]->prenom)." ".ucfirst($data_interloc[0]->nom)."</strong></h4>";

	$Nof_trajet = sizeof($liste_id_trajet);

	for ($i = 0 ; $i <= $Nof_trajet -1 ; $i++)  // Pour chaque trajet 
	{	
		//  Vérification de la date du trajet 
		$date 	= strtotime($data_trajet[$i][0]->date_trajet);
		$current_date = time();
		$diff = $date - $current_date ; 
		if($diff>=0)  
		{
			$date_trajet 	= date('d/m/y',$date);
			$heure_trajet 	= date('H:i',$date);
			echo "<br><strong>"."Trajet ".$data_trajet[$i][0]->ville_depart." >> ".$data_trajet[$i][0]->ville_arrivee."</strong> ";
			echo "<i>le ".$date_trajet." à ".$heure_trajet."<br></i>" ;



			$Nof_messages  = sizeof($liste_id_messages[$i]);

			for ($j=0 ; $j<=$Nof_messages-1 ; $j++) // Pour chaque message ....  
			{	
			
				$date_post 	= strtotime($data_message[$i][$j][0]->date_creation);
				$date_message 	= date('d/m/y',$date_post);
				$heure_message 	= date('H:i',$date_post);
				if($data_message[$i][$j][0]->id_exped == $id)
				{
					echo ucfirst($data_profil[0]->prenom).", le ".$date_message." à ".$heure_message." : ";
				}
				else
				{
					echo ucfirst($data_interloc[0]->prenom).", le ".$date_message." à ".$heure_message." : ";
				}	
				echo "<i> \"".$data_message[$i][$j][0]->texte."\"</i>" ;
				echo "<br>";
			} 
		}
	}

	// Formulaire de conversation
	echo form_open("Espace_perso/Messagerie/repondre/");?>
	<br>
	<h5>Envoyer un message à <?php echo ucfirst($data_interloc[0]->prenom) ?> </h5>		 
	
	<div class="form-group">
		<label for="id_trajet">A propos du trajet :</label>

		<select name="id_trajet">  
			<option value=""> ----- Choisir un trajet ----- </option>

			<?php  
			for($i = 0 ; $i <= $Nof_trajet -1 ; $i++)
			{ ?>
				<option value="<?php echo $data_trajet[$i][0]->id ?>"> <?php echo $data_trajet[$i][0]->ville_depart." >> ".$data_trajet[$i][0]->ville_arrivee; ?> </option>
			<?php 
			echo form_error('id_trajet'); 
			}
			?>
		</select>
	</div>
	
	<div class="form-group">
		<label for="message"></label>
		<input type="text" class = 'form-control' name="message" placeholder ="Votre message" />
		<?php echo form_error('message') ;?>
	</div>

	<div class="form-group">
		<!-- <input type="hidden" name="sujet" 		value="<?php echo $data_message[$i][$j][0]->sujet;?>" /> -->
		<input type="hidden" name="id_exped" 	value="<?php echo $data_profil[0]->id;?> " />
		<input type="hidden" name="id_dest" 	value="<?php echo $data_interloc[0]->id ;?>" />
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-default" name="bouton_repondre" value="poster" > Répondre</button>
	</div>
	<?php form_close(); 
?>
</div>
</html>




