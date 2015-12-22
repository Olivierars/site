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

	if(!empty($liste_id_interloc))
	{
		$Nof_interloc 			= sizeof($liste_id_interloc);
		// $id_reponse = 0 ;  // curseur pour les formulaire de nouveau message
		
 		for($i=0 ; $i<=$Nof_interloc-1 ; $i++)  // Pour chaque interloc .... 
 		{
			echo "<br><strong><h4>"."Conversation avec ".ucfirst($data_interloc[$i][0]->prenom)." ".ucfirst($data_interloc[$i][0]->nom)."</strong>";
			echo str_repeat("&nbsp;", 10);
 			echo anchor("Espace_perso/Messagerie/conversation/".$data_interloc[$i][0]->id,"Accéder à la conversation complète ?"."<br></h4>");

 				$Nof_trajet = sizeof($liste_id_trajet[$i]);

				for ($j = 0 ; $j <= $Nof_trajet -1 ; $j++)  // Pour chaque trajet 
				{	
					//  Vérification de la date du trajet 
					$date 	= strtotime($data_trajet[$i][$j][0]->date_trajet);
					$current_date = time();
					$diff = $date - $current_date ; 
					if($diff>=0)  
					{
						$date_trajet 	= date('d/m/y',$date);
						$heure_trajet 	= date('H:i',$date);
						echo "<br><strong>"."Trajet ".$data_trajet[$i][$j][0]->ville_depart." >> ".$data_trajet[$i][$j][0]->ville_arrivee."</strong> ";
						echo "<i>le ".$date_trajet." à ".$heure_trajet."<br></i>" ; 

						$Nof_messages  = sizeof($liste_id_messages[$i][$j]);

						// Affichage du dernier message 
			 			// for ($k=0 ; $k<=$Nof_messages-1 ; $k++) // Pour chaque message ....  
			 			// {	
			 				
 						$date_post 	= strtotime($data_message[$i][$j][$Nof_messages-1][0]->date_creation);
 						$date_message 	= date('d/m/y',$date_post);
 						$heure_message 	= date('H:i',$date_post);
 						if($data_message[$i][$j][$Nof_messages-1][0]->id_exped == $id)
 						{
 							echo ucfirst($data_profil[0]->prenom).", le ".$date_message." à ".$heure_message." : ";
 						}
 						else
 						{
 						echo ucfirst($data_interloc[$i][0]->prenom).", le ".$date_message." à ".$heure_message." : ";
 						}	
 						// echo $data_message[$i][$j][$k][0]->sujet;
 						// echo "<br>";
 						echo "<i> \"".$data_message[$i][$j][$Nof_messages-1][0]->texte."\"</i>" ;
 						echo "<br>";
		 				// } 

			 		}
		 			form_close(); 

		 			
					
				
			}
		}
	}

?>
</div>
</html>