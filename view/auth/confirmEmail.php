<?php ob_start(); ?>

<div class="landscape">
  <div class="bg-black">
    <div class="row no-gutters">
      <div class="col-md-6 full-height bg-white">
        <div class="auth-container">
          <h2><span>Cod</span>'Flix</h2>
          <h3>Validation Email</h3>

            <div class="form-group">
              <div class="row">
                <div class="col-md-6">
                  <a href="index.php?action=confirmEmail" class="btn btn-block bg-blue">Valider Email</a>
                </div>
              </div>
            </div>

            <span class="error-msg">
              <?= isset( $error_msg ) ? $error_msg : null; ?>
            </span>
          </form>
        </div>
      </div>
      <div class="col-md-6 full-height">
        <div class="auth-container">
          <h1>Bienvenue sur Cod'Flix !</h1>
        </div>
      </div>
    </div>
  </div>
</div>



<?php $content = ob_get_clean(); ?>

<?php require( __DIR__ . '/../base.php'); ?>