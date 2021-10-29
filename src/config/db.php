<?php
     class db{
         private $dbHost ='localhost';
         private $dbUser ='root';
         private $dbPass ='';
         private $dbname ='API';
         //conexionysql
         public function conectDB(){
            $mysqlConnect = "mysql:host=$this->dbHost;dbname=$this->dbname";

        $dbConeccion = new PDO($mysqlConnect,$this->dbUser,$this->dbPass);

$dbConeccion-> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
return $dbConeccion;
                     }
     }