<?php
namespace App;

require('model/Autoloader.php');
Autoloader::register();

class HomeController{

    /**
     * show all News
     */
    public static function listnews()
    {
        $newManager = new PostsManager(); // création de l'objet
        $news = $newManager->getPosts(5,0); // appel d'une fonction de cet objet pour récup les news 

        require("view/frontend/listnewsView.php");
    }

    /**
     * show a News
     * @param int $newsId
     */
    public static function post($newsId)
    {
        $newManager = new PostsManager();
        $commentManager = new CommentManager();
        $post = $newManager->getPost($newsId);
        $comments = $commentManager->getComments($newsId);

        require('view/frontend/newsView.php');
    }
      

    /**
     * add comment
     * 
     * @param int $id
     * @param string $body
     */
    public static function postComment($newsId,$body)    
    {        
        $err=0;
        if(empty($body))
        {                   
            $err=1;
        }else{
            $body = htmlspecialchars($body);
        }
        if(empty($newsId))
        {
            $err=2;
        }
     
        if($err==0)
        {
            $commentManager = new CommentManager();
            $affectedLines = $commentManager->postComment($newsId,$body);
            if($affectedLines === false){
                throw new \Exception('Impossible d\'ajouter le commentaire !');
            }else{
                header("LOCATION:index.php?action=post&id=".$newsId);
            }
        }else{
            header("LOCATION:index.php?action=post&id=".$newsId."&err=".$err);
        }
        
    }

    /**
     * delete comment
     * 
     * @param int $id
     * @param string $body
     */
    public static function deleteComment($id,$comment)
    {
        $commentManager = new CommentManager();
        $comment = $commentManager->deleteComment($id, $comment);
        header('Location: index.php?action=post&id='.$id);
        exit();
        // die();
    }

    public static function forbidden()
    {
        require("view/frontend/forbiddenView.php");
    }
}