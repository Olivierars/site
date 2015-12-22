<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<div class="container">

	<ul class="nav nav-pills">
	  <li role="presentation"><a href="<?php echo site_url('Espace_perso/Mes_formations/recherche_formation') ?>">Formations disponibles</a></li>
	  <li role="presentation" class="active"><a href="<?php echo site_url('Espace_perso/Mes_formations/formation_a_venir') ?>">Mes formations en cours</a></li>
	  <li role="presentation"><a href="<?php echo site_url('Espace_perso/Mes_formations/formation_archive') ?>">Récapitulatif de mes formations</a></li>
	</ul>

	<h3>Mes formations en cours</h3>
	<br>
	<img class="displayed" 	src="/assets/images/plot_chantier.png" width="120"  alt="en chantier" />
	<br>
	<h4 id="chantier">
		La rubrique "Formation" sera bientôt disponible. Merci de votre compéhension. 
	</h4>
	
		
</div>

</html>