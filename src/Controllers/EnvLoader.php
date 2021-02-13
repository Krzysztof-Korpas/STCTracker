<?php
namespace STCoresTracker\Controllers;

class EnvLoader{


    protected string $Path;

    public function __construct(string $Path){
        if(!file_exists($Path)){
            throw new \InvalidArgumentException(sprintf('%s does not exist', $Path));
        }
        $this->Path = $Path;
    }

    
    public function GetDBConfig(){

        if(!is_readable($this->Path)){
            throw new \RuntimeException(sprintf('%s file is not readable', $this->Path));
        }

        $lines = file($this->Path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach($lines as $line){
            if(strpos(trim($line),'#')===0){
                continue;
            }

            list($name,$value)=explode('=',$line,2);
            $name = trim($name);
            $value= trim($value);

            if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
                putenv(sprintf('%s=%s', $name, $value));
                $_ENV[$name] = $value;
                $_SERVER[$name] = $value;
            }


        }

    }
}