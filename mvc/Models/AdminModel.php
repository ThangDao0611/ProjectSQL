<?php

class AdminModel extends db{

    public function CheckAdmin($username){
        $query = "SELECT * FROM Admin WHERE  TenTaiKhoan = '$username'";
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

    
    
}

?>