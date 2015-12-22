
<nav id = "header" class="navbar navbar-inverse navbar-fixed-top">    <div class="container">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        

        <a class="navbar-brand" href="<?php echo site_url('Accueil') ?>"> <FONT COLOR=#FFFFFF>Saaaamhba ! </FONT></a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

        <ul class="nav navbar-nav">
          <button id="propose_button" onclick="location.href='<?php echo site_url('Espace_perso/Mes_annonces/propose_trajet') ?>'" class="btn btn-default navbar-btn"> Proposer un trajet</button>
          <button id="recherche_button" onclick="location.href='<?php echo site_url('Espace_perso/Mes_reservations/recherche_trajet') ?>'" class="btn btn-default navbar-btn">Rechercher un trajet</button>
          <!-- <li><a href="<?php echo site_url('Espace_perso/Mes_annonces/propose_trajet') ?>">Proposer un trajet</a></li>
          <li><a href="<?php echo site_url('Espace_perso/Mes_reservations/recherche_trajet') ?>">Rechercher un trajet</a></li>     -->     
        </ul>
        
        
        <ul class="nav navbar-nav navbar-right">
          <button id="nav_button" onclick="location.href='<?php echo site_url('Utilisateur/deconnexion') ?>'" class="btn btn-default navbar-btn">
            <span class="glyphicon glyphicon-off" aria-hidden="true"></span> SE DECONNECTER</button>
        </ul>

      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </div><!-- /.container -->
</nav>

<div class="container">
<nav id = "header" class="navbar navbar-inverse ">
  
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <?php 
        foreach($data_profil as $data) 
        { 
          $prenom = $data->prenom ;
          $id     = $data->id; 
        } 
         ?>

        <a class="navbar-brand" href="<?php echo site_url('Espace_perso/Tableau_de_bord') ?>"><FONT COLOR=#FFFFFF><?php echo "Bonjour ".$prenom." !"; ?></FONT></a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->  
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li class="<?php if( $menu == "mes_annonces"){echo "active";}?>"><a href="<?php echo site_url('Espace_perso/Mes_annonces/propose_trajet') ?>">
            <span class="glyphicon glyphicon-road" aria-hidden="true"></span> Mes annonces</a></li>
          <li class="<?php if( $menu == "mes_reservations"){echo "active";}?>"><a href="<?php echo site_url('Espace_perso/Mes_reservations/recherche_trajet') ?>">
            <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Mes réservations</a></li>
          <li class="<?php if( $menu == "mes_formations"){echo "active";}?>"><a href="<?php echo site_url('Espace_perso/Mes_formations') ?>">
            <span class="glyphicon glyphicon-education" aria-hidden="true"></span> Mes formations</a></li> 
          <li class="<?php if( $menu == "messagerie"){echo "active";}?>"><a href="<?php echo site_url('Espace_perso/Messagerie') ?>">
            <span class="glyphicon glyphicon-comment" aria-hidden="true"></span> Messagerie</a></li>          
          <li class="<?php if( $menu == "avis"){echo "active";}?>"><a href="<?php echo site_url('Espace_perso/Avis') ?>">
            <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span> Avis</a></li>
          <li class="<?php if( $menu == "profil"){echo "active";}?>"><a href="<?php echo site_url('Espace_perso/Profil') ?>">
            <?php 
            $filename = "../assets/images/photos_profil/photo_profil_".$id.".jpg" ;
            if (file_exists($filename))
            { ?>
              <img id='navbar_profil_pict' src=<?php echo "/assets/images/photos_profil/photo_profil_".$id.".jpg";?> class="profile-image img-circle"> 
            <?php  
            }
            else
            { ?>
              <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
            <?php 
            }
            ?>

            Profil</a></li> 
            

        </ul>
        
        
        <!-- <ul class="nav navbar-nav navbar-right">
          <button onclick="location.href='<?php echo site_url('Utilisateur/deconnexion') ?>'" class="btn btn-default navbar-btn">SE DECONNECTER</button>
        </ul> -->

      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
  </div><!-- /.container -->

