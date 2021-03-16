<?php

class manga extends Controller{

    // tạo biến construct và biến tổng cho model

    public $TruyenModel;
    public $TuTruyenModel;
    public $BinhLuanModel;
    public $DangDocModel;
    public $BanModel;
    public $TheLoaiTruyenModel;

    Public function __construct(){
            $this->TruyenModel = $this->model("TruyenModel");
            $this->TuTruyenModel = $this->model("TuTruyenModel");
            $this->BinhLuanModel = $this->model("BinhLuanModel");
            $this->DangDocModel = $this->model("DangDocModel");
            $this->BanModel = $this->model("BanModel");
            $this->TheLoaiTruyenModel = $this->model("TheLoaiTruyenModel");
    }

    function action(){

       
        //echo "This is action";
    }

    function read($TenSach,$SoChuong){
       
        $result = $this->TruyenModel->GetId($TenSach);
        
        
        $rid = $result[0]["Id"];
        $id = ltrim($rid,"S");
        $TongChuong = count(scandir("Data/Big Data/".$id."/"))-2; // Vì scandir đếm thừa 2 file . ..

        $link="./Data/Big Data/".$id."/".$id."-".$SoChuong.".html";

        if(file_exists($link)==false){
            header("location: http://localhost:81/Project/home/");
            exit;
        }

        $comment = $this->BinhLuanModel->BinhLuan($rid);
        $comment = array_reverse($comment);

        $comment_total = $this->BinhLuanModel->TongBinhLuan($rid);
        
        $checkban=123;
        
        if(isset($_SESSION["username"])){
            if($this->DangDocModel->CheckDoc($rid,$_SESSION["username"])==false){
                $this->DangDocModel->ThemDangDoc($rid,$_SESSION["username"]);
            }
            else{
                $this->DangDocModel->UpdateDangDoc($rid,$_SESSION["username"],$SoChuong);
            }
            if($this->BanModel->CheckBan($_SESSION["username"])==false){
                $checkban=0;
            }
            else {
                $checkban=1;
            }
        }

        $this->view("main3",["page"=>"display_manga",
        "link"=>$link,
        "Id"=>$result[0]["Id"],
        "TenSach"=>$TenSach,
        "SoChuong"=>$SoChuong,
        "TongChuong"=>$TongChuong,
        "BinhLuan"=>$comment,
        "TongBinhLuan"=>$comment_total,
        "Ban"=>$checkban
        ]);

    }

    function CommentList($TenSach,$page){
        $result = $this->TruyenModel->GetId($TenSach);
        $rid = $result[0]["Id"];
        $id = ltrim($rid,"S");
        $comment = $this->BinhLuanModel->BinhLuan($rid);
        $comment = array_reverse($comment);
        $comment_total = $this->BinhLuanModel->TongBinhLuan($rid);

        $this->view("main3",["page"=>"comment_list",
        "BinhLuan"=>$comment,
        "TongBinhLuan"=>$comment_total,
        "Page"=>$page,
        "TenSach"=>$TenSach
        ]);
    }

    function ThemVaoTuTruyen($username,$id){
        $result = $this->TuTruyenModel->ThemTruyenVaoTu($username,$id);
        $_SESSION["kqAddTruyen"]=$result;
        $name = $this->TruyenModel->GetName($id);
        header("location: http://localhost:81/Project/home/truyen/".$name[0]["TenTruyen"]."");
    }

    function ThemBinhLuan($id){
        if(!isset($_SESSION["username"])){
            header("location: http://localhost:81/Project/login/");
            exit;
        }
        if(isset($_SESSION["username"]) && $this->BanModel->CheckBan($_SESSION["username"])==false){

        
        $binhluan = $_POST["comment"];
        $binhluan = trim($binhluan);
        if(strlen($binhluan)==0){
            header("location:javascript://history.go(-1)");
        }
        else{
        $timestamp = time()+21600;
        $username = $_SESSION["username"];
        $this->BinhLuanModel->ThemBinhLuan($timestamp,$username,$id,$binhluan);
        header("location:javascript://history.go(-1)");
            }
        }
        else{
            header("location:javascript://history.go(-1)");
        }
    }

    function XoaBinhLuan($time,$username,$id){
        if(!isset($_SESSION["Admin"])){
            header("location: http://localhost:81/Project/home/");
        }
       
        $this->BinhLuanModel->XoaBinhLuan($time,$username,$id);
        header("location:javascript://history.go(-1)");
        
    }


}

?>