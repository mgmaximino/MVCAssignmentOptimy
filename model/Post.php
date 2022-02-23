<?php
namespace App;

class Post{
    public function getURL(){
        return 'index.php?action=post&id='.$this->id;
    }

    public function getExtrait(){
        $texte = strip_tags($this->body);
        // display 'Show more...' if >20 caracters
        if(preg_match('#(\w+\W+){20}\w+#s',$texte, $out)){
            $html = "<div>".$out[0]."...<a href='".$this->getURL()."'>Show more...</a></div>";
        }else{
            $html = "<div>".$texte."</div>";
        }
        return $html;
    }
}