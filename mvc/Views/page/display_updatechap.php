
<form action="http://localhost:81/Project/manage_manga/DislayUpdateChapList" method="post" >
    <label for="name_manga" class="form-label">Id Hoặc Tên Truyện</label>
    <input type="text" class="form-control" name="name_update" id="name_update" >

    <label for="" class="form-label">Hành Động</label>

    <select name="update_chap" id="update_chap">
        <option value="null">Chọn Hành Động</option>
        <option value="add_chap">Thêm Chương</option>
        <option value="delete_chap">Xóa Chương</option>
    </select>
    <input type="submit" value="Chọn" name="btnsubmit_update">

</form>

