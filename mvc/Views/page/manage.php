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
<div id="search_user" >
        <form action="http://localhost:81/Project/manage/search" method="post">
            <label for="username_search">Tìm tài khoản</label>
            <input type="text" name="username_search" id="username_search">
            <input type="submit" name="btnSubmitUser" value="Tìm kiếm">
        </form>
</div>
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