<?php
namespace STCoresTracker\Console;

class Close extends Command{



    public static function execute($string){
        die();
    }

    public static function help(){
        return "Is closing connsole interface and terminate operations";
    }

}