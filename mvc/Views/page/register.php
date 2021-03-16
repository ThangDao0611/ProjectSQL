<?php
  if(isset($_SESSION["username"])){
    header("location: http://localhost:81/Project/home");
  }
?>
<div class="form__register">
<form action="./KhachHangDangKy"  method="POST">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Tên đăng nhập</label>
    <input type="text" name="user" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
      <input type="password" name="pass" class="form-control" id="exampleInputPassword1">
    </div>
    <button type="submit" name="btnRegister" class="btn btn-primary">Đăng ký</button>
    <div class="button_dangky">
    <?php 
      if(isset($_SESSION["kqRegister"])){
        if($_SESSION["kqRegister"]=="true"){
          echo "Đăng ký thành công!";
          unset($_SESSION["kqRegister"]);
        }
        else{
          echo "Đăng ký thất bại!";
          unset($_SESSION["kqRegister"]);
        }
      }
     ?>
    </div>
</form>
</div>