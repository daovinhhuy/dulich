<?php
$sql = "SELECT * FROM tintuc ";
if(isset($_POST['submit'])){
    $s = $_POST['search'];
    $sql = "SELECT * FROM tintuc WHERE tentintuc LIKE '%$s%' or ngaydang LIKE '%$s%'";
}
$query = mysqli_query($connect, $sql);
?>
<div class="card">
    <div class="card-header text-center">
        <h1>Danh sách Tin tức</h1>
    </div>
    <div class="card-body">
        <form action="" method="POST" class="form-inline" enctype="multipart/form-data">
            <div class="form-group">
                <input class="form-control" name="search" placeholder="Nhập nội dung tìm kiếm" value="<?php echo isset($_POST['search']) ? $_POST['search'] : ''; ?>">
                <button type="submit" name="submit" class="btn btn-primary btn-sm">Tìm Kiếm</button>
            </div>
        </form>
        <a class="btn btn-primary" href="index.php?page_admin=themtintuc" style="float: right "><i class="fa fa-plus-circle" aria-hidden="true"> Thêm mới</i></a>
        <br><br>
        <table class="table table-bordered">
            <thead class="thead-dark text-center">
                <tr>
                    <th>STT</th>
                    <th>Tên Tin tức</th>
                    <th>Hình ảnh</th>
                    <th>Nội dung</th>
                    <th>Ngày đăng</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while ($row = mysqli_fetch_assoc($query)) { ?>
                    <tr>
                        <td style="text-align: center;"><?php echo $i++; ?></td>
                        <td><?php echo $row['tentintuc']; ?></td>
                        <td>
                            <img style="width : 150px;" src="../img/tintuc/<?php echo $row['idtintuc']."?".time(); ?>">
                        </td>
                        <td><?php echo substr($row['noidung'], 0, 300); ?></td>
                        <td><?php echo $row['ngaydang']; ?></td>
                        <td style="text-align: center">
                            <a class="btn btn-outline-success fa fa-edit" href="index.php?page_admin=suatintuc&idtintuc=<?php echo $row['idtintuc']; ?>"> Sửa</a>
                        </td>
                        <td style="text-align: center">
                            <a class="btn btn-outline-danger fa fa-trash" onclick="return Del('<?php echo $row['tentintuc']; ?>')" href="index.php?page_admin=xoatintuc&idtintuc=<?php echo $row['idtintuc']; ?>"> Xóa </a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

    </div>
</div>
<script>
    function Del(name) {
        return confirm("Bạn có chắc muốn xóa Tin tức : " + name + " không ?");
    }
</script>