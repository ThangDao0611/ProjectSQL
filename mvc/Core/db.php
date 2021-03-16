<?php

class db{
    public $conn;
    protected $servername = "localhost";
    protected $username = "thang";
    protected $password = "123456";
    protected $database = "demo1";

    function __construct(){
         //try{

             $this->conn = new PDO("sqlsrv:Server=DESKTOP-GKVR0TD\SQLEXPRESS;Database=".$this->database."",$this->username,$this->password);
           // $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); // tạo biến lỗi nếu có
            
             /*}
             catch(PDOException $exception){
                 // In biến lỗi nếu có
                  Log.d($exception->getMessage()) ;
                 exit;
             }*/
    }
    }
?>