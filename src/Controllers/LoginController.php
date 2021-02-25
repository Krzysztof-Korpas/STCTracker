<?php

namespace STCoresTracker\Controllers;

class LoginController{
    
  
    public static function Login($Login,$Password){
       $_SESSION['login']=$Login;
       return true;
    }

    public static function Register(){

    }

    public static function RestorePassword(){

    }

     
}