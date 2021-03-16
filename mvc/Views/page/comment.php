

<div class="comment_list">
<?php
    $from = 1; 
    $end = 5;
    if(isset($data["TongBinhLuan"][0]["count"]) && $data["TongBinhLuan"][0]["count"]<$end){
        $end = $data["TongBinhLuan"][0]["count"];
    }
    //foreach ($data["BinhLuan"] as $row ) {>
    if(isset($data["BinhLuan"][0])){
    for($i=$from;$i<=$end;$i++) { ?>
        <li><?php echo $data["BinhLuan"][$i-1]["TenTaiKhoan"] ?>
        <?php echo "<br>" ?>
        <?php echo $data["BinhLuan"][$i-1]["BinhLuan"] ?>
        <?php echo "<br>" ?>
        <?php echo $strTime = strftime("%H:%M:%S %d-%B-%Y", $data["BinhLuan"][$i-1]["ThoiGian"]); ?>
        <?php echo "<br>" ?>
        <?php if(isset($_SESSION["Admin"])){ ?>
                <a href="http://localhost:81/Project/manga/XoaBinhLuan/<?php echo $data["BinhLuan"][$i-1]["ThoiGian"] ?>/<?php echo $data["BinhLuan"][$i-1]["TenTaiKhoan"] ?>/<?php echo $data["Id"] ?>/" >Xóa</a>
            <?php } ?>
        </li>
        <?php  }}
?>
</div>
<?php
    if(isset($data["TongBinhLuan"][0]["count"]) && $data["TongBinhLuan"][0]["count"]>5){ ?>
        <a href="http://localhost:81/Project/manga/CommentList/<?php echo $data["TenSach"] ?>/1" id="xemthem">Xem Thêm</a>
     <?php } ?>
