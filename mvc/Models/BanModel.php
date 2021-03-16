<?php

class BanModel extends db{

    public function CheckBan($username){
        $query = "SELECT * FROM CamBinhLuan WHERE  TenTaiKhoan = '$username'";
        $getResult = $this->conn->prepare($query); // chuẩn bị câu lệnh
        $getResult->execute(); // Thực thi câu lệch

        $result = $getResult->fetchAll(PDO::FETCH_ASSOC);
        
        if(isset($result[0]["TenTaiKhoan"])){
            return true;
        }
        else{
            return false;
        }
    }

    public function GetBan(){
        $query = "SELECT * FROM CamBinhLuan";
        $getResult = $this->conn->prepare($query); // chuẩn bị câu lệnh
        $getResult->execute(); // Thực thi câu lệch

        $result = $getResult->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
        }

        public function AddBan($username){
            $query = "INSERT INTO CamBinhLuan VALUES('$username')";
            $getResult = $this->conn->prepare($query); // chuẩn bị câu lệnh
            $getResult->execute(); // Thực thi câu lệch
        }
    
        public function DeleteBan($username){
            $query = "DELETE FROM CamBinhLuan WHERE TenTaiKhoan = '$username'";
            $getResult = $this->conn->prepare($query); // chuẩn bị câu lệnh
            $getResult->execute(); // Thực thi câu lệch
        }
    }


?>