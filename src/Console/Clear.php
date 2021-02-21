<?php

namespace STCoresTracker\Console;

class Clear extends Command{
    public  function execute($string){
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            system('cls');
        } else {
            system('clear');
        }
    }
}