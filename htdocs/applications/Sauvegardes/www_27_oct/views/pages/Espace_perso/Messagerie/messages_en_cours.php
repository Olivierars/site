<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<div class="container">

	<ul class="nav nav-pills">
		<li role="presentation" class="active"><a href="<?php echo site_url('Espace_perso/Messagerie/messages_en_cours') ?>">Messages en cours </a></li>
		<li role="presentation"><a href="<?php echo site_url('Espace_perso/Messagerie/messages_archives') ?>">Messages archivés</a></li>
	</ul>

	<?php 
	// print_r($data_interloc);

	if(!empty($liste_id_trajet))
	{
		// Récupération des tailles de vecteurs trajet , interlocuteurs et messages 
		$Nof_tajets 			= sizeof($liste_id_trajet);
		$id_reponse = 0 ;  // curseur pour les formulaire de nouveau message
		
 		for($i=0 ; $i<=$Nof_tajets-1 ; $i++)  // Pour chaque trajet .... 
 		{
 			//  Vérification de la date du trajet 
 			$date 	= strtotime($data_trajet[$i][0]->date_trajet);
			$current_date = time();
    		$diff = $date - $current_date ; 
    		if($diff>=0)  
   			{
   				$date_trajet 	= date('d/m/y',$date);
 				$heure_trajet 	= date('H:i',$date);
 				echo "<h4><br><strong>"."Trajet ".$data_trajet[$i][0]->ville_depart." >> ".$data_trajet[$i][0]->ville_arrivee."</strong> ";
 				echo "<i>le ".$date_trajet." à ".$heure_trajet."<br></i></h4>" ; 
 				
 				$Nof_interloc = sizeof($liste_id_interloc[$i]);

				for ($j = 0 ; $j <= $Nof_interloc -1 ; $j++)  // Pour chaque interlocuteur 
				{	

					echo "<br><strong>"."Conversation avec ".ucfirst($data_interloc[$i][$j][0]->prenom)." ".ucfirst($data_interloc[$i][$j][0]->nom)."</strong><br>";
					
					$Nof_messages  = sizeof($liste_id_messages[$i][$j]);

		 			for ($k=0 ; $k<=$Nof_messages-1 ; $k++) // Pour chaque message ....  
		 			{	
		 				
 						$date_post 	= strtotime($data_message[$i][$j][$k][0]->date_creation);
 						$date_message 	= date('d/m/y',$date_post);
 						$heure_message 	= date('H:i',$date_post);
 						if($data_message[$i][$j][$k][0]->id_exped == $id)
 						{
 							echo ucfirst($data_profil[0]->prenom).", le ".$date_message." à ".$heure_message." : ";
 						}
 						else
 						{
 						echo ucfirst($data_interloc[$i][$j][0]->prenom).", le ".$date_message." à ".$heure_message." : ";
 						}	
 						// echo $data_message[$i][$j][$k][0]->sujet;
 						// echo "<br>";
 						echo "<i> \"".$data_message[$i][$j][$k][0]->texte."\"</i>" ;
 						echo "<br>";
		 			} 

		 			// Formulaire de réponse pour chaque interlocuteur ?>

		 			
		 			<input type="button" onClick="bascule('<?php echo "boite".$id_reponse;?>');" name="<?php echo "ouvre_formulaire".$id_reponse; ?>" value="Nouveau message">
		 			
		 			<div name="<?php echo "boite".$id_reponse;?>" id="<?php echo "boite".$id_reponse;?>" style="visibility: hidden">
			 			<?php
			 			echo form_open("Espace_perso/Messagerie/repondre/");?>
			 			
			 			<div class="form-group">
							<label for="message"></label>
							<!-- <textarea name="demande" rows="5"><?php echo set_value('demande'); ?></textarea> -->
							<input type="text" class = 'form-control' name="message" placeholder ="Votre message" />
							<?php echo form_error('message') ?>
						</div>

			 			<div class="form-group">
			 				<input type="hidden" name="sujet" 		value="<?php echo $data_message[$i][$j][0][0]->sujet;?>" />
			 				<input type="hidden" name="id_exped" 	value="<?php echo $data_profil[0]->id;?> " />
			 				<input type="hidden" name="id_dest" 	value="<?php echo $data_interloc[$i][$j][0]->id ;?>" />
			 				<input type="hidden" name="id_trajet" 	value="<?php echo $data_trajet[$i][0]->id ; ?>" />						</div>

						<div class="form-group">
							<button type="submit" class="btn btn-default" name="bouton_repondre" value="poster" > Répondre</button>
						</div>
					</div>


					<br>	

					<?php form_close(); 
					$id_reponse++ ;

		 			
					
				}
			}
		}
	}

?>
</div>
</html>