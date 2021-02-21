<?php

namespace STCoresTracker\Console;

class Help extends Command
{

    public static function execute($string)
    {
        $list = scandir('./src/Console');
        $exeption = ['.', '..', 'ConsoleController.php', 'Command.php', 'Display.php'];
        if ($string == null) {
            foreach ($list as $item) {

                if (in_array($item, $exeption)) {
                    continue;
                }
                (new Display)->execute(explode('.', $item)[0]);
            }
        }else{
            $Instruction = 'STCoresTracker\Console\\'.$string;
            if(Class_exists($Instruction)&&method_exists($Instruction,'help')){
                Display::execute($Instruction::help());
            }else{
                Display::execute($string." have no help info");
            } 
        }
    }
}
