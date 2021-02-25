<?php

namespace STCoresTracker\Console;
use STCoresTracker\Controllers\LoginController as Ulogin;

class Login extends Command{
    public static function execute($string){
        $login = new Ulogin();
        if($login->login($string,null)){
            Display::execute('Login successfully');
        }else{
            Display::execute('Wrong password or email address');
        }
    }

    public static function help(){
        return  "Login user to his accout \n \nexaple: Login email@exaple.com password";
     
    }
    
}