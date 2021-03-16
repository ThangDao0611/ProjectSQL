<?php

class TruyenModel extends db{

    public function Truyen(){
        $query = "SELECT * FROM Truyen";
        $getResult = $this->conn->prepare($query); // chuẩn bị câu lệnh
        $getResult->execute(); // Thực thi câu lệch

        $result = $getResult->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function TruyenLe($TenTruyen){
        $query = "SELECT * FROM Truyen WHERE TenTruyen = N'$TenTruyen' ";
        $getResult = $this->conn->prepare($query); // chuẩn bị câu lệnh
        $getResult->execute(); // Thực thi câu lệch

        $result = $getResult->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function GetId($TenTruyen){
        $query = "SELECT Id FROM Truyen WHERE TenTruyen = N'$TenTruyen' ";
        $getResult = $this->conn->prepare($query); // chuẩn bị câu lệnh
        $getResult->execute(); // Thực thi câu lệch

        $result = $getResult->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function GetName($id){
        $query = "SELECT TenTruyen FROM Truyen WHERE Id = '$id' ";
        $getResult = $this->conn->prepare($query); // chuẩn bị câu lệnh
        $getResult->execute(); // Thực thi câu lệch

        $result = $getResult->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function TimTruyen($TheLoai,$Ten){
        $query_ten = "SELECT * FROM Truyen WHERE (dbo.fChuyenCoDauThanhKhongDau(TenTruyen) LIKE N'%$Ten%') OR 
        (dbo.fChuyenCoDauThanhKhongDau(TacGia) LIKE N'%$Ten%')";
        if(count($TheLoai) == 0){
           $query=$query_ten;
        }
        if(count($TheLoai)==1){
            $query_theloai = "SELECT * FROM Truyen WHERE Id IN (SELECT Id FROM TheLoaiTruyen WHERE TenTheLoai LIKE N'%$TheLoai[0]%')";
            $query = $query_ten." INTERSECT ".$query_theloai;
        }
        else{
            $query = $query_ten;
            for($i=0;$i<count($TheLoai);$i++){
            $query_theloai = "SELECT * FROM Truyen WHERE Id IN (SELECT Id FROM TheLoaiTruyen WHERE TenTheLoai LIKE N'%$TheLoai[$i]%')";
            $query = $query." INTERSECT ".$query_theloai;
            }
        }
        $getResult = $this->conn->prepare($query); // chuẩn bị câu lệnh
        $getResult->execute(); // Thực thi câu lệch

        $result = $getResult->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function AddTruyen($id,$tentruyen,$tacgia,$hinhanh){
        $query = "INSERT INTO Truyen VALUES('$id',N'$tentruyen',N'$tacgia',N'$hinhanh')";
        $getResult = $this->conn->prepare($query); // chuẩn bị câu lệnh
        $getResult->execute(); // Thực thi câu lệch
    }

    public function CountId(){
        $query = "SELECT COUNT(Id) AS count_id FROM Truyen ";
        $getResult = $this->conn->prepare($query); // chuẩn bị câu lệnh
        $getResult->execute(); // Thực thi câu lệch

        $result = $getResult->fetchAll(PDO::FETCH_ASSOC);
        return $result[0]["count_id"];
    }

    public function TimTruyenId($Ten){
        $query = "SELECT * FROM Truyen WHERE (dbo.fChuyenCoDauThanhKhongDau(TenTruyen) LIKE N'%$Ten%') OR 
        (Id LIKE '%$Ten%')";
        $getResult = $this->conn->prepare($query); // chuẩn bị câu lệnh
        $getResult->execute(); // Thực thi câu lệch
        $result = $getResult->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function GetChapList($rid){
        $id = ltrim($rid,"S");
        $dir = "Data/Big Data/".$id."/";
        $total_chap = count(scandir($dir))-2; 
        $result = [];
        for($i=0;$i<$total_chap;$i++){
            if(file_exists($dir.$id."-".($i+1).".html")){

            $fp = fopen($dir.$id."-".($i+1).".html","r");

            $text = fgets($fp);
            if(empty($text)){
                $result[$i]= "";
            }
                else{

           
                    if( preg_match( '/<h2 (.*)<\/h2>/', $text, $match ) ) {
                        $result[$i] = strip_tags($match[0])."<br>";
                        }
                    
                    if(empty($result[$i])){
                            $result[$i]= "";
                    }
                    //$substring = strip_tags (substr($text,strpos($text,"<h2"),strpos($text,"</h2>")));
                
                    //$text = $this->strip($text);

                    //$result[$i] = $substring."<br>";
                    fclose($fp);
                }
            }
            else{
                $result[$i]= "";
            }
        }
        return $result;
    }


}

?>