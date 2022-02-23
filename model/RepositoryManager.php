<?php
namespace App;

use Exception;
use \PDO;

class RepositoryManager{
    private $db_name = "phptest";
    private $db_user = "root";
    private $db_pass = "";
    private $db_host = "localhost";


    private $bdd;

    protected function dbConnect(){
        if($this->bdd === NULL)
        {
            try{
                $bdd = new PDO('mysql:host='.$this->db_host.';dbname='.$this->db_name.';charset=utf8',$this->db_user,$this->db_pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
                $this->bdd = $bdd;
            }catch(Exception $e)
            {
                die('Erreur: '.$e->getMessage());
            }
        }
        return $this->bdd;
    }

}