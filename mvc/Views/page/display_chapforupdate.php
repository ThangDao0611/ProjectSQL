<?php foreach($data["Truyen"] as $row ){ ?>
    <div class="chitiet_truyen">
        <ul class="chitiet_listpic">
        <a href="http://localhost:81/Project/manage_manga/<?php echo $data["Action"] ?>/<?php echo $row["TenTruyen"]; ?>"><img src="/Project/Data<?php echo $row["HinhAnh"]; ?>" alt="" class="anh_chitiet"></a>
        </ul>
        <ul class="chitiet_listtext">
            <li class="thuoctinh_chitiet"><p><span>ID: </span><?php echo $row["Id"]; ?></p></li>
            <li class="thuoctinh_chitiet"><p><span>Tên Sách: </span><a href="http://localhost:81/Project/manage_manga/<?php echo $data["Action"] ?>/<?php echo $row["TenTruyen"]; ?>"><?php echo $row["TenTruyen"]; ?></a></p></li>
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
        </ul>
    </div>   
<?php } ?>