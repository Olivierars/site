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
				<br> <br>
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
			echo ucfirst($prenom)." ".ucfirst($nom)."<br>" ; 
			echo $email."<br>" ; 
			if(strcmp($role, "accompagne")==0){$role="Accompagné(e)";}
			echo "Statut : ".ucfirst($role)."<br>"
			?>
			<br>
			<p>
				<a href="<?php echo site_url('Espace_perso/profil') ?>"> Modifier mon profil ?</a>
			</p>

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
        		$new_message = 0;
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
    	<div class="row">
			<div class="panel panel-primary">
				<div class="panel-heading">
			 		<a href="<?php echo site_url('Espace_perso/mes_annonces') ?>"><FONT COLOR=#FFFFFF>Mes annonces</FONT> </a>
			 	</div>
			  	<div class="panel-body">
			    Panel content
			  	</div>
			</div>    
		</div>	

    	<!-- Réservations -->
    	<div class="row">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<a href="<?php echo site_url('Espace_perso/mes_reservations') ?>"><FONT COLOR=#FFFFFF>Mes réservation de trajets</FONT> </a>
				</div>
		  		<div class="panel-body">
		    	Panel content
		  		</div>
			</div>      	
		</div>

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