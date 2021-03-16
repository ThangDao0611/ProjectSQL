<?php

class UserModel extends db{

    public function InsertUser($username,$password){
        $query = "INSERT INTO TaiKhoan VALUES ('$username','$password')";
        $getResult = $this->conn->prepare($query); // chuẩn bị câu lệnh

        $result = false;

        if($getResult->execute()){
            $result = true;
        } // Thực thi câu lệch

        return $result;
    }

    public function CheckUser($username,$password){
        $query = "SELECT * FROM TaiKhoan WHERE TenTaiKhoan = '$username' ";
        $getResult = $this->conn->prepare($query); // chuẩn bị câu lệnh
        $getResult->execute();
        $result = $getResult->fetchAll(PDO::FETCH_ASSOC);
        if(isset($result[0]["MatKhau"])){
            return $result[0]["MatKhau"];
        }
        else{
            return "error";
        }
    }

    public function GetUser(){
        $query = "SELECT * FROM TaiKhoan";
        $getResult = $this->conn->prepare($query); // chuẩn bị câu lệnh
        $getResult->execute();
        $result = $getResult->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function DeleteUser($username){
        $query = "DELETE FROM TaiKhoan WHERE TenTaiKhoan = '$username'";
        $getResult = $this->conn->prepare($query); // chuẩn bị câu lệnh
        $getResult->execute();
    }

    public function SearchUser($username){
        $query = "SELECT * FROM TaiKhoan WHERE TenTaiKhoan LIKE '%$username%' ";
        $getResult = $this->conn->prepare($query); // chuẩn bị câu lệnh
        $getResult->execute();
        $result = $getResult->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
  
}

?>