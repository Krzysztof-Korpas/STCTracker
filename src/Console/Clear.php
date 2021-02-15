<?php

namespace STCoresTracker\Console;

class Clear{
    public static function execute($string){
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            system('cls');
        } else {
            system('clear');
        }
    }
}