<div class="manga_title">
  <a href="http://localhost:81/Project/home/" class="return_home" style="text-decoration: none;">Trang chủ</a>
<?php
    if($data["SoChuong"]>1){ ?>
    <a  href="http://localhost:81/Project/manga/read/<?php echo $data["TenSach"]; ?>/<?php echo $data["SoChuong"]-1; ?>/" class="chuong_truoc" style="text-decoration: none;">Chương Trước</a>
  <?php  }
?>

<?php
    if($data["SoChuong"] < $data["TongChuong"]){ ?>
    <a   href="http://localhost:81/Project/manga/read/<?php echo $data["TenSach"]; ?>/<?php echo $data["SoChuong"]+1; ?>/" class="chuong_sau" style="text-decoration: none;">Chương Sau</a>
   <?php }
?>
</div>
            <?php
                require_once $data["link"];
            ?>
<div class="manga_title">
  <a href="http://localhost:81/Project/home/" class="return_home">Trang chủ</a>
<?php
    if($data["SoChuong"]>1){ ?>
    <a  href="http://localhost:81/Project/manga/read/<?php echo $data["TenSach"]; ?>/<?php echo $data["SoChuong"]-1; ?>/" class="chuong_truoc">Chương Trước</a>
  <?php  }
?>

<?php
    if($data["SoChuong"] < $data["TongChuong"]){ ?>
    <a   href="http://localhost:81/Project/manga/read/<?php echo $data["TenSach"]; ?>/<?php echo $data["SoChuong"]+1; ?>/" class="chuong_sau">Chương Sau</a>
   <?php }
?>
</div>
<br>
<div class="submit_comment">
<?php 
  if($data["Ban"]==0 || $data["Ban"]==123){ ?>
      <form action="http://localhost:81/Project/manga/ThemBinhLuan/<?php echo $data["Id"] ?>" method="POST">
    <label for="comment">Bình Luận</label>
    <input type="text" name="comment" id="comment" require>
    <input type="submit" value="Gửi bình luận">
    </form>
<?php }
?>
</div>

<?php 
  echo "Danh sách bình luận";
  require_once "./mvc/Views/page/comment.php";
?>