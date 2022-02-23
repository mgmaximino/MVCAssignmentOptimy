<?php $title = $post->title; ?>
<?php ob_start(); ?>

<h1>Assignment for Optimy</h1>
<div><a href="index.php">Retour à la liste des news</a></div>
<div class="news">
    <h3><?= $post->title ?></h3>
    <em>le <?= $post->created_at_fr ?></em>
    <div>
        <?= nl2br($post->body) ?>
    </div>
</div>

<h2>Commentaires</h2>
<form action="index.php?action=postcomment&id=<?= $post->id ?>" method="POST">
    <div class="form-group">
        <label for="com">Commentaire: </label>
        <textarea name="comment" id="com" cols="30" rows="10"></textarea>
    </div>
    <div class="form-group">
        <input type="submit" value="Envoyer">
    </div>
</form>


<?php foreach($comments as $comment): ?>  
    <div>le <?= $comment->created_at_fr ?></div>
    <div><?= nl2br($comment->body) ?></div>
    <form action="index.php?action=deletecomment&id=<?= $post->id ?>&comment=<?=$comment->id ?>" method="POST">
  
    <div class="form-group">
        <input type="submit" value="Supprimer">
    </div>
</form>

<?php endforeach; ?>

<?php $body = ob_get_clean() ?>

<?php require("template.php") ?>