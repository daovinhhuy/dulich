<?php
$sql = "SELECT * FROM sukienlehoi inner join diemdulich on sukienlehoi.iddiemdulich = diemdulich.iddiemdulich ";
if(isset($_POST['submit'])){
    $s = $_POST['search'];
    $sql = "SELECT * FROM sukienlehoi inner join diemdulich on sukienlehoi.iddiemdulich = diemdulich.iddiemdulich
    WHERE mssklh LIKE '%$s%' or tensklh LIKE '%$s%' or tendiemdulich LIKE '%$s%' ";
}
$query = mysqli_query($connect,$sql);
?>

<div class="card">
    <div class="card-header text-center">
        <h1>Danh sách Sự Kiện - Lễ Hội</h1>
    </div>
    <div class="card-body">
        <form action="" method="POST" class="form-inline" enctype="multipart/form-data">
            <div class="form-group">
                <input class="form-control" name="search" placeholder="Nhập nội dung tìm kiếm" value="<?php echo isset($_POST['search']) ? $_POST['search'] : ''; ?>">
                <button type="submit" name="submit" class="btn btn-primary btn-sm">Tìm Kiếm</button>
            </div>
        </form>
        <a class="btn btn-primary" href="index.php?page_admin=themsklh" style="float: right "><i class="fa fa-plus-circle" aria-hidden="true"> Thêm mới</i></a>
        <br><br>
        <table class="table table-bordered">
            <thead class="thead-dark text-center">
                <tr>
                    <th>STT</th>
                    <th>Mã Sự Kiện - Lễ Hội</th>
                    <th>Tên Sự Kiện - Lễ Hội</th>
                    <th>Hình ảnh</th>
                    <th>Thời gian diễn ra</th>
                    <th>Nơi diễn ra</th>
                    <th>Giới thiệu</th>
                    <th>Điểm du lịch</th>
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
                        <td><?php echo $row['mssklh']; ?></td>
                        <td><?php echo $row['tensklh']; ?></td>
                        <td>
                            <img style="width : 150px;" src="../img/sklh/<?php echo $row['idsklh']."?".time(); ?>">
                        </td>
                        <td><?php echo $row['thoigiandienra']; ?></td>
                        <td><?php echo $row['noidienra']; ?></td>
                        <td><?php echo $row['gioithieusklh']; ?></td>
                        <td><?php echo $row['tendiemdulich']; ?></td>
                        <td style="text-align: center">
                            <a class="btn btn-outline-success fa fa-edit" href="index.php?page_admin=suasklh&idsklh=<?php echo $row['idsklh']; ?>"> Sửa </a>
                        </td>

                        <td style="text-align: center">
                            <a class="btn btn-outline-danger fa fa-trash" onclick="return Del('<?php echo $row['tensklh']; ?>')" href="index.php?page_admin=xoasklh&idsklh=<?php echo $row['idsklh']; ?>"> Xóa </a>
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
        return confirm("Bạn có chắc muốn xóa Sự kiện - lễ hội : " + name + " không ?");
    }
</script>