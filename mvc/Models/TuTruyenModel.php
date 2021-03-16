<?php

class TuTruyenModel extends db{

    public function ThemTruyenVaoTu($username,$id){
        $query = "INSERT INTO TuTruyen VALUES ('$username','$id')";
        $getResult = $this->conn->prepare($query); // chuẩn bị câu lệnh

        $result = false;

        if($getResult->execute()){
            $result = true;
        }

        return json_encode($result);
    }
    public function CheckTruyen($username,$id){
        $query = "SELECT * FROM TuTruyen WHERE TenTaiKhoan = '$username' AND Id = '$id'";
        $getResult = $this->conn->prepare($query);
        $getResult->execute();
        $result = $getResult->fetchAll(PDO::FETCH_ASSOC);
        if(isset($result[0]["Id"])){
            return true;
        }
        else{
            return false;
        }
    }
    public function ListTruyen($username){
        $query = "SELECT * FROM Truyen WHERE Id IN (SELECT Id FROM TuTruyen WHERE TenTaiKhoan = '$username' ) ";
        $getResult = $this->conn->prepare($query); // chuẩn bị câu lệnh
        $getResult->execute(); // Thực thi câu lệch

        $result = $getResult->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
    public function XoaTruyenTrongTu($username,$id){
        $query = "DELETE FROM TuTruyen WHERE TenTaiKhoan = '$username' AND Id = '$id' ";
        $getResult = $this->conn->prepare($query); // chuẩn bị câu lệnh
        $getResult->execute(); // Thực thi câu lệch
    }

}

?>