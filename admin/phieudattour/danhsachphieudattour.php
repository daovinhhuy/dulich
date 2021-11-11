<?php
$sql = "SELECT * FROM (((phieudattour inner join tour on phieudattour.idtour = tour.idtour) 
        inner join khachhang on phieudattour.idkh = khachhang.idkh) 
        inner join trangthai on phieudattour.idtrangthai = trangthai.idtrangthai)";
if(isset($_POST['submit'])){
    $s = $_POST['search'];
    $sql = "SELECT * FROM (((phieudattour inner join tour on phieudattour.idtour = tour.idtour) 
        inner join khachhang on phieudattour.idkh = khachhang.idkh) 
        inner join trangthai on phieudattour.idtrangthai = trangthai.idtrangthai)
        WHERE sophieu LIKE '%$s%' or sdt LIKE '%$s%' or tenkh LIKE '%$s%' or tentour LIKE '%$s%' ";
}
$query = mysqli_query($connect, $sql);
?>

<div class="card">
    <div class="card-header text-center">
        <h1>Danh sách Phiếu đặt tour</h1>
        <form method="POST" action="phieudattour/xuatdsdattour.php" style="float: right;">
            <button class="btn btn-success" type="submit" name="btnExport">Xuất Dữ Liệu Ra File Excel >></button>
        </form>
        <form action="email.php" style="float: right; padding-right: 10px;">
            <button class="btn btn-success" type="submit">Gửi Email</button>
        </form>
    </div>
    <div class="card-body">
        <form action="" method="POST" class="form-inline" enctype="multipart/form-data">
            <div class="form-group">
                <input class="form-control" name="search" placeholder="Nhập nội dung tìm kiếm" value="<?php echo isset($_POST['search']) ? $_POST['search'] : ''; ?>">
                <button type="submit" name="submit" class="btn btn-primary btn-sm"  >Tìm Kiếm</button>
            </div>
        </form>
        <a class="btn btn-primary" href="index.php?page_admin=themphieudattour" style="float: right "><i class="fa fa-plus-circle" aria-hidden="true"> Thêm mới</i></a>
        <br><br>
        <table class="table table-bordered">
            <thead class="thead-dark text-center">
                <tr>
                    <th>STT</th>
                    <th>Số phiếu</th>
                    <th>Số điện thoại</th>
                    <th>Khách hàng</th>
                    <th>Email</th>
                    <th>Số vé</th>
                    <th>Ngày đặt</th>
                    <th>Tour</th>
                    <th>Trạng thái</th>
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
                        <td><?php echo $row['sophieu']; ?></td>
                        <td><?php echo $row['sdt']; ?></td>
                        <td><?php echo $row['tenkh']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['sove']; ?></td>
                        <td><?php echo $row['ngaydat']; ?></td>
                        <td><?php echo $row['tentour']; ?></td>
                        <td><?php echo $row['tentrangthai']; ?></td>
                        <td style="text-align: center">
                            <a class="btn btn-outline-success fa fa-edit" href="index.php?page_admin=suaphieudattour&idphieu=<?php echo $row['idphieu']; ?>"> Sửa</a>
                        </td>
                        <td style="text-align: center">
                            <a class="btn btn-outline-danger fa fa-trash" onclick="return Del('<?php echo $row['tentour']; ?>')" href="index.php?page_admin=xoaphieudattour&idphieu=<?php echo $row['idphieu']; ?>"> Xóa </a>
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
        return confirm("Bạn có chắc muốn xóa Phiếu đặt tour : " + name + " không ?");
    }
</script>