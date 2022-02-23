<?php $title = 'Optimy Assignment'; ?>

<?php ob_start(); ?>

<h1>Assigment for Optimy</h1>
<p>Dernières news du blog : </p>

<?php foreach($news as $post): ?>
    <div class="news">
        <h3>
            <a href="<?= $post->getURL() ?>"><?= $post->title; ?> </a>
            <em>le <?= $post->created_at_fr ?></em>
        </h3>
        <p>
            <?= $post->getExtrait() ?>
        </p>
    </div>

<?php endforeach; ?>

<?php $body = ob_get_clean(); ?>

<?php require("template.php"); ?>