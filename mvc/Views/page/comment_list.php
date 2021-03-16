
<div class="comment_list">
    <?php
        
        $sobinhluan = 5;
        $from = ($data["Page"]-1)*$sobinhluan; 
        $end =$from + $sobinhluan;
        if(isset($data["TongBinhLuan"][0]["count"])){
            $tongsobinhluan = $data["TongBinhLuan"][0]["count"];
            $sotrang = ceil($tongsobinhluan/$sobinhluan);
        }
        else{
            $sotrang = 0;
        }
        if(isset($data["TongBinhLuan"][0]["count"]) && $data["TongBinhLuan"][0]["count"]<$end){
            $end = $data["TongBinhLuan"][0]["count"];
        }
        //foreach ($data["BinhLuan"] as $row ) {>
        for($i=$from;$i<$end;$i++) { ?>
            <li><?php echo $data["BinhLuan"][$i]["TenTaiKhoan"] ?>
            <?php echo "<br>" ?>
            <?php echo $data["BinhLuan"][$i]["BinhLuan"] ?>
            <?php echo "<br>" ?>
            <?php echo $strTime = strftime("%H:%M:%S %d-%B-%Y", $data["BinhLuan"][$i]["ThoiGian"]); ?>
            <?php echo "<br>" ?>
            <?php if(isset($_SESSION["Admin"])){ ?>
                    <a href="http://localhost:81/Project/manga/XoaBinhLuan/<?php echo $data["BinhLuan"][$i]["ThoiGian"] ?>/<?php echo $data["BinhLuan"][$i]["TenTaiKhoan"] ?>/<?php echo $data["Id"] ?>/" >Xóa</a>
                <?php } ?>
            </li>
            <?php  }
    ?>
</div>
<div id="phan_trang_bl">
    <?php
        if($sotrang>0){
        for($i=1;$i<=$sotrang;$i++){ ?>
            <a href="http://localhost:81/Project/manga/CommentList/<?php echo $data["TenSach"] ?>/<?php echo $i ?>">Trang <?php echo $i ?></a>
            <?php }}
    ?>
</div>
