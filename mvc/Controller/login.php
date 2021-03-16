<?php

class login extends Controller{

    // tạo biến construct và biến tổng cho model

    public $TruyenModel;
    public $UserModel;
    public $AdminModel;

    Public function __construct(){
            $this->TruyenModel = $this->model("TruyenModel");
            $this->UserModel = $this->model("UserModel");
            $this->AdminModel = $this->model("AdminModel");
    }

    function action(){

        $this->view("main1",["page"=>"login",
        "Truyen"=>$this->TruyenModel->Truyen()
        ]);

       
    }
    public function SaveSession(){
        
        if (isset($_POST["btnLogin"])) {
            // lấy thông tin người dùng
            $username = $_POST["user"];
            $password = $_POST["pass"];

            $username = trim($username);
            //làm sạch thông tin, xóa bỏ các tag html, ký tự đặc biệt 
            //mà người dùng cố tình thêm vào để tấn công theo phương thức sql injection
            //$username = strip_tags($username);
            //$username = addslashes($username);
           // $password = strip_tags($password);
            //$password = addslashes($password);
        }
            /*if ($username == "" || $password =="") {
                $result=false;
            }else{
                
                if ($kq=true) {
                    
                }
            }*/
            //$result="false";
            $kq = $this->UserModel->CheckUser($username,$password);
            if(isset($_SESSION["ErrorLogin"])){
                unset($_SESSION["ErrorLogin"]);
            }
            if(password_verify($password,$kq)){
               // $result="true";
                $checkad = $this->AdminModel->CheckAdmin($username);
                if($checkad == true){
                    $_SESSION["Admin"]=true;
                }
                $_SESSION['username'] = $username;
                header("location: http://localhost:81/Project/home/");
                //$_SESSION["kqLogin"]=true;
            }
            else{
               // $result="false";
                $_SESSION["ErrorLogin"]=false;
                header("location: http://localhost:81/Project/login/");
            }
            /*$this->view("main1",["page"=>"login",
            "kq"=>$result
            ]);*/
    }

   /* public function test(){
        $username="b";
        $password="a";
        $kq = $this->UserModel->CheckUser($username,$password);
        
        if(password_verify($password,$kq)){
            echo "true";
        }
        else{
            echo "false";
        }

        echo "<br>";
        echo $password; echo "<br>";
        echo $kq;
        
    }*/

    
}

?>