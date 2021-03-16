<?php
    if(!isset($_SESSION["Admin"])){
        header("location: http://localhost:81/Project/home/");
    }
?>
<script>
    function ConfirmDelete()
        {
                var x = confirm("Bạn có muốn xóa không?");
                if (x)
                     return true;
                else
                    return false;
        }
</script>

<div class="quanly_tk">
<?php
    foreach ($data["TaiKhoan"] as $row) { ?>
    <div class="ql1"><p><?php echo $row["TenTaiKhoan"] ?></p></div>
    <div class="ql2">
            <a href="http://localhost:81/Project/manage/delete/<?php echo $row["TenTaiKhoan"] ?>/" onclick="return ConfirmDelete()">Xóa</a>
            <?php
                if(in_array($row["TenTaiKhoan"],$data["Ban"])==false){ ?>
                    <a href="http://localhost:81/Project/manage/ban/<?php echo $row["TenTaiKhoan"] ?>/">Cấm Bình Luận</a>
                <?php }
            ?>
            
            <?php
                if(in_array($row["TenTaiKhoan"],$data["Ban"])){ ?>
                    <a href="http://localhost:81/Project/manage/unban/<?php echo $row["TenTaiKhoan"] ?>/">Bỏ Cấm Bình Luận</a>
                <?php }
            ?>
    </div>

            <br>
        <?php }
?>
</div>      