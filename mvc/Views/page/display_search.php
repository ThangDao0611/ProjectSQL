    <?php
        $tongsotin = $data["Tong"];
        $sotin1trang = 10;
        $sotrang = ceil($tongsotin/$sotin1trang);
        $trang = 1;
        if(isset($data["Page"]))
        {
            $trang = $data["Page"];
        }
        $from = ($trang - 1) * $sotin1trang;
        $end = $from + $sotin1trang;
        if($end>$tongsotin){
            $end = $tongsotin;
        }
    ?>
<?php for($i=$from;$i<$end;$i++){ ?>
    <div class="item_truyen">
        <ul class="listtruyen_pic">
        <a href="http://localhost:81/Project/home/truyen/<?php echo $data["Truyen"][$i]["TenTruyen"]; ?>"><img src="/Project/Data<?php echo $data["Truyen"][$i]["HinhAnh"]; ?>" alt="" class="anh_truyen"></a>
        </ul>
        <ul class="listtruyen_text">
            <li class="thuoctinh_truyen1"><p><span>Tên Sách: </span><a href="http://localhost:81/Project/home/truyen/<?php echo $data["Truyen"][$i]["TenTruyen"]; ?>"><?php echo $data["Truyen"][$i]["TenTruyen"]; ?></a></p></li>
            <li class="thuoctinh_truyen2"><p><span>Tác Giả: </span><?php echo $data["Truyen"][$i]["TacGia"]; ?></p></li>
            <li class="thuoctinh_truyen3"><span>Thể Loại:
            <?php
                foreach ($data["TheLoai"] as $row) { 
                    if($row["Id"]==$data["Truyen"][$i]["Id"]){ ?>
                        </span><?php echo $row["TenTheLoai"]; ?>
                  <?php  }
                }
            ?>
            </li>
        </ul>
    </div>
<?php } ?>

<div id="phan_trang_1">
    <?php
        for($i=1;$i<=$sotrang;$i++){ ?>
            <a href='http://localhost:81/Project/search/ketqua/<?php echo $i ?>' class="phantrang_list">Trang <?php echo $i ?></a>
            <?php }
    ?>
</div>

