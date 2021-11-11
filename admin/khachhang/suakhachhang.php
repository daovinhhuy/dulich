<?php
$id = $_GET['idkh'];
$sql_kh = "SELECT * FROM khachhang WHERE idkh = $id";
$query_kh = mysqli_query($connect, $sql_kh);
$row_up = mysqli_fetch_assoc($query_kh);

if (isset($_POST['sbm'])) {
    $mskh = $_POST['mskh'];
    $tenkh = $_POST['tenkh'];
    $diachi = $_POST['diachi'];
    $sdt = $_POST['sdt'];
    $email = $_POST['email'];
    $nghenghiep = $_POST['nghenghiep'];
    $tencongty = $_POST['tencongty'];

    $sql_ms = "SELECT mskh FROM khachhang WHERE mskh='$mskh'";
    $query_ms =  mysqli_query($connect, $sql_ms);
    $row_ms = mysqli_num_rows($query_ms);

    if ($mskh == "" || $tenkh == "" || $diachi == "" || $diachi == "" || $sdt == "" || $email == "" || $nghenghiep == "" || $tencongty == "") {
        $loi = "Vui lòng không để trống thông tin";
        echo "<script type='text/javascript'>alert('$loi');</script>";
    } elseif ($row_ms > 0) {
        $loi_1 = "Mã khách hàng " . $mskh . " này đã được sử dụng";
        echo "<script type='text/javascript'>alert('$loi_1');</script>";
    } else {
        $sql = "UPDATE khachhang SET mskh = '$mskh', tenkh = '$tenkh',diachi ='$diachi',sdt='$sdt', email= '$email', nghenghiep ='$nghenghiep',tencongty ='$tencongty' Where idkh ='$id'";
        $query = mysqli_query($connect, $sql);
        // header('location: index.php?page_admin=danhsachkhachhang');
?>
        <script type="text/javascript">
            location.href = 'index.php?page_admin=danhsachkhachhang';
        </script>
<?php
    }
}
?>
<div class="card">
    <div class="card-header">
        <h1>Sửa Khách hàng</h1>
    </div>
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Mã Khách hàng</label>
                <input type="text" name="mskh" class="form-control" require value="<?php echo isset($_POST['mskh']) ? $_POST['mskh'] : $row_up['mskh'];; ?>">
            </div>
            <div class="form-group">
                <label for="">Tên Khách hàng</label>
                <input type="text" name="tenkh" class="form-control" require value="<?php echo $row_up['tenkh']; ?>">
            </div>
            <div class="form-group">
                <label for="">Địa chỉ</label>
                <input type="text" name="diachi" class="form-control" require value="<?php echo $row_up['diachi']; ?>">
            </div>
            <div class="form-group">
                <label for="">Số điện thoại</label>
                <input type="number" name="sdt" class="form-control" require value="<?php echo $row_up['sdt']; ?>">
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" name="email" class="form-control" require value="<?php echo $row_up['email']; ?>">
            </div>
            <div class="form-group">
                <label for="">Nghề nghiệp</label>
                <input type="text" name="nghenghiep" class="form-control" require value="<?php echo $row_up['nghenghiep']; ?>">
            </div>
            <div class="form-group">
                <label for="">Công ty</label>
                <input type="text" name="tencongty" class="form-control" require value="<?php echo $row_up['tencongty']; ?>">
            </div>
            <button name="sbm" class="btn btn-success" type="sumit"> Sửa </button>
        </form>
    </div>
</div>