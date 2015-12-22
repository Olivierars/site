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
	foreach($results as $data) 
	{  
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
	 					// echo anchor("Espace_perso/Mes_annonces/supprime_trajet/".$data->id,"Supprimer ce trajet ?");
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