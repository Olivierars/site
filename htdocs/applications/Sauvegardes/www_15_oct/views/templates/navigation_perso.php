<div class="container">
  <nav class="navbar navbar">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        

        <a class="navbar-brand" href="<?php echo site_url('Accueil') ?>"> Saaaamhba ! </a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

        <ul class="nav navbar-nav">
          <li><a href="<?php echo site_url('Espace_perso/recherche_trajet') ?>">Rechercher un trajet</a></li>
          <li><a href="<?php echo site_url('Espace_perso/propose_trajet') ?>">Proposer un trajet</a></li>         
        </ul>
        
        
        <ul class="nav navbar-nav navbar-right">
          <button onclick="location.href='<?php echo site_url('Utilisateur/deconnexion') ?>'" class="btn btn-default navbar-btn">SE DECONNECTER</button>
        </ul>

      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>



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
        <?php 
        foreach($data_profil as $data) 
        { 
          $prenom = $data->prenom ;
        } 
         ?>

        <a class="navbar-brand" href="<?php echo site_url('Espace_perso') ?>"><?php echo "Bonjour ".$prenom; ?> !</a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

        <ul class="nav navbar-nav">
          <li><a href="<?php echo site_url('Espace_perso/recherche_trajet') ?>">Rechercher un trajet</a></li>
          <li><a href="<?php echo site_url('Espace_perso/propose_trajet') ?>">Proposer un trajet</a></li>
          <li><a href="<?php echo site_url('Espace_perso/mes_voyages') ?>">Mes voyages</a></li>          
          <li><a href="<?php echo site_url('Espace_perso/messagerie') ?>">Messagerie</a></li>          
        </ul>
        
        
        <!-- <ul class="nav navbar-nav navbar-right">
          <button onclick="location.href='<?php echo site_url('Utilisateur/deconnexion') ?>'" class="btn btn-default navbar-btn">SE DECONNECTER</button>
        </ul> -->

      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
</div>