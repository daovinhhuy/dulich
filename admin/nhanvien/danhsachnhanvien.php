<?php
$sql = "SELECT * FROM nhanvien inner join chucvu on nhanvien.idcv = chucvu.idcv ";
if(isset($_POST['submit'])){
    $s = $_POST['search'];
    $sql = "SELECT * FROM nhanvien inner join chucvu on nhanvien.idcv = chucvu.idcv WHERE msnv LIKE '%$s%' or hoten LIKE '%$s%'";
}
$query = mysqli_query($connect, $sql);
?>

<div class="card">
    <div class="card-header text-center">
        <h1>Danh sách Nhân viên</h1>
    </div>
    <div class="card-body">
        <form action="" method="POST" class="form-inline" enctype="multipart/form-data">
            <div class="form-group">
                <input class="form-control" name="search" placeholder="Nhập nội dung tìm kiếm" value="<?php echo isset($_POST['search']) ? $_POST['search'] : ''; ?>">
                <button type="submit" name="submit" class="btn btn-primary btn-sm">Tìm Kiếm</button>
            </div>
        </form>
        <a class="btn btn-primary" href="index.php?page_admin=themnhanvien" style="float: right "><i class="fa fa-plus-circle" aria-hidden="true"> Thêm mới</i></a>
        <br><br>
        <table class="table table-bordered">
            <thead class="thead-dark text-center">
                <tr>
                    <th>STT</th>
                    <th>Mã nhân viên</th>
                    <th>Họ tên nhân viên</th>
                    <th>Ngày sinh</th>
                    <th>Giới tính</th>
                    <th>Địa chỉ</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th>Tên tài khoản</th>
                    <th>Mật khẩu</th>
                    <th>Chức vụ</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while ($row  = mysqli_fetch_assoc($query)) { ?>
                    <tr>
                        <td style="text-align: center;"><?php echo $i++; ?></td>
                        <td><?php echo $row['msnv']; ?></td>
                        <td><?php echo $row['hoten']; ?></td>
                        <td><?php echo $row['ngaysinh']; ?></td>
                        <td><?php echo $row['gioitinh']; ?></td>
                        <td><?php echo $row['diachi']; ?></td>
                        <td><?php echo $row['sdtnv']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['tentaikhoan']; ?></td>
                        <td style="text-align: center"><a class="btn btn-warning" href="index.php?page_admin=thaydoimatkhau&idnhanvien=<?php echo $row['idnhanvien']; ?>">Đổi mật khẩu</a></td>
                        <td><?php echo $row['tenchucvu']; ?></td>
                        <td style="text-align: center">
                            <a class="btn btn-outline-success fa fa-edit" href="index.php?page_admin=suanhanvien&idnhanvien=<?php echo $row['idnhanvien']; ?>"> Sửa</a>
                        </td>

                        <td style="text-align: center">
                            <a class="btn btn-outline-danger fa fa-trash" onclick="return Del('<?php echo $row['hoten']; ?>')" href="index.php?page_admin=xoanhanvien&idnhanvien=<?php echo $row['idnhanvien']; ?>"> Xóa </a>
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
        return confirm("Bạn có chắc muốn xóa Nhân viên : " + name + " không ?");
    }
</script>