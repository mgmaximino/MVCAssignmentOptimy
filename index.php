<?php
namespace App;
require('controller/HomeController.php');

// $forbidden = HomeController::forbidden();

try{
    if(isset($_GET['action']))
    {
        if($_GET['action']=="listPost")
        {
            // controller
            HomeController::listnews();
        }elseif($_GET['action']=="post")
        {
            if(isset($_GET['id']) && $_GET['id'] > 0)
            {
                HomeController::post($_GET['id']);
            }else{
                // error 
                throw new \Exception('Aucun identifiant de news à été donné');
            }
        }elseif($_GET['action']=="comment"){
            if(isset($_GET['id']) && $_GET['id'] > 0)
            {
                $commentId=htmlspecialchars($_GET['id']);
                HomeController::comment($commentId);
            }else{
                throw new \Exception('Aucun identifiant de commentaire envoyé');
            }
        }elseif($_GET['action']=="postcomment")
        {
            if(isset($_GET['id']) && $_GET['id'] > 0)
            {
                if(isset($_POST['comment']))
                {                  
                   HomeController::postComment($_GET['id'],$_POST['comment']);                                       
                }else{
                   HomeController::forbidden();
                }
            }
        }elseif($_GET['action']=="deletecomment")
        {
            if(isset($_GET['id']) && $_GET['id'] > 0)
            {
                if(isset($_GET['comment']))
                {
                    HomeController::deleteComment($_GET['id'],$_GET['comment']); 
                }else{
                    HomeController::forbidden();
                }
            }else{
                throw new \Exception('Aucun identifiant de commentaire envoyé');
            }
        }
        else{
            throw new \Exception('La page : <strong>'.$_GET['action'].'</strong> n\'existe pas');
        }
    }else{
        // controller
        HomeController::listnews();
    }
}catch(\Exception $e){
    $errorMessage = $e->getMessage();
    require("view/frontend/errorView.php");
}