<?php
$idnhanvien = $_GET['idnhanvien'];

function bindCVList($connect, $Value)
{
    $ListCV = mysqli_query($connect, "SELECT idcv, tenchucvu from chucvu");
    echo "<select name='idcv' class='form-control'>";
    while ($row = mysqli_fetch_array($ListCV)) {
        if ($row['idcv'] == $Value) {
            echo "<option value='" . $row['idcv'] . "' selected>" . $row['tenchucvu'] . "</option>";
        } else echo "<option value='" . $row['idcv'] . "'>" . $row['tenchucvu'] . "</option>";
    }
    echo "</select>";
}

$sql_nv = "SELECT * FROM nhanvien WHERE idnhanvien = $idnhanvien";
$query_nv = mysqli_query($connect, $sql_nv);
$row_up = mysqli_fetch_assoc($query_nv);

if (isset($_POST['sbm'])) {
    $msnv = $_POST['msnv'];
    $hoten = $_POST['hoten'];
    $ngaysinh = $_POST['ngaysinh'];
    $gioitinh = $_POST['gioitinh'];
    $diachi = $_POST['diachi'];
    $sdtnv = $_POST['sdtnv'];
    $email = $_POST['email'];
    $tentaikhoan = $_POST['tentaikhoan'];
    $idcv = $_POST['idcv'];
    if($msnv == "" || $hoten == "" || $ngaysinh == "" || $gioitinh == "" || $diachi == "" || $sdtnv == "" || $email == "" || $tentaikhoan == ""){
        $loi = 'Vui lòng không để trống thông tin';
        echo "<script type='text/javascript'>alert('$loi');</script>";
    }else{
    $sql = "UPDATE nhanvien SET msnv = '$msnv',hoten = '$hoten',ngaysinh = '$ngaysinh', gioitinh ='$gioitinh', diachi ='$diachi',
             sdtnv='$sdtnv',email='$email',tentaikhoan='$tentaikhoan',idcv= '$idcv' WHERE idnhanvien ='$idnhanvien'";
    $query = mysqli_query($connect, $sql);
    // header('location:index.php?page_admin=danhsachnhanvien');
    ?>
    <script type="text/javascript">location.href = 'index.php?page_admin=danhsachnhanvien';</script>
<?php
    }
}
?>

<div class="card">
    <div class="card-header">
        <h1>Sửa Nhân viên</h1>
    </div>
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Mã nhân viên</label>
                <input type="text" name="msnv" class="form-control" require value="<?php echo $row_up['msnv']; ?>">
            </div>
            <div class="form-group">
                <label for="">Họ và tên nhân viên</label>
                <input type="text" name="hoten" class="form-control" require value="<?php echo $row_up['hoten']; ?>">
            </div>
            <div class="form-group">
                <label for="">Ngày sinh</label>
                <input type="date" name="ngaysinh" class="form-control" require value="<?php echo $row_up['ngaysinh']; ?>">
            </div>
            <div class="form-group">
                <label for="">Giới tính</label>
                <input type="text" name="gioitinh" class="form-control" require value="<?php echo $row_up['gioitinh']; ?>">
            </div>
            <div class="form-group">
                <label for="">Địa chỉ</label>
                <input type="text" name="diachi" class="form-control" require value="<?php echo $row_up['diachi']; ?>">
            </div>
            <div class="form-group">
                <label for="">Số điện thoại</label>
                <input type="text" name="sdtnv" class="form-control" require value="<?php echo $row_up['sdtnv']; ?>">
            </div>
            <div class="form-group">
                <label for="">Email </label>
                <input type="email" name="email" class="form-control" require value="<?php echo $row_up['email']; ?>">
            </div>
            <div class="form-group">
                <label for="">Tên tài khoản</label>
                <input type="text" name="tentaikhoan" class="form-control" require value="<?php echo $row_up['tentaikhoan']; ?>">
            </div>
            
            <div class="form-group">
                <label for="">Chức vụ</label>
                    <?php bindCVList($connect, $row_up['idcv']); ?>
            </div>
            <button name="sbm" class="btn btn-success" type="sumit">Sửa</button>
        </form>
    </div>
</div>