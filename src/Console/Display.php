<?php

namespace STCoresTracker\Console;

class Display extends Command{
    
    public function execute($string){
        echo $string . "\n";
    }

}