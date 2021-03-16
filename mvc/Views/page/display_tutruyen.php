
<?php
    if(isset($_SESSION["username"])==false){
        header("location: http://localhost:81/Project/home/");
    }
?>

<?php foreach($data["Truyen"] as $row ){ ?>
    <div class="item_tutruyen">
    <ul class="tutruyen_listpic"><a href="http://localhost:81/Project/home/truyen/<?php echo $row["TenTruyen"]; ?>"><img src="/Project/Data<?php echo $row["HinhAnh"]; ?>" alt="" class="pic_tutruyen"></a></ul>
    <ul class="tutruyen_listtext">
        <li class="tutruyen_text"><p><span>ID: </span><?php echo $row["Id"]; ?></p></li>
        <li class="tutruyen_text"><p><span>Tên Sách: </span><a href="http://localhost:81/Project/home/truyen/<?php echo $row["TenTruyen"]; ?>"><?php echo $row["TenTruyen"]; ?></a></p></li>
        <li class="tutruyen_text"><p><span>Tác Giả: </span><?php echo $row["TacGia"]; ?></p></li>
        <li class="thuoctinh_truyen3"><span>Thể Loại:
            <?php
                foreach ($data["TheLoai"] as $key) { 
                    if($key["Id"]==$row["Id"]){ ?>
                        </span><?php echo $key["TenTheLoai"]; ?>
                  <?php  }
                }
            ?>
            </li>
        <li class="tutruyen_text"><a href="http://localhost:81/Project/home/xoatutruyen/<?php echo $row["Id"] ?>">Xóa</a></li>
    </ul>
    </div>

<?php } ?>