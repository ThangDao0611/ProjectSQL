<div class="khung_themtruyen">
<form action="http://localhost:81/Project/manage_manga/AddManga" method="post" enctype="multipart/form-data">
    <label for="name_manga" class="form-label">Tên Truyện</label>
    <input type="text" class="form-control" name="name_manga" id="name_manga" >
    <label for="name_author" class="form-label">Tác Giả</label>
    <input type="text" class="form-control" name="name_author" id="name_author" >

    <label for="name_manga" class="form-label">Thể Loại</label>
    <div class="theloai_list">
    <?php
        $i=0;
        while(isset($data["TheLoai"][$i]["TenTheLoai"])){ ?>
        <div class="item_search">
            <input type="checkbox" id="theloai<?php echo $i+1; ?>" name="theloai<?php echo $i+1; ?>" value="<?php echo $data["TheLoai"][$i]["TenTheLoai"]; ?>">
            <label for="theloai<?php echo $i+1; ?>"> <?php echo $data["TheLoai"][$i]["TenTheLoai"]; ?> </label><br>
        </div>
        <?php $i++;  }
    ?>
    </div>
    
    <label for="fileupload" class="form-label">Hình Ảnh</label>
    <input type="file" name="fileupload" id="fileupload">
    <input type="submit" value="Gửi truyện" name="btnsubmit_manga">

</form>
<div class="thongbao_truyen">
            <?php
                if(isset($_SESSION["kqUploadImg"])){
                    if($_SESSION["kqUploadImg"]=="true"){
                        echo "Thêm truyện thành công!";
                        unset($_SESSION["kqUploadImg"]);
                      }
                      else{
                        echo "Thêm truyện thất bại!";
                        unset($_SESSION["kqUploadImg"]);
                      }
                }
            ?>
</div>
</div>
