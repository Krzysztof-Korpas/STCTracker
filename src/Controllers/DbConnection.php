<?php

namespace STCoresTracker\Controllers;

final class DbConnection{
    
    private $dbConnection;

    public function __construct(){
        $this->dbConnection = new PDO(getenv('ConnectionString'));
    }

    public function selcet(){

    }

    public function insert(){

    }

    public function update(){

    }

    public function delete(){

    }

    public function create(){

    }

    public function drop(){

    }

}