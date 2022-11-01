<?php
 class DB{
     private $host;
     private $login;
     private $password;
     public  $dbname;
     public  $connect;
     public  $result;

     /**
      * @param $host
      * @param $login
      * @param $password
      * @param $dbname
      */
     public function __construct($host, $login, $password, $dbname)
     {
         $this->host = $host;
         $this->login = $login;
         $this->password = $password;
         $this->dbname = $dbname;

         $this->connect = new mysqli($host,$login,$password,$dbname);
     }


    public function All($tablepract)
    {
        $this->result = $this->connect->query("SELECT * FROM  $tablepract");
        return $this;
    }

    public function WhereOne($tablepract, $where)
    {
        $this->result = $this->connect->query("SELECT * FROM $tablepract WHERE id=$where");
        return $this;
    }

     public function WhereAnd($tableName, $condition)
     {
         $this->result = $this->connect->query("SELECT * FROM " . $tableName . " where " . implode(' AND ', $condition));
         return $this;
     }
     public function getAll()
     {
         $arr = [];
         while ($row = $this->result->fetch_assoc()) {
             array_push($arr, $row);
         }
         return $arr;
     }

 }
$stas = new DB("localhost","root","","pract1");
var_dump($stas->WhereOne("tablepract","3")->getAll());
var_dump($stas->All("tablepract")->getAll());
var_dump($stas->WhereAnd("tablepract", ["text = 'ruski'"])->getAll());



