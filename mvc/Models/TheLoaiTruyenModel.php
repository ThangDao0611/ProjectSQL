<?php

class TheLoaiTruyenModel extends db{

    public function TheLoaiTruyen(){
        $query = "SELECT * FROM TheLoaiTruyen ";
        $getResult = $this->conn->prepare($query); // chuẩn bị câu lệnh
        $getResult->execute(); // Thực thi câu lệch

        $result = $getResult->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function AddTheLoai($id,$theloai,$soluong){
        for($i=0;$i<$soluong;$i++){
            $query = "INSERT INTO TheLoaiTruyen VALUES('$id',N'$theloai[$i]')";
            $getResult = $this->conn->prepare($query); // chuẩn bị câu lệnh
            // Thực thi câu lệch
            $getResult->execute(); 
        }
       
    }

}

?>