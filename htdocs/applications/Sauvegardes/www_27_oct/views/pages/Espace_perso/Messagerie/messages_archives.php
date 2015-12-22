<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<div class="container">

	<ul class="nav nav-pills">
	  <li role="presentation"><a href="<?php echo site_url('Espace_perso/Messagerie/messages_en_cours') ?>">Messages en cours </a></li>
	  <li role="presentation" class="active"><a href="<?php echo site_url('Espace_perso/Messagerie/messages_archives') ?>">Messages archivés</a></li>
	</ul>

 	<?php 
 	
	if(!empty($liste_trajets))
 	{
 		
 		$Nof_tajets 	= sizeof($liste_trajets);
 		$Nof_messages 	= sizeof($messages);	

 		for($i=0 ; $i<=$Nof_tajets-1 ; $i++)  // Pour chaque trajet .... 
 		{
 			for ($j=0 ; $j<=$Nof_messages-1 ; $j++) // Pour chaque message ....  
 			{	
 				if($messages[$j]->id_trajet == $liste_trajets[$i])  // ...correspondant au trajet 
 				{	
 					$date 	= strtotime($trajets[$j][0]->date_trajet);
					$current_date = time();
    				$diff = $date - $current_date ; 

    				if($diff < 0) // Vérification de la date du trajet 
    				{

 					echo "<br><strong>"."Trajet ".$trajets[$j][0]->ville_depart." >> ".$trajets[$j][0]->ville_arrivee."</strong><br>"; 
 					echo "De ".ucfirst($profil_exp[$j][0]->prenom). " ".ucfirst($profil_exp[$j][0]->nom). " à ".ucfirst($profil_dest[$j][0]->prenom). " ".ucfirst($profil_dest[$j][0]->nom);
 					
 					$date 	= strtotime($messages[$j]->date_creation);
    				$date_trajet 	= date('d/m/y',$date);
    				$heure_trajet 	= date('H:i',$date);

 					echo "posté le ".$date_trajet." à ".$heure_trajet."<br>";
 					echo "Messages : \"".$messages[$j]->texte."\"<br>";
    				}
 				}
 			}	 
 		} 	
	}

?>
</div>
</html>