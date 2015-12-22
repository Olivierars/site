 <div class="container">
 	<body>
 		<h1>Mes Voyages</h1>

 		<h3>En attente de confirmation</h3>
 		<?php 

 		
 		if(!empty($trajet_en_attente))
 		{
 			$Nof_trajet_attente = sizeof($trajet_en_attente);
          
          	for($i =0;$i<= $Nof_trajet_attente-1 ; $i++ )
          	{
          		$date = strtotime($trajet_en_attente[$i][0]->date_trajet);
    			$dat = date('d/m/y', $date);
    			$heure = strtotime($trajet_en_attente[$i][0]->heure_trajet);
    			$tme 	= date('H', $heure);

    			print_r($dat);
    			print_r($tme);

    			echo "--> ".ucfirst($trajet_en_attente[$i][0]->ville_depart) . " >> ".ucfirst($trajet_en_attente[$i][0]->ville_arrivee)." le ".$dat." à ".$tme." h  " ;
 				echo "proposé par ".ucfirst($data_posteur_attente[$i][0]->prenom) . " " . ucfirst($data_posteur_attente[$i][0]->nom)."<br>";

          	}
		}
		else
		{
			echo "Vous n'avez pas de trajet en attente de confirmation" ;
		}
 		?>


 		<h3>Confirmés </h3>
 		<?php 
 		if(!empty($trajet_confirme))
 		{
 			$Nof_trajet_confirme = sizeof($trajet_confirme);
          
          	for($i =0;$i<= $Nof_trajet_confirme-1 ; $i++ )
          	{
          		$date = strtotime($trajet_confirme[$i][0]->date_trajet);
    			$dat = date('d/m/y', $date);
    			$heure = strtotime($trajet_confirme[$i][0]->heure_trajet);
    			$tme 	= date('H', $heure);

    			print_r($dat);
    			print_r($tme);

    			echo "--> ".ucfirst($trajet_confirme[$i][0]->ville_depart) . " >> ".ucfirst($trajet_confirme[$i][0]->ville_arrivee)." le ".$dat." à ".$tme." h  " ;
 				echo "proposé par ".ucfirst($data_posteur_confirme[$i][0]->prenom) . " " . ucfirst($data_posteur_confirme[$i][0]->nom)."<br>";

          	}
		}
		else
		{
			echo "Vous n'avez pas de trajet confirmé" ;
		}
 		?>


</body>
</div>