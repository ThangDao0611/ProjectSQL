<?php

class App{
    //http://localhost:81/home/action/1/2/3
    protected $controller="home";
    protected $action="action";
    protected $param=[];

    function __construct()
    {
            $arr = $this->UrlProcess();
            //Array ( [0] => home [1] => action [2] => 1 [3] => 2 [4] => 3 )

            //Xử lý Controller home
            if(isset($arr)){
                if(file_exists("./mvc/Controller/".$arr[0].".php")){
                    $this->controller=$arr[0];
                    unset($arr[0]);
            }}
            require_once "./mvc/Controller/".$this->controller.".php";
            $this->controller = new $this->controller;

            // Xử lý action
            if(isset($arr[1])){
                if(method_exists($this->controller,$arr[1])){
                    $this->action = $arr[1];
                }
                unset($arr[1]);
            }
            
           // xử lý param
           $this->param = $arr?array_values($arr):[];

           call_user_func_array([$this->controller,$this->action],$this->param); // chạy hàm với giá trị param
        
    }

    function UrlProcess(){
        // tách url thành 1 mảng bằng dấu "/"
        if(isset($_GET["url"])){
            return explode("/",filter_var(trim($_GET["url"],"/")));           
        }

    }

}

?>