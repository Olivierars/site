<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<div class="container">
<legend>Mon tableau de bord</legend>

<!-- Récupération des datas --> 
<?php 
$id 	= $data_profil[0]->id ; 
$nom 	= $data_profil[0]->nom;
$prenom = $data_profil[0]->prenom ;
$email 	= $data_profil[0]->email ;
$role 	= $data_profil[0]->role;
$pres	= $data_profil[0]->texte_pres;
$age 	= $data_profil[0]->age ;
$hobbies = json_decode($data_profil[0]->hobbies);
$type_handi = json_decode($data_profil[0]->type_handi);
$pourcentage_handi = $data_profil[0]->pourcentage_handi;
?>

<div class="row">
    <div class="col-md-3">

    	<!-- Photo de profil -->
    	<div class="row">
	        <?php 
			$filename = "../assets/images/photos_profil/photo_profil_".$id.".jpg" ;
			if (file_exists($filename))
			{ ?>
				<img id='board_profil_pict' src=<?php echo "/assets/images/photos_profil/photo_profil_".$id.".jpg";?> class="profile-image img-circle" alt="photo de profil"> 
				<br> 
			<?php  
			}
			else
			{ ?>
				<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
			<?php 
			}	
			?>
		</div>

		<!-- Infos Perso  -->
		<div class="row" id="info_perso">
			<?php 
			echo "<strong>".ucfirst($prenom)." ".ucfirst($nom)."</strong><br>" ; 
			echo $age." ans<br><br>";
			// echo $email."<br><br>" ; 
			$role_print = $role;
			if(strcmp($role, "accompagne")==0){$role_print="Accompagné";}
			echo "<strong> Statut : </strong> ".ucfirst($role_print)."<br><br>" ;

			if(strcmp($role, "accompagne")==0)
			{
				if(!is_null($type_handi))
				{

					if(isset($type_handi->moteur)){		if($type_handi->moteur){ ?> <img 	src=<?php echo "/assets/images/handi_moteur.png";?> width="40"  titre="moteur" alt="logo handicap moteur" /><?php }}
					if(isset($type_handi->mental)){		if($type_handi->mental){ ?> <img 	src=<?php echo "/assets/images/handi_mental.png";?> width="40"  titre="mental" alt="logo handicap mental" /><?php }}
					if(isset($type_handi->visuel)){		if($type_handi->visuel){ ?> <img 	src=<?php echo "/assets/images/handi_visuel.png";?> width="40"  titre="visuel" alt="logo handicap visuel" /><?php }}
					if(isset($type_handi->auditif)){	if($type_handi->auditif){ ?> <img 	src=<?php echo "/assets/images/handi_auditif.png";?> width="40" titre="auditif" alt="logo handicap auditif" /><?php }}
				}
				if(!is_null($pourcentage_handi))
				{
					echo "<br><br>Taux d'incapacité : ".$pourcentage_handi." %";
				}
			}
			?>
			<br><br>
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
			?> 
			<br><br>
			<p><a href="<?php echo site_url('Espace_perso/profil') ?>"> Modifier mon profil ?</a></p>

		</div>
    </div>


    <div class="col-md-9">	

    	
    	<div class="row">
    		<!-- Avis et notation -->
    		<div class="col-md-9">
        		<div class="well">Avis et notation 
        		</div>
        	</div>

        	<!-- Messages -->
        	<div class="col-md-3">
        		<?php 
        		$new_message = 1;
        		if($new_message == 0)
        		{ ?>
        			<a href="<?php echo site_url('Espace_perso/messagerie') ?>">
					<img class="displayed" src="/assets/images/no_message.png" alt ="pas de nouveau message" width="60" title = "Vous n'avez pas de nouveau message"> </a>
				<?php 
        		}
        		elseif($new_message == 1)
        		{ ?>
        			<a href="<?php echo site_url('Espace_perso/messagerie') ?>">
					<img class="displayed" src="/assets/images/new_message.png" alt ="nouveaux messages non lus" width="80" title ="Vous avez des nouveaux messages"> </a>
				
				<?php
					// // header ("Content-type: image/png");
					// $image = imagecreate(200,50);
					// $noir = imagecolorallocate($image, 0, 0, 0);
					// echo imagestring($image, 4, 35, 15, "Salut les Zéros !", $noir);
        		}
        		

				?>       		
        	</div>
    	</div>

    	<!-- Annonces -->
    	<?php 
    	if(strcmp($role, "accompagne")==0)
    	{?>
    	<div class="row">
			<div class="panel panel-primary">
				<div class="panel-heading">
			 		<a href="<?php echo site_url('Espace_perso/mes_annonces') ?>"><FONT COLOR=#FFFFFF>Mes demandes d'accompagnement récentes</FONT> </a>
			 	</div>
			  	<div class="panel-body">
			    Panel content
			  	</div>
			</div>    
		</div>	
		<?php } ?>

    	<!-- Réservations -->
    	<?php 
    	if(strcmp($role, "accompagnateur")==0)
    	{?>
    	<div class="row">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<a href="<?php echo site_url('Espace_perso/mes_reservations') ?>"><FONT COLOR=#FFFFFF>Mes accompagnements récents</FONT> </a>
				</div>
		  		<div class="panel-body">
		    	Panel content
		  		</div>
			</div>      	
		</div>
		<?php } ?>

    	<!-- Formations -->
    	<div class="row">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<a href="<?php echo site_url('Espace_perso/mes_formations') ?>"><FONT COLOR=#FFFFFF>Mes formations</FONT></a>
				</div>
		  		<div class="panel-body">
		    		<img src="/assets/images/plot_chantier.png" width="40"  alt="en chantier" /> Rubrique bientôt disponible ! 
		  		</div>
			</div>      	
		</div>

    </div>
</div>






</div>

</html>