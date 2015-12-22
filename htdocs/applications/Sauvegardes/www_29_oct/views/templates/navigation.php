<div class="container">

  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo site_url('Accueil/accueil') ?>">SAaaaamba !</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li class="<?php if( $title == "A_propos"){echo "active";}?>"><a href="<?php echo site_url('Accueil/a_propos') ?>">Notre Projet</a></li>
          <li class="<?php if( $title == "Contact"){echo "active";}?>"><a href="<?php echo site_url('Accueil/Contact') ?>">Contactez nous</a></li>
          <li class="<?php if( $title == "Faq"){echo "active";}?>"><a href="<?php echo site_url('Accueil/faq') ?>">Des questions ? </a></li>
          
        </ul>
        
        <ul class="nav navbar-nav navbar-right">
          <?php 
          if($this->session->userdata('logged_in'))
          { ?>
            <button onclick="location.href='<?php echo site_url('Espace_perso/Tableau_de_bord') ?>'" class="btn btn-default navbar-btn">MON PROFIL</button>
            <button onclick="location.href='<?php echo site_url('Utilisateur/deconnexion') ?>'" class="btn btn-default navbar-btn">SE DECONNECTER</button>

            <?php
          }
          else
          { ?>
            <button onclick="location.href='<?php echo site_url('Utilisateur/inscription') ?>'" class="btn btn-default navbar-btn">S'INSCRIRE</button>
            <button onclick="location.href='<?php echo site_url('Utilisateur/connexion') ?>'" class="btn btn-default navbar-btn">SE CONNECTER</button>
            <?php
          }
          ?>
        </ul>

      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
</div>


