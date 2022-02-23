<?php $title = 'Optimy - error 403' ?>
<?php header('HTTP/1.0 403 Forbidden');  ?>
<?php ob_start(); ?>
<h1>error 403</h1>
<p>Vous n'avez pas accès à cette ressource</p>


<?php $body = ob_get_clean() ?>
<?php require("template.php") ?>