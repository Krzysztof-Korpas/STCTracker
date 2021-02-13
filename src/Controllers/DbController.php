<?php

namespace STCoresTracker\Controllers;

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

    public function Select(string $what = null, string $from, string $whare = "1=1")
    {

        $what = htmlspecialchars($what, ENT_QUOTES);
        $what = $what ?? "*";
        $whare = $whare ?? '1';

        $sql = "SELECT $what FROM $from WHERE ?";
        $query = $this->db->prepare($sql);
        $query->execute([$whare]);
        $response = $query->fetchAll(\PDO::FETCH_ASSOC);

        return $response;
    }

    public function Insert(string $InTo, array $Data)
    {
        $TempArrayOfColumns = [];
        $sub1 = "";
        $sub2 = "";
        $TempSql = "DESCRIBE $InTo";
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

        $sql = "INSERT INTO $InTo ($sub1) VALUES ($sub2)";

         $query = $this->db->prepare($sql);
        if(!$query->execute()){
            echo "Insert not working \n";
            print_r($query->errorInfo());
            return false;
        }else{
           

            return true;
        }
        
        //echo $sql;
    }

    public function DbReturn()
    {
        return $this->db;
    }
}
