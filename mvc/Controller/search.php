<?php

class search extends Controller{

    // tạo biến construct và biến tổng cho model

    public $TruyenModel;
    public $TuTruyenModel;
    public $TheLoaiModel;
    public $TheLoaiTruyenModel;

    Public function __construct(){
            $this->TruyenModel = $this->model("TruyenModel");
            $this->TuTruyenModel = $this->model("TuTruyenModel");
            $this->TheLoaiModel = $this->model("TheLoaiModel");
            $this->TheLoaiTruyenModel = $this->model("TheLoaiTruyenModel");
    }

    function action(){

        $this->view("main1",["page"=>"search",
        "TheLoai"=>$this->TheLoaiModel->TheLoai()
        ]);

        //echo "This is action";
    }

    function ketqua($page){
        $result = $this->TheLoaiModel->TongSoTheLoai();
        $tong = $result[0]["Tong"];
        $y=0;
        $theloai = [];
        if(!isset($_SESSION["search_theloai"])){
            for($i=1;$i<=$tong;$i++){
                if(isset($_POST["theloai".$i.""])){
                    $theloai[$y++] = $_POST["theloai".$i.""];
                    $_SESSION["search_theloai"][$i]=$_POST["theloai".$i.""];
                    //echo $_POST["theloai".$i.""];
                }
            }
        }
        else{
            for($i=1;$i<=$tong;$i++){
                if(isset($_SESSION["search_theloai"][$i])){
                    $theloai[$y++] = $_SESSION["search_theloai"][$i];
                    //echo $_POST["theloai".$i.""];
                }
            }
        }
        
        if(!isset($_SESSION["search_name"])){
            $ten = $_POST["search_name"];
            $ten = strtolower($ten);
            $ten = trim($ten);
            $kqten = $this->convert_name($ten);
            $_SESSION["search_name"]=$kqten;
        }
        else{
            $kqten=$_SESSION["search_name"];
        }
        
        

        $kq = $this->TruyenModel->TimTruyen($theloai,$kqten);
        
        $i=0;
        $total=0;
        while(isset($kq[$i]["TenTruyen"])){
            $total++;
            $i++;
        }

        $this->view("main1",["page"=>"display_search",
        "Truyen"=>$kq,
        "Tong"=>$total,
        "Page"=>$page,
        "TheLoai"=>$this->TheLoaiTruyenModel->TheLoaiTruyen()
        ]);
       
    }

    public function convert_name($str) {
		$str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
		$str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
		$str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
		$str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
		$str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
		$str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
		$str = preg_replace("/(đ)/", 'd', $str);
		$str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
		$str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
		$str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
		$str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
		$str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
		$str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
		$str = preg_replace("/(Đ)/", 'D', $str);
		$str = preg_replace("/(\“|\”|\‘|\’|\,|\!|\&|\;|\@|\#|\%|\~|\`|\=|\_|\'|\]|\[|\}|\{|\)|\(|\+|\^)/", ' ', $str);
		$str = preg_replace("/( )/", ' ', $str);
		return $str;
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