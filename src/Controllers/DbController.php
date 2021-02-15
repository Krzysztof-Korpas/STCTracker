<?php

namespace STCoresTracker\Controllers;

use PHPUnit\Framework\Constraint\Count;

class DbController
{

    protected $db;

    public function __construct()
    {
        $dsn = getenv("DbDns");
        $User = getenv("DbUser");
        $Pass = getenv("DbPassword");
        $this->db = new \PDO($dsn, $User, $Pass);
    }

    public function Select(string $what = null, string $Table, string $whare = "1=1")
    {

        $what = htmlspecialchars($what, ENT_QUOTES);
        $what = $what ?? "*";
        $whare = $whare ?? '1';

        $sql = "SELECT $what FROM $Table WHERE ?";
        $query = $this->db->prepare($sql);
        $query->execute([$whare]);
        $response = $query->fetchAll(\PDO::FETCH_ASSOC);

        return $response;
    }

    public function Insert(string $Table, array $Data)
    {
        $TempArrayOfColumns = [];
        $sub1 = "";
        $sub2 = "";
        $TempSql = "DESCRIBE $Table";
        $query = $this->db->prepare($TempSql);
        $query->execute();
        $response = $query->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($response as $item) {
            $TempArrayOfColumns[] = $item['Field'];
            if($sub1==""){
                $sub1 = "`" . $item['Field'] . "`";
            }else{
            $sub1 = $sub1 . ",`" . $item['Field'] . "`";
            }
        }
        foreach ($TempArrayOfColumns as $item) {
            if ($sub2 == "") {
                if (isset($Data[$item])) {
                    $sub2 = $Data[$item] . "'";
                } else {
                    $sub2 = "NULL";
                }
            } else {
                if (isset($Data[$item])) {
                    $sub2 = $sub2 . ",'" . $Data[$item] . "'";
                } else {
                    $sub2 = $sub2 . ",NULL";
                }
            }
        }

        $sql = "INSERT INTO $Table ($sub1) VALUES ($sub2)";

         $query = $this->db->prepare($sql);
        if(!$query->execute()){
          
            return false;
        }else{
           

            return true;
        }
      
    }

    public function Update(string $Table, array $Data,array $whare){

        $sql = "UPDATE `$Table` SET ";

        for($i=0;$i<count($Data);$i++){
            if($i>0){
                $sql = $sql.",";
            }
            $sql = $sql . "`".array_keys($Data)[$i]."` = '".$Data[array_keys($Data)[$i]]."'";
        }
        for($i=0;$i<count($whare);$i++){
            if($i==0){
                $sql = $sql." WHERE `".array_keys($whare)[$i]."`".$whare[array_keys($whare)[$i]][1]." ".$whare[array_keys($whare)[$i]][0];
            }else{
                if($i>0){
                    $sql = $sql.",";
                }
                $sql = $sql. $whare[array_keys($whare)[$i]][2] ." `".array_keys($whare)[$i]."` ".$whare[array_keys($whare)[$i]][1]." '".$whare[array_keys($whare)[$i]][0]."'";
            }
        }
    
     $query = $this->db->prepare($sql);
        if(!$query->execute()){
            
            
            return false;
        }else{
           

            return true;
        }
    }

    public function DbReturn()
    {
        return $this->db;
    }
}
