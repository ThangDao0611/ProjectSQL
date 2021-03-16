<?php

class manage_manga extends Controller{

    // tạo biến construct và biến tổng cho model

    public $TruyenModel;
    public $UserModel;
    public $TheLoaiModel;
    public $TheLoaiTruyenModel;

    Public function __construct(){
            $this->TruyenModel = $this->model("TruyenModel");
            $this->UserModel = $this->model("UserModel");
            $this->TheLoaiModel = $this->model("TheLoaiModel");
            $this->TheLoaiTruyenModel = $this->model("TheLoaiTruyenModel");
    }
    

    function action(){

        $this->view("main1",["page"=>"add_manga",
        "TheLoai"=>$this->TheLoaiModel->TheLoai()
        ]);

      
    }

   

    function AddManga(){
        if(isset($_POST["btnsubmit_manga"])){
            $name_manga = trim($_POST["name_manga"]);
            $name_author = trim($_POST["name_author"]);

            $result_theloai = $this->TheLoaiModel->TongSoTheLoai();
            $tong = $result_theloai[0]["Tong"];
            $y=0;
            $theloai = [];
            
            for($i=1;$i<=$tong;$i++){
                if(isset($_POST["theloai".$i.""])){
                    $theloai[$y++] = trim($_POST["theloai".$i.""]);
                }
            }
            
            $theloai_s = $theloai[0];
            if(isset($theloai[1])){
                for($i=1;$i<count($theloai);$i++){
                    $theloai_s = $theloai_s.", ".$theloai[$i];
                }
            }
            // Kiểm tra có dữ liệu fileupload trong $_FILES không
            // Nếu không có thì dừng
            if (!isset($_FILES["fileupload"]))
                {
                    $_SESSION["kqUploadImg"]= "false";
                    header("location: http://localhost:81/Project/manage_manga/");
                }

                // Kiểm tra dữ liệu có bị lỗi không
            if ($_FILES["fileupload"]['error'] != 0)
                {
                    $_SESSION["kqUploadImg"]= "false";
                    header("location: http://localhost:81/Project/manage_manga/");
                }

            //Thư mục bạn sẽ lưu file upload
            $target_dir = "Data/img/";
            //Vị trí file lưu tạm trong server (file sẽ lưu trong uploads, với tên giống tên ban đầu)
            
            $target_file1   = $target_dir . basename($_FILES["fileupload"]["name"]);
            
            $allowUpload   = true;

                        //Lấy phần mở rộng của file (jpg, png, ...)
            $imageFileType = pathinfo($target_file1,PATHINFO_EXTENSION);
            
            //Đổi tên file
            $countid = $this->TruyenModel->CountId()+1;
            if($countid<100){
                $countid="0".$countid;
            }
            
            $target_file   = $target_dir .$countid.".".$imageFileType;
            
            
            // Cỡ lớn nhất được upload (bytes)
            $maxfilesize   = 800000;

            ////Những loại file được phép upload
            $allowtypes    = array('jpg', 'png', 'jpeg', 'gif');
            

            if(isset($_POST["submit"])) {
                //Kiểm tra xem có phải là ảnh bằng hàm getimagesize
                $check = getimagesize($_FILES["fileupload"]["tmp_name"]);
                if($check !== false)
                {
                   // echo "Đây là file ảnh - " . $check["mime"] . ".";
                    $allowUpload = true;
                }
                else
                {
                   // echo "Không phải file ảnh.";
                    $allowUpload = false;
                }
            }

            // Kiểm tra nếu file đã tồn tại thì không cho phép ghi đè
            // Bạn có thể phát triển code để lưu thành một tên file khác
            if (file_exists($target_file))
            {
               // echo "Tên file đã tồn tại trên server, không được ghi đè";
                $allowUpload = false;
            }
            // Kiểm tra kích thước file upload cho vượt quá giới hạn cho phép
            if ($_FILES["fileupload"]["size"] > $maxfilesize)
            {
               // echo "Không được upload ảnh lớn hơn $maxfilesize (bytes).";
                $allowUpload = false;
            }


            // Kiểm tra kiểu file
            if (!in_array($imageFileType,$allowtypes ))
            {
               // echo "Chỉ được upload các định dạng JPG, PNG, JPEG, GIF";
                $allowUpload = false;
            }

            
            
            if ($allowUpload)
            {
                if((!isset($theloai[0])) || empty($name_author) || empty($name_manga)){    
                    $_SESSION["kqUploadImg"]= "false";
                    header("location: http://localhost:81/Project/manage_manga/");
                }
                else{
                // Xử lý di chuyển file tạm ra thư mục cần lưu trữ, dùng hàm move_uploaded_file
                if (move_uploaded_file($_FILES["fileupload"]["tmp_name"], $target_file))
                {
                   
                    $id="S".$countid;
                    
                    $img="/img/".$countid.".".$imageFileType;
                    
                    $this->TruyenModel->AddTruyen($id,$name_manga,$name_author,$img);
                    $this->TheLoaiTruyenModel->AddTheLoai($id,$theloai,$y);

                    mkdir("Data/Big Data/".$countid);

                    $_SESSION["kqUploadImg"]= "true";
                    header("location: http://localhost:81/Project/manage_manga/");
                    
                }
                else
                {
                    $_SESSION["kqUploadImg"]= "false";
                    header("location: http://localhost:81/Project/manage_manga/");
                    //echo "Có lỗi xảy ra khi upload file.";
                }
                }
            }
            else
            {
                $_SESSION["kqUploadImg"]= "false";
                header("location: http://localhost:81/Project/manage_manga/");
                //echo "Không upload được file, có thể do file lớn, kiểu file không đúng ...";
            }

        }
    }

