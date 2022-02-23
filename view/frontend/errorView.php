<?php $title = 'Optimy - error 404' ?>
<?php header("HTTP/1.1 404 Not Found");  ?>
<?php ob_start(); ?>
<h1>Error 404</h1>
<p><?= $errorMessage ?></p>


<?php $body = ob_get_clean() ?>
<?php require("template.php") ?>