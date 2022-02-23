<?php
namespace App;

/**
 * Class Autoloader
 * @package App
 */
class Autoloader{
    /**
     * Enregistrer notre autoloader
     *
     */
    static function register(){
        spl_autoload_register([__CLASS__,'autoload']);
    }

    /**
     * Inclue le fichier correspondant à la classe
     *
     * @param string $class le nom de la classe à charger
     */
    static function autoload($class){
        if(strpos($class, __NAMESPACE__.'\\') === 0)
        {
            $class = str_replace(__NAMESPACE__.'\\','',$class);
            $class = str_replace('\\','/',$class);
            require __DIR__.'/'.$class.'.php';
        }
    }


}