    function DisplayUpdateChap(){

        $this->view("main1",["page"=>"display_updatechap"
        ]);
    }

    function DislayUpdateChapList(){
        if(!isset($_POST["btnsubmit_update"]) || !isset($_POST["update_chap"])  || $_POST["update_chap"]=="null" || empty($_POST["name_update"])){
            header("location: http://localhost:81/Project/manage_manga/DisplayUpdateChap");
            die;
        }
        else{

            if($_POST["update_chap"]=="add_chap"){
                $action = "AddChap";
            }
            else{
                $action = "DeleteChap";
            }

            $result = $this->TruyenModel->TimTruyenId($_POST["name_update"]);

            $this->view("main1",["page"=>"display_chapforupdate",
            "Truyen"=>$result,
            "Action"=>$action,
            "TheLoai"=>$this->TheLoaiTruyenModel->TheLoaiTruyen()
            ]);
        }
    }

    function AddChap($TenTruyen){

        $rid = $this->TruyenModel->GetId($TenTruyen);
        $id = ltrim($rid[0]["Id"],"S");
        $chap = count(scandir("Data/Big Data/".$id."/"))-1;
        $this->view("main1",["page"=>"add_chap",
        "Chap"=>$chap,
        "Id"=>$rid[0]["Id"]
        ]);
    }

    function ActionAddChap($rid){
        if (($_SERVER['REQUEST_METHOD'] == 'POST') && (isset($_FILES['fileupload']))) {
    
        $files = $_FILES['fileupload'];
    
            $names      = $files['name'];
            $types      = $files['type'];
            $tmp_names  = $files['tmp_name'];
            $errors     = $files['error'];
            $sizes      = $files['size'];
            
            $id = ltrim($rid,"S");
            $name = $this->TruyenModel->GetName($rid);
            $target_dir = "Data/Big Data/".$id."/";

            
            

            $numitems = count($names);
            $numfiles = 0;
            for ($i = 0; $i < $numitems; $i ++) {
                //Kiểm tra file thứ $i trong mảng file, up thành công không
                if ($errors[$i] == 0)
                {
                    $target_file1 = $target_dir.basename($names[$i]);
                    $imageFileType = pathinfo($target_file1,PATHINFO_EXTENSION);
                    if($imageFileType != "html"){
                        $_SESSION["kqUploadFile"]=$numfiles;
                        header("location: http://localhost:81/Project/manage_manga/AddChap/".$name[0]["TenTruyen"]);
                        die;
                    }
                    //Code xử lý di chuyển file đến thư mục cần thiết ở đây (bạn tự thực hiện)
                    $numfiles++;
                    $chap = count(scandir("Data/Big Data/".$id."/"))-1;
                    $target_file   = $target_dir.$id."-".$chap.".html";

                    move_uploaded_file($tmp_names[$i],$target_file);

                    $_SESSION["kqUploadFile"]=$numfiles;
                    header("location: http://localhost:81/Project/manage_manga/AddChap/".$name[0]["TenTruyen"]);
                }
            }
        }
    }

