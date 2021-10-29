<?php
     class db{
         private $dbHost ='us-cdbr-east-04.cleardb.com';
         private $dbUser ='bc130be0438b5c';
         private $dbPass ='056d9859';
         private $dbname ='heroku_c10c0df37b6ef9c';
         //conexionysql
         public function conectDB(){
            $mysqlConnect = "mysql:host=$this->dbHost;dbname=$this->dbname";

        $dbConeccion = new PDO($mysqlConnect,$this->dbUser,$this->dbPass);

$dbConeccion-> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
return $dbConeccion;
                     }
     }