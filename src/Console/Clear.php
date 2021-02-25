<?php

namespace STCoresTracker\Console;

class Clear extends Command{
    public static function execute($string){
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            system('cls');
        } else {
            system('clear');
        }
    }

    public static function help(){
        return  "Clening screan\n";
     
    }
    
}