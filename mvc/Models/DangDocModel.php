<?php

class DangDocModel extends db{

    public function CheckDoc($id,$username){
        $query = "SELECT * FROM DangDoc WHERE Id = '$id' AND TenTaiKhoan = '$username'";
        $getResult = $this->conn->prepare($query); // chuẩn bị câu lệnh
        $getResult->execute(); // Thực thi câu lệch

        $result = $getResult->fetchAll(PDO::FETCH_ASSOC);
        
        if(isset($result[0]["Id"])){
            return true;
        }
        else{
            return false;
        }
    }

    public function GetChuong($id,$username){
        $query = "SELECT SoChuong FROM DangDoc WHERE Id = '$id' AND TenTaiKhoan = '$username'";
        $getResult = $this->conn->prepare($query); // chuẩn bị câu lệnh
        $getResult->execute(); // Thực thi câu lệch

        $result = $getResult->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }

    public function ThemDangDoc($id,$username){
        $query = "INSERT INTO DangDoc VALUES('$id','$username',1)";
        $getResult = $this->conn->prepare($query); // chuẩn bị câu lệnh
        $getResult->execute(); // Thực thi câu lệch
    }

    public function UpdateDangDoc($id,$username,$sochuong){
        $query = "UPDATE DangDoc SET SoChuong = $sochuong WHERE Id = '$id' AND TenTaiKhoan = '$username'";
        $getResult = $this->conn->prepare($query); // chuẩn bị câu lệnh
        $getResult->execute(); // Thực thi câu lệch
    }

    
}

?>