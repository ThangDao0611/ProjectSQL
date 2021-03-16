
<script>
    var chap = <?php echo $data["Chap"] ?>;
    updateList = function() {
    var input = document.getElementById('file');
    var output = document.getElementById('fileList');
    var children = "";
    for (var i = 0; i < input.files.length; ++i) {
        children += '<li>' + input.files.item(i).name + '</li>' + '<li>' +'Số Chương:  ' + (chap+i) +'</li>';
    }
    output.innerHTML = '<ul>'+children+'</ul>';
}
</script>

<form action="http://localhost:81/Project/manage_manga/ActionAddChap/<?php echo $data["Id"]; ?>" method="post" enctype="multipart/form-data" >
    
    
    <label for="fileupload[]">Chọn tệp</label>
    <input name="fileupload[]" type="file" multiple="multiple" name="file" id="file"  onchange="javascript:updateList()"/>

    <div id="fileList"></div>
    
    <input type="submit" value="Gửi tệp" name="btnsubmit_add">

</form>
<div class="thongbao_truyen">
            <?php
                if(isset($_SESSION["kqUploadFile"])){
                    if($_SESSION["kqUploadFile"]>0){
                        echo "Thêm chương thành công!";
                        unset($_SESSION["kqUploadFile"]);
                      }
                      else{
                        echo "Thêm chương thất bại!";
                        unset($_SESSION["kqUploadFile"]);
                      }
                }
            ?>
</div>



