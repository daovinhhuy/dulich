<?php
$sql = "SELECT * FROM ((phanhoi inner join tour on phanhoi.idtour = tour.idtour) inner join khachhang on phanhoi.idkh = khachhang.idkh) ";
if(isset($_POST['submit'])){
    $s =$_POST['search'] ;
    $sql = "SELECT * FROM ((phanhoi inner join tour on phanhoi.idtour = tour.idtour) inner join khachhang on phanhoi.idkh = khachhang.idkh)
    WHERE sdt LIKE '%$s%' or tenkh LIKE '%$s%' or mstour LIKE '%$s%' ";
}
$query = mysqli_query($connect, $sql);
?>

<div class="card">
    <div class="card-header text-center">
        <h1>Danh sách Phản hồi</h1>
    </div>
    <div class="card-body">
        <form action="" method="POST" class="form-inline" enctype="multipart/form-data">
            <div class="form-group">
                <input class="form-control" name="search" placeholder="Nhập nội dung tìm kiếm" value="<?php echo isset($_POST['search']) ? $_POST['search'] : ''; ?>">
                <button type="submit" name="submit" class="btn btn-primary btn-sm">Tìm Kiếm</button>
            </div>
        </form>
        <a class="btn btn-primary" href="index.php?page_admin=themphanhoi" style="float: right "><i class="fa fa-plus-circle" aria-hidden="true"> Thêm mới</i></a>
        <br><br>
        <table class="table table-bordered">
            <thead class="thead-dark text-center">
                <tr>
                    <th>STT</th>
                    <th>Số điện thoại</th>
                    <th>Khách hàng</th>
                    <th>Nội dung </th>
                    <th>Ngày phản hồi</th>
                    <th>Mã Tour</th>
                    <th>Tour</th>
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
                        <td><?php echo $row['noidungph']; ?></td>
                        <td><?php echo $row['ngayph']; ?></td>
                        <td><?php echo $row['mstour']; ?></td>
                        <td><?php echo $row['tentour']; ?></td>
                        <td style="text-align: center">
                            <a class="btn btn-outline-success fa fa-edit" href="index.php?page_admin=suaphanhoi&idph=<?php echo $row['idph']; ?>"> Sửa</a>
                        </td>
                        <td style="text-align: center">
                            <a class="btn btn-outline-danger fa fa-trash" onclick="return Del('<?php echo $row['tentour']; ?>')" href="index.php?page_admin=xoaphanhoi&idph=<?php echo $row['idph']; ?>"> Xóa </a>
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
        return confirm("Bạn có chắc muốn xóa Phản hồi của khách hàng vể tour: " + name + " không ?");
    }
</script>