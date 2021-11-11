<?php
$sql = "SELECT * FROM ((phieudangkytour inner join khachhang on phieudangkytour.idkh = khachhang.idkh) inner join trangthai on phieudangkytour.idtrangthai = trangthai.idtrangthai) ";
if (isset($_POST['submit'])) {
    $s = $_POST['search'];
    $sql = "SELECT * FROM ((phieudangkytour inner join khachhang on phieudangkytour.idkh = khachhang.idkh) inner join trangthai on phieudangkytour.idtrangthai = trangthai.idtrangthai)
    WHERE sdt LIKE '%$s%' or tenkh LIKE '%$s%' or ngaydangky LIKE '%$s%' ";
}
$query = mysqli_query($connect, $sql);
?>

<div class="card">
    <div class="card-header text-center">
        <h1>Danh sách Phiếu đăng ký tour</h1>
    </div>
    <div class="card-body">
        <form action="" method="POST" class="form-inline" enctype="multipart/form-data">
            <div class="form-group">
                <input class="form-control" name="search" placeholder="Nhập nội dung tìm kiếm" value="<?php echo isset($_POST['search']) ? $_POST['search'] : ''; ?>">
                <button type="submit" name="submit" class="btn btn-primary btn-sm">Tìm Kiếm</button>
            </div>
        </form>
        <a class="btn btn-primary" href="index.php?page_admin=themphieudangkytour" style="float: right "><i class="fa fa-plus-circle" aria-hidden="true"> Thêm mới</i></a>
        <br><br>
        <table class="table table-bordered">
            <thead class="thead-dark text-center">
                <tr>
                    <th>STT</th>
                    <th>Số điện thoại</th>
                    <th>Họ tên</th>
                    <th>Email</th>
                    <th>Số vé</th>
                    <th>Ngày đăng ký</th>
                    <th>Ngày khởi hành</th>
                    <th>Điểm khởi hành</th>
                    <th>Điểm đến</th>
                    <th>Trạng thái</th>
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
                        <td><?php echo $row['sdt']; ?></td>
                        <td><?php echo $row['tenkh']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['sove']; ?></td>
                        <td><?php echo $row['ngaydangky']; ?></td>
                        <td><?php echo $row['ngaykhoihanh']; ?></td>
                        <td><?php echo $row['diemkhoihanh']; ?></td>
                        <td><?php echo $row['diemden']; ?></td>
                        <td><?php echo $row['tentrangthai']; ?></td>
                        <td style="text-align: center">
                            <a class="btn btn-outline-success fa fa-edit" href="index.php?page_admin=suaphieudangkytour&idphieudangky=<?php echo $row['idphieudangky']; ?>"> Sửa</a>
                        </td>

                        <td style="text-align: center">
                            <a class="btn btn-outline-danger fa fa-trash" onclick="return Del('<?php echo $row['']; ?>')" href="index.php?page_admin=xoaphieudangkytour&idphieudangky=<?php echo $row['idphieudangky']; ?>"> Xóa </a>
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
        return confirm("Bạn có chắc muốn xóa phiếu đăng ký tour này: " + name + " không ?");
    }
</script>