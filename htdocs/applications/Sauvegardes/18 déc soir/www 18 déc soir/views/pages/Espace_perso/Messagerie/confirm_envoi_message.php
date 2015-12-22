<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>

<div class="container">

	<!-- <ul class="nav nav-pills">
	  <li role="presentation"><a href="<?php echo site_url('Espace_perso/Messagerie/messages_en_cours') ?>">Messages en cours </a></li>
	  <li role="presentation"><a href="<?php echo site_url('Espace_perso/Messagerie/messages_archives') ?>">Messages archivés</a></li>
	</ul> -->

	<p><h2> Votre message a bien était envoyé au destinataire ! </h2></p>

	Vous allez être redirigé vers votre messagerie dans un  instant
	<script type="text/javascript"> 
	<!-- 
	var obj = 'window.location.replace("/www/Espace_perso/Messagerie");'; 
	setTimeout(obj,3000); 
	// --> 
</script>
	<p>
		<?php echo anchor('Espace_perso/Messagerie','Voir sa messagerie'); ?>
	</p>

</div>
</html>