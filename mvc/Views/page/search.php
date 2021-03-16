<?php
    if(isset($_SESSION["search_name"])){
        unset($_SESSION["search_name"]);
        unset($_SESSION["search_theloai"]);
    }
?>
<div class="form_search">
    <form action="./ketqua/1" method="post">
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
    <div class="search_theloai">
        <input type="text" class="form-control" name="search_name" id="exampleInputEmail1" aria-describedby="emailHelp">
        <input type="submit" value="Tìm kiếm" id="loctruyen">
    </div>
    </form>
</div>