<?php

class home extends Controller{

    // tạo biến construct và biến tổng cho model

    public $TruyenModel;
    public $TuTruyenModel;
    public $DangDocModel;
    public $TheLoaiTruyenModel;

    Public function __construct(){
            $this->TruyenModel = $this->model("TruyenModel");
            $this->TuTruyenModel = $this->model("TuTruyenModel");
            $this->DangDocModel = $this->model("DangDocModel");
            $this->TheLoaiTruyenModel = $this->model("TheLoaiTruyenModel");
    }

    function action(){


        $this->view("main1",["page"=>"display",
        "Truyen"=>$this->TruyenModel->Truyen(),
        "Tong"=>$this->TruyenModel->CountId(),
        "TheLoai"=>$this->TheLoaiTruyenModel->TheLoaiTruyen()
        ]);

        //echo "This is action";
    }

    function truyen($TenTruyen){
        $rid = $this->TruyenModel->GetId($TenTruyen);
        $id= $rid[0]["Id"];

        if(isset($_SESSION["username"])){
            $check=$this->TuTruyenModel->CheckTruyen($_SESSION["username"],$id) ;
            $checkdoc = $this->DangDocModel->CheckDoc($id,$_SESSION["username"]);
            if($checkdoc==true){
                $sochuong = $this->DangDocModel->GetChuong($id,$_SESSION["username"]);
            }
            else {
                $sochuong = 0;
            }
        }else{
            $check=false;
            $checkdoc=false;
            $sochuong = 0;
        }
        $this->view("main1",["page"=>"display_one",
        "Truyen"=>$this->TruyenModel->TruyenLe($TenTruyen),
        "Check"=>$check,
        "CheckDoc"=>$checkdoc,
        "SoChuongDangDoc"=>$sochuong,
        "ChapList"=>$this->TruyenModel->GetChapList($id),
        "TheLoai"=>$this->TheLoaiTruyenModel->TheLoaiTruyen()
        ]);
    }

    function page_chap($TenTruyen,$page){
        $rid = $this->TruyenModel->GetId($TenTruyen);
        $id= $rid[0]["Id"];

        if(isset($_SESSION["username"])){
            $check=$this->TuTruyenModel->CheckTruyen($_SESSION["username"],$id) ;
            $checkdoc = $this->DangDocModel->CheckDoc($id,$_SESSION["username"]);
            if($checkdoc==true){
                $sochuong = $this->DangDocModel->GetChuong($id,$_SESSION["username"]);
            }
            else {
                $sochuong = 0;
            }
        }else{
            $check=false;
            $checkdoc=false;
            $sochuong = 0;
        }
        $this->view("main1",["page"=>"display_one",
        "Truyen"=>$this->TruyenModel->TruyenLe($TenTruyen),
        "Check"=>$check,
        "CheckDoc"=>$checkdoc,
        "SoChuongDangDoc"=>$sochuong,
        "ChapList"=>$this->TruyenModel->GetChapList($id),
        "Page"=>$page
        ]);
    }

    function page($number){
        $this->view("main1",["page"=>"display",
        "Truyen"=>$this->TruyenModel->Truyen(),
        "Tong"=>$this->TruyenModel->CountId(),
        "TheLoai"=>$this->TheLoaiTruyenModel->TheLoaiTruyen(),
        "Page"=>$number
        ]);
    }

    function logout(){
        unset($_SESSION["username"]);
        if(isset($_SESSION["Admin"])){
            unset($_SESSION["Admin"]);
        }
        header("location: http://localhost:81/Project/home/");
    }

    function tutruyen(){
        $this->view("main1",["page"=>"display_tutruyen",
        "Truyen"=>$this->TuTruyenModel->ListTruyen($_SESSION["username"]),
        "TheLoai"=>$this->TheLoaiTruyenModel->TheLoaiTruyen()
        ]);
    }

    function xoatutruyen($id){
        $this->TuTruyenModel->XoaTruyenTrongTu($_SESSION["username"],$id);
        header("location: http://localhost:81/Project/home/tutruyen/");
    }

    /*function show($a,$b){

        //Model
        $teo = $this->model("SVmodel");
        $tong = $teo->Tong($a,$b);

        //View
        $this->view("AoDep",
        ["page"=>"new","number"=>$tong,"mau"=>"red",
        "SoThich"=>["A","B","C"],
        "SV" => $teo->SinhVien()
        ]); 
    }*/
}

?>