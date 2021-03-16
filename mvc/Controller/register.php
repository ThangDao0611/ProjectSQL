<?php

class register extends Controller{

    // tạo biến construct và biến tổng cho model

    public $TruyenModel;
    public $UserModel;

    Public function __construct(){
            $this->TruyenModel = $this->model("TruyenModel");
            $this->UserModel = $this->model("UserModel");
    }
    

    function action(){

        $this->view("main1",["page"=>"register",
        "Truyen"=>$this->TruyenModel->Truyen()
        ]);

        //echo "This is action";
    }

    public function KhachHangDangKy(){
        //get data đăng ký
        $kq="false";

        if(isset($_SESSION["kqRegister"])){
            unset($_SESSION["kqRegister"]);
        }
        if(isset($_POST["btnRegister"])){
            $user = $_POST["user"];
            $pass = $_POST["pass"];

            $user = trim($user);
            $pass = trim($pass);

            if($user=="" || $pass=="" || strlen($user)>20 || strlen($pass)>20){
                $kq = "false";
            }
            else{
            $pass = password_hash($pass,PASSWORD_DEFAULT); // mã hóa theo bcrypt
        
                 //thêm vào database
            $kq =  $this->UserModel->InsertUser($user,$pass);
            }
        }
        //trả về thành công / thất bại

        $_SESSION["kqRegister"] = $kq;
        header("location: http://localhost:81/Project/register/");
       /* $this->view("main1",["page"=>"register",
        "Sach"=>$this->SachModel->Sach(),
        "kq"=>$kq
        ]);*/

    }}


?>