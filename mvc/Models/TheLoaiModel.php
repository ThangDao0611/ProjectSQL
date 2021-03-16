<?php

class TheLoaiModel extends db{

    public function TheLoai(){
        $query = "SELECT * FROM TheLoai";
        $getResult = $this->conn->prepare($query); // chuẩn bị câu lệnh
        $getResult->execute(); // Thực thi câu lệch

        $result = $getResult->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function TongSoTheLoai(){
        $query = "SELECT COUNT(TenTheLoai) AS Tong FROM TheLoai";
        $getResult = $this->conn->prepare($query); // chuẩn bị câu lệnh
        $getResult->execute(); // Thực thi câu lệch

        $result = $getResult->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

  
}

?>