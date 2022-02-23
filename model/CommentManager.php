<?php
namespace App;

use \PDO;

class CommentManager extends RepositoryManager{

    /** 
     * get comments
     * @param int $newsId
     * 
     */
    public function getComments($newsId){
        $statement = "SELECT id, body, DATE_FORMAT(created_at,'%d/%m/%Y à %Hh%imin%ss') AS created_at_fr FROM comment WHERE news_id=? ORDER BY created_at DESC";
        $comments = $this->dbConnect()->prepare($statement);
        $comments->execute([$newsId]);
        $datas = $comments->fetchall(PDO::FETCH_OBJ);
        $comments->closeCursor();
        return $datas;
    }
/**
 * get comment
 * @param int $commentId
 */
    public function getComment($commentId)
    {
        $statement = "SELECT id, body, news_id, DATE_FORMAT(created_at,'%d/%m/%Y à %Hh%imin%ss') as created_at_fr FROM comment WHERE id=?";
        $comment = $this->dbConnect()->prepare($statement);
        $comment->execute([$commentId]);
        $comment->setFetchMode(PDO::FETCH_OBJ);
        $data = $comment->fetch();
        $comment->closeCursor();
        return $data;
    }

    /**
     * 
     * post comment
     * @param int $newsId
     * @param string $body
     * 
     */
    public function postComment($newsId, $body)
    {
        $statement = "INSERT INTO comment(news_id,body,created_at) VALUES(:myid,:body,NOW())";
        $insert = $this->dbConnect()->prepare($statement);
        $affectedLines = $insert->execute([
            "myid"=>$newsId,            
            "body"=>$body
        ]);
        $insert->closeCursor();
        return $affectedLines;
    }

/**
 * delete comment
 * @param int $id
 * @param int $comment
 * 
 */
    public function deleteComment($id, $comment)
    {
        $statement = "DELETE FROM comment WHERE news_id=:newsId AND id=:commentId";
        $comments = $this->dbConnect()->prepare($statement);
        $affectedCom = $comments->execute([               
            "newsId"=>$id,       
            "commentId"=>$comment
        ]);
        $comments->closeCursor();
        return $affectedCom;
    }

}