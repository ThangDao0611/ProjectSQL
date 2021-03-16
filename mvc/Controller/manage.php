<?php

class manage extends Controller{

    // tạo biến construct và biến tổng cho model

    public $TruyenModel;
    public $UserModel;
    public $BanModel;

    Public function __construct(){
            $this->TruyenModel = $this->model("TruyenModel");
            $this->UserModel = $this->model("UserModel");
            $this->BanModel = $this->model("BanModel");
    }
    

    function action(){

        $result_ban = $this->BanModel->GetBan();
        $result=[];
        $i=0;
        foreach ($result_ban as $row) {
            
            $result[$i]=$row["TenTaiKhoan"];
            $i++;
        }

       
        $this->view("main1",["page"=>"manage",
        "TaiKhoan"=>$this->UserModel->GetUser(),
        "Ban"=>$result
        ]);

      
    }

    function search(){
        if(isset($_POST["btnSubmitUser"])){
            $username = $_POST["username_search"];
            $result_user = $this->UserModel->SearchUser($username);

            $result_ban = $this->BanModel->GetBan();
            $result=[];
            $i=0;
            foreach ($result_ban as $row) {
                
                $result[$i]=$row["TenTaiKhoan"];
                $i++;
            }

            $this->view("main1",["page"=>"search_user",
            "TaiKhoan"=>$result_user,
            "Ban"=>$result
            ]);
        }  
    }

    function delete($username){
        $this->UserModel->DeleteUser($username);
        header("location: http://localhost:81/Project/manage/");
    }

    function ban($username){
        if($this->BanModel->CheckBan($username)==true){
            header("location: http://localhost:81/Project/manage/");
        }
        else{
        $this->BanModel->AddBan($username);
        header("location: http://localhost:81/Project/manage/");
        }
    }

    function unban($username){
        if($this->BanModel->CheckBan($username)==false){
            header("location: http://localhost:81/Project/manage/");
        }
        else{
            $this->BanModel->DeleteBan($username);
            header("location: http://localhost:81/Project/manage/");
        }
        
    }

}


?>