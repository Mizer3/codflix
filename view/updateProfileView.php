<?php ob_start(); ?>

<div>
    <h1>Modifier mon profile</h1>
    <?php if($user_data): ?>
        <form method="post" action="index.php?action=updateProfile">

            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="<?= $user_data['email'] ?>">
            </div>

            <div>
                <label for="password">Ancien mot de passe</label>
                <input type="password" name="old-password" id="old-password">
            </div>

            <div>
                <label for="password">Nouveau mot de passe</label>
                <input type="password" name="new-password" id="new-password">
            </div>

            <div>
                <label for="password_confirm">Confirmer le nouveau mot de passe</label>
                <input type="password" name="password_confirm" id="password_confirm">
            </div>

            <button type="submit">Modifier</button>

            <span class="error-msg">
                <?= isset( $error_msg ) ? $error_msg : null; ?>
            </span>
        </form>
    <?php else : ?>
        <p>WALOUUUUUUUUUUU</p>
    <?php endif ?>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>