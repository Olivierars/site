 <div class="container">
 	<body>
 		<h1>Mes trajets</h1>

 		<?php
 		if(empty($results))
 		{
 			echo "Vous n'avez pas encore de trajet proposé   =>   " ; 
 			echo anchor('Espace_perso/propose_trajet','Proposez un nouveau trajet !');
 		}
		else
		{
			foreach($results as $data) 
			{
 			echo "-> De ".ucfirst($data->ville_depart) . " à " . ucfirst($data->ville_arrivee)  . " le ".$data->date_trajet. "<br>";
 			}
		}
 		
 		?>
 		<p><?php echo $links; ?></p>
 <!--  </div>
  <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div> -->

</body>
</div>