<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use STCoresTracker\Controllers\LoginController;
use STCoresTracker\Controllers\EnvLoader;
use STCoresTracker\Controllers\DbController;

Final class LoginTest extends TestCase{


    public function testLogin(){
        (new EnvLoader('.env'))->GetDBConfig();
        $response =  LoginController::Login();
        $this->assertNull($response);
        
    }
    public function testDb(){
        (new EnvLoader('.env'))->GetDBConfig();
        $db = new DbController();
        $response = $db->SELECT('*','User');
        $this->assertIsArray($response);
        $this->assertNull($response);
    }
}