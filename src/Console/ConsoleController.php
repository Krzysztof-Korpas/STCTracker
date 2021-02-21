<?php

namespace STCoresTracker\Console;


class ConsoleController
{
   

    public  function __construct()
    {
                
        $input = "";
        while (true) {


            $input = readline();

            $tempInput = explode(' ', $input, 2);
            $Instruction = ucfirst($tempInput[0]);
            if (!empty($tempInput[0])) {

                $Instruction = 'STCoresTracker\Console\\'.$Instruction;
                if(Class_exists($Instruction)){
                    $Instruction::execute($tempInput[1]??null);
                }else{
                    Display::execute($tempInput[0]."no exist");
                } 
                               
            }
        }
    }
}
