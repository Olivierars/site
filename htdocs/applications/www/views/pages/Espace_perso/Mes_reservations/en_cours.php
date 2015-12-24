<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<div class="container">
  <ul class="nav nav-pills">
    <li role="presentation"><a href="<?php echo site_url('Espace_perso/Mes_reservations/recherche_trajet') ?>">Rechercher un trajet</a></li>
    <li role="presentation" class="active"><a href="<?php echo site_url('Espace_perso/Mes_reservations/en_cours') ?>">Mes réservations en cours</a></li>
    <li role="presentation"><a href="<?php echo site_url('Espace_perso/Mes_reservations/archives') ?>">Mes réservations archivées</a></li>
  </ul>
  <br>
 		<?php 
    $compteur = 0 ;
    if(!empty($trajet))
    {
      $Nof_trajet = sizeof($trajet);
          
      for($i =0;$i<= $Nof_trajet-1 ; $i++ )
      {
        $date = strtotime($trajet[$i][0]->date_trajet);
        $current_date = time();
        $diff = $date - $current_date ; 

        if($diff>=0)
        {
          $compteur++ ;
          $date_trajet  = date('d/m/y',$date);
          $heure_trajet   = date('H:i',$date);

          ?>
        <div class="panel panel-primary">
          <ul class="list-group">
            <div class="panel-body" id="listing_message">
              <?php
              // 
              echo "<strong>".ucfirst($trajet[$i][0]->ville_depart) . " >> ".ucfirst($trajet[$i][0]->ville_arrivee)."</strong>, le ".$date_trajet." à ".$heure_trajet." " ;
              echo "souhaité par ".ucfirst($data_posteur[$i][0]->prenom) . " " . ucfirst($data_posteur[$i][0]->nom);
              
              echo str_repeat("&nbsp;", 10);

              // Statut
              if(strcmp($statut[$i],'attente_confirmation')==0)
              {
                ?>
                <FONT COLOR=#FF0000> En attente de confirmation</FONT>
                <?php 
              }
              elseif (strcmp($statut[$i],'confirme')==0) 
              {
                ?>
                <FONT COLOR=#00CE00> Confirmé </FONT>
                <?php 
              }
              
              echo str_repeat("&nbsp;", 10);
              ?>

              <!-- Détail trajet -->
              <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="<?php echo '#myModal'.$i.'trajet' ; ?>">
                Voir détail trajet
              </button>
              <div class="modal fade" id="<?php echo 'myModal'.$i.'trajet' ; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Détail du trajet</h4>
                    </div>
                    <div class="modal-body">
                      <?php
                      $id_trajet      = $trajet[$i][0]->id;
                      $ville_depart   = $trajet[$i][0]->ville_depart;
                      $ville_arrivee  = $trajet[$i][0]->ville_arrivee ;
                      $date_trajet    = $trajet[$i][0]->date_trajet ;
                      $message        = $trajet[$i][0]->message;
                      $id_posteur     = $data_posteur[$i][0]->id ;
                      $nom_posteur    = $data_posteur[$i][0]->nom;
                      $prenom_posteur = $data_posteur[$i][0]->prenom;
                      $age_posteur    = $data_posteur[$i][0]->age;
                      $hobbies        = json_decode($data_posteur[$i][0]->hobbies);;
                      $date           = strtotime($date_trajet);
                      $date_trajet    = date('d/m/y',$date);
                      $heure_trajet   = date('H:i',$date);
                      
                      echo "Trajet proposé par ".ucfirst($prenom_posteur)." ".ucfirst($nom_posteur)."<br>"; 
                      echo "De ".ucfirst($ville_depart) . " >> " . ucfirst($ville_arrivee)."<br>" ;
                      echo "Le ".$date_trajet . " à ".$heure_trajet."<br><br>";
                      echo "Message : ".$message."<br><br>"; 
                      ?>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Détail profil -->
               <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="<?php echo '#myModal'.$i.'profil' ; ?>">
                <?php echo "Profil de  ".$prenom_posteur ?> 
              </button>
              <div class="modal fade" id="<?php echo 'myModal'.$i.'profil' ; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Détail du profil</h4>
                    </div>
                    <div class="modal-body">
                      <?php 
                      $filename = "../assets/images/photos_profil/photo_profil_".$id_posteur.".png" ;
                      if (file_exists($filename))
                      { ?>
                        <img  src=<?php echo "/assets/images/photos_profil/photo_profil_".$id_posteur.".png";?> class="profile-image img-circle" width ="80" alt="photo de profil"> 
                      <?php  
                      }
                      $filename = "../assets/images/photos_profil/photo_profil_".$id_posteur.".jpg" ;
                      if (file_exists($filename))
                      { ?>
                        <img  src=<?php echo "/assets/images/photos_profil/photo_profil_".$id_posteur .".jpg";?> class="profile-image img-circle" width ="80" alt="photo de profil"> 
                      <?php  
                      }
                      ?>
                      <br>
                      Prénom : <?php echo $prenom_posteur ; ?> <br>
                      Nom : <?php echo $nom_posteur ;?><br>
                      Age : <?php  echo $age_posteur;?><br>
                      Hobbies :<?php 
                      if(!is_null($hobbies))
                      {
                        if(isset($hobbies->lecture)){ if($hobbies->lecture){ ?>   <i class="fa fa-book fa-2x" titre="lecture"></i> <?php }}
                        if(isset($hobbies->sport)){   if($hobbies->sport){ ?>   <i class="fa fa-futbol-o fa-2x" titre="sport"></i> <?php }}
                        if(isset($hobbies->musique)){ if($hobbies->musique){ ?>   <i class="fa fa-music fa-2x" titre="musique"></i> <?php }}
                        if(isset($hobbies->cinema)){  if($hobbies->cinema){ ?>    <i class="fa fa-film fa-2x" titre="cinema"></i> <?php }}
                        if(isset($hobbies->voyage)){  if($hobbies->voyage){ ?>    <i class="fa fa-plane fa-2x" titre="voyage"></i> <?php }}
                        if(isset($hobbies->sorties)){ if($hobbies->sorties){ ?>   <i class="fa fa-beer fa-2x" titre="sorties"></i> <?php }}
                        if(isset($hobbies->photo)){   if($hobbies->photo){ ?>   <i class="fa fa-camera-retro fa-2x" titre="photo"></i> <?php }}

                      }
                      ?> 
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </ul> 
        </div>
        <?php 
        }  
      } 
    }
    if($compteur==0)
    {
      echo "Vous n'avez pas d'accompagnement en cours " ;
    }
    ?>
</div>
 		