    function DeleteChap($TenTruyen){
        $rid = $this->TruyenModel->GetId($TenTruyen);
        $id = ltrim($rid[0]["Id"],"S");
        $chap = count(scandir("Data/Big Data/".$id."/"))-2;
        $this->view("main1",["page"=>"delete_chap",
        "Chap"=>$chap,
        "Id"=>$rid[0]["Id"]
        ]);
    }

    function ActionDeleteChap($rid){
        $name = $this->TruyenModel->GetName($rid);
        if(isset($_POST["btnsubmit_delete"]) && isset($_POST["number"])){
            $chap = $_POST["number"];
            $id = ltrim($rid,"S");
            $target_dir = "Data/Big Data/".$id."/";

            if(isset($_FILES["fileupload"]) && !empty($_FILES["fileupload"]["name"]))
            {       
                $FileType = pathinfo($$target_dir.basename($_FILES["fileupload"]["name"]),PATHINFO_EXTENSION);
                if($FileType != "html"){
                    $_SESSION["kqDeleteFile"]="filetype";
                    header("location: http://localhost:81/Project/manage_manga/DeleteChap/".$name[0]["TenTruyen"]);
                    die;
                }
                $target_file   = $target_dir.$id."-".$chap.".html";
                //unlink("Data/Big Data/".$id."/".$id."-".$chap.".html");
                if(file_exists($target_file)){
                    unlink($target_file);
                    move_uploaded_file($_FILES["fileupload"]["tmp_name"],$target_file);
                    $_SESSION["kqDeleteFile"]="true haha";
                    header("location: http://localhost:81/Project/manage_manga/DeleteChap/".$name[0]["TenTruyen"]);
                }
                else{
                    $_SESSION["kqDeleteFile"]="false";
                    header("location: http://localhost:81/Project/manage_manga/DeleteChap/".$name[0]["TenTruyen"]);
                }
            }
            else{
                    $id = ltrim($rid,"S");
                    $chap = $_POST["number"];
                    $filename = "Data/Big Data/".$id."/".$id."-".$chap.".html";
                    $content = "<h2> Chương này đã bị xóa  </h2>\n";
                    if(!file_exists($filename)){
                        $_SESSION["kqDeleteFile"]="false";
                        header("location: http://localhost:81/Project/manage_manga/DeleteChap/".$name[0]["TenTruyen"]);
                       
                    }
                    if (is_writable($filename)) {
                        if (!$file= @fopen($filename,'w')) {
                            $_SESSION["kqDeleteFile"]="false";
                            header("location: http://localhost:81/Project/manage_manga/DeleteChap/".$name[0]["TenTruyen"]);
                            
                        }
                        if (fwrite($file, $content) === "false") {
                            $_SESSION["kqDeleteFile"]='false';
                            header("location: http://localhost:81/Project/manage_manga/DeleteChap/".$name[0]["TenTruyen"]);
                            
                        }
                        $_SESSION["kqDeleteFile"]="true 123";
                        header("location: http://localhost:81/Project/manage_manga/DeleteChap/".$name[0]["TenTruyen"]);
                        fclose($file);
                        
                    } else {
                        $_SESSION["kqDeleteFile"]="false";
                        header("location: http://localhost:81/Project/manage_manga/DeleteChap/".$name[0]["TenTruyen"]);
                        
                    }
                }
        }
        else{
            $_SESSION["kqDeleteFile"]="false";
            header("location: http://localhost:81/Project/manage_manga/DeleteChap/".$name[0]["TenTruyen"]);
        }
    }

}


?>