<?php ob_start(); ?>

<div>
    <h1>Mon Profil</h1>
    <?php if($user_data): ?>
        <div>
            <p><span>Email : </span> <?= $user_data['email'] ?></p>
        </div>
        <div>
            <a href="index.php?action=updateForm" class="btn btn-primary">Modifier mon profil</a>
        </div>
    <?php else : ?>
        <p>WALOUUUUUUUUUUU</p>
    <?php endif ?>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>