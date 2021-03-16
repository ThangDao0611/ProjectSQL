<?php

class BinhLuanModel extends db{

    public function BinhLuan($id){
        $query = "SELECT * FROM BinhLuan WHERE Id = '$id'";
        $getResult = $this->conn->prepare($query); // chuẩn bị câu lệnh
        $getResult->execute(); // Thực thi câu lệch

        $result = $getResult->fetchAll(PDO::FETCH_ASSOC);

        return $result; 
    }

    public function ThemBinhLuan($time,$username,$id,$binhluan){
        $query = "INSERT INTO BinhLuan VALUES ($time,'$username','$id',N'$binhluan')";
        $getResult = $this->conn->prepare($query); // chuẩn bị câu lệnh
        $getResult->execute(); // Thực thi câu lệch
    }
    
    public function XoaBinhLuan($time,$username,$id){
        $query = "DELETE FROM BinhLuan WHERE ThoiGian = $time AND TenTaiKhoan =  '$username' AND Id = '$id'";
        $getResult = $this->conn->prepare($query); // chuẩn bị câu lệnh
        $getResult->execute(); // Thực thi câu lệch
    }

    public function TongBinhLuan($id){
        $query =  "SELECT COUNT(ThoiGian) AS count FROM BinhLuan  WHERE Id = '$id' GROUP BY Id";
        $getResult = $this->conn->prepare($query); // chuẩn bị câu lệnh
        $getResult->execute(); // Thực thi câu lệch

        $result = $getResult->fetchAll(PDO::FETCH_ASSOC);

        return $result; 
    }

}

?>