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
            $Instruction = $tempInput[0];
            if (!empty($tempInput[0])) {

                Clear::execute($Instruction);
                $response = (STCoresTracker\Console\$Instruction::execute($tempInput[1] ?? null));
            }
        }
    }
}
