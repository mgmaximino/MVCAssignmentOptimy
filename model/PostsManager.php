<?php
namespace App;
use \PDO;

class PostsManager extends RepositoryManager{
    /**
     * get all posts
     * @param $limit
     * @param $offset
     */
    public function getPosts($limit=null, $offset=null){

        if(is_null($limit))
        {
            $statement="SELECT id,title, body, DATE_FORMAT(created_at, '%d/%m/%Y à %Hh%imin%ss') AS created_at_fr FROM news ORDER BY created_at DESC LIMIT 0,5";
        }else{
            if(is_null($offset))
            {
                $statement="SELECT id,title, body, DATE_FORMAT(created_at, '%d/%m/%Y à %Hh%imin%ss') AS created_at_fr FROM news ORDER BY created_at DESC LIMIT ".$limit;
            }else{
                $statement="SELECT id,title, body, DATE_FORMAT(created_at, '%d/%m/%Y à %Hh%imin%ss') AS created_at_fr FROM news ORDER BY created_at DESC LIMIT ".$offset.",".$limit;
            }
        }

        $req = $this->dbConnect()->query($statement);
        $datas = $req->fetchall(PDO::FETCH_CLASS,'App\Post');
        $req->closeCursor();
        return $datas;
    }

    /**
     * get one post
     * @param int $newsId
     */
    public function getPost($newsId)
    {
        $statement = "SELECT id, title, body, DATE_FORMAT(created_at, '%d/%m/%Y à %Hh%imin%ss') AS created_at_fr FROM news WHERE id = ?";
        $req = $this->dbConnect()->prepare($statement);
        $req->execute([$newsId]);
        $req->setFetchMode(PDO::FETCH_OBJ);
        $data = $req->fetch();
        $req->closeCursor();
        return $data;
    }
    

}
