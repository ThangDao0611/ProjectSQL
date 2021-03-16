<?php
  if(isset($_SESSION["username"])){
    header("location: http://localhost:81/Project/home");
  }
?>
<div class="form__login">
<form action="./SaveSession" method="POST">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Tên đăng nhập</label>
    <input type="text" class="form-control" name="user" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
    <input type="password" class="form-control" name="pass" id="exampleInputPassword1">
  </div>
  <button type="submit" name="btnLogin" class="btn btn-primary">Đăng nhập</button>
<div class="form__error">
  <?php 
    if(isset($_SESSION["ErrorLogin"]))
      {echo "Sai tên đăng nhập hoặc mật khẩu!" ;
      unset($_SESSION["ErrorLogin"]);
      }
    else {echo "Vui lòng đăng nhập!" ;}
  ?>
</div>
  <h3>
    <?php
      if(isset($_SESSION['username']))
        echo $_SESSION['username'];
    ?>
  </h3>
  
</form>
</div>