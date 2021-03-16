
<?php foreach($data["Truyen"] as $row ){ ?>
    <div class="chitiet_truyen">
        <ul class="chitiet_listpic">
        <a href="http://localhost:81/Project/home/truyen/<?php echo $row["TenTruyen"]; ?>"><img src="/Project/Data<?php echo $row["HinhAnh"]; ?>" alt="" class="anh_chitiet"></a>
        </ul>
        <ul class="chitiet_listtext">
            <li class="thuoctinh_chitiet"><p><span>ID: </span><?php echo $row["Id"]; ?></p></li>
            <li class="thuoctinh_chitiet"><p><span>Tên Sách: </span><a href="http://localhost:81/Project/home/truyen/<?php echo $row["TenTruyen"]; ?>"><?php echo $row["TenTruyen"]; ?></a></p></li>
            <li class="thuoctinh_chitiet"><p><span>Tác Giả: </span><?php echo $row["TacGia"]; ?></p></li>
            <li class="thuoctinh_truyen3"><span>Thể Loại:
            <?php
                foreach ($data["TheLoai"] as $key) { 
                    if($key["Id"]==$row["Id"]){ ?>
                        </span><?php echo $key["TenTheLoai"]; ?>
                  <?php  }
                }
            ?>
            </li>
            <li class="thuoctinh_chitiet"><p><span>Tổng chương: </span><?php echo count($data["ChapList"]); ?></p></li>
        </ul>
    </div>   
<?php } ?>
<div class="box_themtruyen">
    <div class="box_1">

<?php
    if(isset($_SESSION["username"])){ ?>

        <?php
            if($data["CheckDoc"]==true){ ?>
                <a href="http://localhost:81/Project/manga/read/<?php echo $row["TenTruyen"]; ?>/<?php echo $data["SoChuongDangDoc"][0]["SoChuong"]  ?>/">Đọc Tiếp</a>

            
            <?php } ?>
 <?php   }
?>
<?php 
    if($data["CheckDoc"]==false){ ?>
        <a href="http://localhost:81/Project/manga/read/<?php echo $row["TenTruyen"]; ?>/1/"
     <?php $_SESSION[$row["Id"]]=1; // Số Chương ?>>Đọc Truyện</a>
<?php }
?>
    </div>

    <div class="box_2">
<?php
    if(isset($_SESSION["username"])){ ?>
    <?php
    if($data["Check"]==false){ ?>
            <a href="http://localhost:81/Project/manga/ThemVaoTuTruyen/<?php echo $_SESSION["username"]; ?>/<?php echo $data["Truyen"][0]["Id"]; ?>/">
        Thêm Vào Tủ Truyện</a>
     <?php  }
    ?>
        
        <?php   }
    ?>
    </div>

    <div class="them_truyen">
       <?php
        if(isset($_SESSION["kqAddTruyen"])){
            echo "Đã thêm thành công!";
            unset($_SESSION["kqAddTruyen"]);
        }
       ?> 
    </div>
</div>
<?php
    $tongchap = count($data["ChapList"]);
    $sochap1page = 50;
    $sotrang = ceil($tongchap / $sochap1page);
    $trang =  1;
    if(isset($data["Page"]))
        {
            $trang = $data["Page"];
        }
    $from = ($trang - 1) * $sochap1page;
    $end = $from + $sochap1page;
    if($end>$tongchap){
        $end = $tongchap;
    }
?>
<div class="khung_phantrang">
    <div class="maso1">Danh sách chương</div>
    <?php
        for($i=$from;$i<$end;$i++){ ?>
            <a href="http://localhost:81/Project/manga/read/<?php echo $row["TenTruyen"] ?>/<?php echo $i+1; ?>/"><?php echo $data["ChapList"][$i]; ?></a> 
            <?php }
    ?>
</div>
<div id="phan_trang">

    <?php
        if($sotrang<5){ 
            for($i=1;$i<=$sotrang;$i++){ ?>
                <a href='http://localhost:81/Project/home/page_chap/<?php echo $data["Truyen"][0]["TenTruyen"]; ?>/<?php echo $i ?>/' class="phantrang_list">Trang <?php echo $i ?></a>
                <?php }
                 }
            ?>
    <?php
        if($trang<=3 && $sotrang>=5){
            for($i=1;$i<=5;$i++){ ?>
                <a href='http://localhost:81/Project/home/page_chap/<?php echo $data["Truyen"][0]["TenTruyen"]; ?>/<?php echo $i ?>/' class="phantrang_list">Trang <?php echo $i ?></a>
                <?php }
        ?>
       <?php }
       if($trang>3 && $trang<=$sotrang-2){
        for($i=$trang-2;$i<=$trang+2;$i++){ ?>
            <a href='http://localhost:81/Project/home/page_chap/<?php echo $data["Truyen"][0]["TenTruyen"]; ?>/<?php echo $i ?>/' class="phantrang_list">Trang <?php echo $i ?></a>
            <?php } 
        ?>
       <?php } 
       if($trang>3 && $trang<=$sotrang && $trang>$sotrang-2)
        for($i=$sotrang-4;$i<=$sotrang;$i++){ ?>
            <a href='http://localhost:81/Project/home/page_chap/<?php echo $data["Truyen"][0]["TenTruyen"]; ?>/<?php echo $i ?>/' class="phantrang_list">Trang <?php echo $i ?></a>
            <?php }
    ?>
</div>