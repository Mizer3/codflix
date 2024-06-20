<?php ob_start(); ?>

<div>

    <?php if($mediaById): ?>
            <h1><?= $mediaById['title'] ?></h1>
            <div class="video">
                <iframe allowfullscreen="" frameborder="0" src="<?= $mediaById['trailer_url']; ?>"></iframe>
            </div>
            <p><span>Date de sortie : </span> <?= $mediaById['release_date'] ?></p>
            <p><span>Synopsis : </span><?= $mediaById['summary'] ?></p>
    <?php else : ?>
        <p>WALOUUUUUUUUUUU</p>
    <?php endif ?>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>