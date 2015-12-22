<!DOCTYPE HTML>

<div class="container">  
    
  <!-- <div id="html">
    <button data-toggle="modal" data-backdrop="false" href="#formulaire" class="btn btn-primary">Informations</button>
  </div> -->
  <div class="modal fade" id="formulaire">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">x</button>
          <h4 class="modal-title">Connectez vous :</h4>
        </div>
        <div class="modal-body">
          <?php echo validation_errors(); ?>
          <?php echo form_open('Utilisateur/verif_login'); ?> 
          Pas encore inscrit <a href="<?php echo site_url('Utilisateur/inscription') ?>">C'est par ici !</a>
          <br><br>
          <div>
            <label>
              Email : <?php echo str_repeat("&nbsp;", 16); ?>
              <input type="text" name="email" value="<?php echo set_value('email'); ?>" />
            </label>
            <?php echo form_error('email'); ?>
          </div>
          <br>
          <div>
            <label>
              Mot de passe :  <?php echo str_repeat("&nbsp;", 2); ?>
              <input type="password" name="mdp" />
            </label>
            <?php echo form_error('mdp'); ?>
          </div>
          <br>
          <div>
            <label>
              <input type="checkbox" name="remind_login" value="<?php echo set_value('remind_login'); ?>" /> se souvenir de moi !!!! NE MARCHE PAS POUR LE MOMENT !!!!
            </label>
            <?php echo form_error('remind_login'); ?>
          </div>
          <br>
          <p>
            <input type="submit" value="Connexion" />
            <a href="<?php echo site_url('Utilisateur/mdp_perdu') ?>"> <?php echo str_repeat("&nbsp;", 2);?> Mot de passe égaré ?</a>
          </p>
          <br>
        </form>


      </div>
      <div class="modal-footer">
        <button class="btn btn-info" data-dismiss="modal">Annuler</button>
      </div>
    </div>
  </div>
</div>
</div>


