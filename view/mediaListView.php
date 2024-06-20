<?php ob_start(); ?>

<div class="row">
    <div class="col-md-4 offset-md-8">
        <form method="get" id="search-form" action="index.php">
            <div class="form-group has-btn">
            <input type="hidden" name="action" value="searchMedia">
                <input type="search" id="search" name="title" value="<?= $search; ?>" class="form-control"
                        placeholder="Rechercher un film ou une série">
                <button type="submit" class="btn btn-block bg-red">Valider</button>
            </div>
        </form>
    </div>
</div>

<div class="media-list">
    <?php foreach( $medias as $media ): ?>
        <a class="item" href="index.php?action=media&id=<?= $media['id']; ?>">
            <div class="video">
                <div>
                    <iframe allowfullscreen="" frameborder="0"
                            src="<?= $media['trailer_url']; ?>" ></iframe>
                </div>
            </div>
            <div class="title"><?= $media['title']; ?></div>
        </a>
    <?php endforeach; ?>
</div>

<!-- <script src="public/js/mediaResearch.js"></script> -->


<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
