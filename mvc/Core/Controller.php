<?php

class Controller{

    public function model($model){
        //kiểm tra xem có file để require
        require_once "./mvc/Models/".$model.".php";
        return new $model;
    }

    public function view($view,$data=[]){
        require_once "./mvc/Views/".$view.".php";
    }

}

?>