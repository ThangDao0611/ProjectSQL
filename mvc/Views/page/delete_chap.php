

<form action="http://localhost:81/Project/manage_manga/ActionDeleteChap/<?php echo $data["Id"]; ?>" method="post" enctype="multipart/form-data" >
    
    
    
    <label for="number">Số Chương (từ 1 đến <?php echo $data["Chap"] ?>)</label>
    <input type="number" name="number" id="number" min="1" max="<?php echo $data["Chap"] ?>">

    <label for="fileupload">Chọn File (nếu có)</label>
    <input name="fileupload" type="file" id="fileupload"/>


    <input type="submit" value="Gửi" name="btnsubmit_delete">

</form>
<div class="thongbao_truyen">
            <?php
                if(isset($_SESSION["kqDeleteFile"])){
                    if($_SESSION["kqDeleteFile"]=="true"){
                        echo "Xóa chương thành công!";
                        unset($_SESSION["kqDeleteFile"]);
                      }
                      else{
                        echo "Xóa chương thành công!";
                        unset($_SESSION["kqDeleteFile"]);
                      }
                }
            ?>
</div>