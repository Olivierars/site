

  <nav id = "header" class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo site_url('Accueil/accueil') ?>"><strong><FONT COLOR=#FFFFFF> SAaaaamba ! </FONT></strong> </a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li id="nav_list" class="<?php if( $title == "A_propos"){echo "active";}?>"><a href="<?php echo site_url('Accueil/a_propos') ?>">Notre Projet</a></li>
          <li id="nav_list" class="<?php if( $title == "Contact"){echo "active";}?>"><a href="<?php echo site_url('Accueil/Contact') ?>">Contactez nous</a></li>
          <li id="nav_list" class="<?php if( $title == "Faq"){echo "active";}?>"><a href="<?php echo site_url('Accueil/faq') ?>">Des questions ?</a></li>
          
        </ul>
        
        <ul class="nav navbar-nav navbar-right">
          <?php 
          if($this->session->userdata('logged_in'))
          { 
            ?>
            <button id="nav_button" onclick="location.href='<?php echo site_url('Espace_perso/Tableau_de_bord') ?>'" class="btn btn-default navbar-btn">
            <?php 
            $filename = "../assets/images/photos_profil/photo_profil_".$this->session->userdata('logged_in')['id'].".jpg" ;
            if (file_exists($filename))
            { ?>
              <img id='navbar_profil_pict' src=<?php echo "/assets/images/photos_profil/photo_profil_".$this->session->userdata('logged_in')['id'].".jpg";?> class="profile-image img-circle"> 
            <?php  
            }
            else
            { ?>
              <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
            <?php 
            }
            ?>
              MON PROFIL</button>
            <button id="nav_button" onclick="location.href='<?php echo site_url('Utilisateur/deconnexion') ?>'" class="btn btn-default navbar-btn">
              <span class="glyphicon glyphicon-off" aria-hidden="true"></span> SE DECONNECTER</button>

            <?php
          }
          else
          { ?>
            <button id="nav_button" onclick="location.href='<?php echo site_url('Utilisateur/inscription') ?>'" class="btn btn-default navbar-btn">
              <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> S'INSCRIRE</button>
            <!-- <button data-toggle="modal" data-backdrop="false" href='<?php echo site_url('Utilisateur/connexion') ; ?>' class="btn btn-default navbar-btn">SE CONNECTER</button> -->
            <button id="nav_button" onclick="location.href='<?php echo site_url('Utilisateur/connexion') ?>'" class="btn btn-default navbar-btn">
              <span class="glyphicon glyphicon-off" aria-hidden="true"></span> SE CONNECTER</button>
            <?php
          }
          ?>
        </ul>

      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
</div>


