<?php
$sql_cv = "SELECT * FROM chucvu ";
$query_cv = mysqli_query($connect, $sql_cv);

if (isset($_POST['sbm'])) {
    $msnv = $_POST['msnv'];
    $hoten = $_POST['hoten'];
    $ngaysinh = $_POST['ngaysinh'];
    $gioitinh = $_POST['gioitinh'];
    $diachi = $_POST['diachi'];
    $sdtnv = $_POST['sdtnv'];
    $email = $_POST['email'];
    $tentaikhoan = $_POST['tentaikhoan'];
    $matkhau = $_POST['matkhau'];
    $idcv = $_POST['idcv'];

    $sql_ms = "SELECT msnv FROM nhanvien WHERE msnv='$msnv'";
    $query_ms =  mysqli_query($connect, $sql_ms);
    $row_ms = mysqli_num_rows($query_ms);

    $sql_sdt = "SELECT sdtnv FROM nhanvien WHERE sdtnv='$sdtnv'";
    $query_sdt =  mysqli_query($connect, $sql_sdt);
    $row_sdt = mysqli_num_rows($query_sdt);

    $sql_email = "SELECT email FROM nhanvien WHERE email='$email'";
    $query_email =  mysqli_query($connect, $sql_email);
    $row_email = mysqli_num_rows($query_email);

    $sql_tk = "SELECT tentaikhoan FROM nhanvien WHERE tentaikhoan='$tentaikhoan'";
    $query_tk =  mysqli_query($connect, $sql_tk);
    $row_tk = mysqli_num_rows($query_tk);

    if ($msnv == "" || $hoten == "" || $ngaysinh == "" || $gioitinh == "" || $diachi == "" || $sdtnv == "" || $email == "" || $tentaikhoan == "" || $matkhau == "") {
        $loi = 'Vui lòng điền đầy đủ thông tin';
        echo "<script type='text/javascript'>alert('$loi');</script>";
    } elseif ($row_ms > 0) {
        $loi_1 = 'Mã số nhân viên này đã có';
        echo "<script type='text/javascript'>alert('$loi_1');</script>";
    } elseif ($row_sdt > 0) {
        $loi_2 = 'Số điện thoại nhân viên này đã được sử dụng';
        echo "<script type='text/javascript'>alert('$loi_2');</script>";
    } elseif ($row_email > 0) {
        $loi_3 = 'Email này đã được sử dụng';
        echo "<script type='text/javascript'>alert('$loi_3');</script>";
    }elseif ($row_tk > 0) {
        $loi_4 = 'Tên tài khoản này đã được sử dụng';
        echo "<script type='text/javascript'>alert('$loi_4');</script>";
    } else {
        $sql = "INSERT INTO nhanvien (msnv, hoten, ngaysinh, gioitinh, diachi, sdtnv, email, tentaikhoan, matkhau, idcv)
        VALUE ('$msnv','$hoten', '$ngaysinh', '$gioitinh', '$diachi', '$sdtnv', '$email','$tentaikhoan','" . md5($matkhau) . "','$idcv')";
        $query = mysqli_query($connect, $sql);
        // header('location: index.php?page_admin=danhsachnhanvien');
?>
        <script type="text/javascript">
            location.href = 'index.php?page_admin=danhsachnhanvien';
        </script>
<?php
    }
}
?>
<div class="card">
    <div class="card-header">
        <h1>Thêm Nhân viên</h1>
    </div>
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Mã Nhân viên</label>
                <input type="text" name="msnv" class="form-control" require value="<?php echo isset($_POST['msnv']) ? $_POST['msnv'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="">Họ và tên Nhân viên</label>
                <input type="text" name="hoten" class="form-control" require value="<?php echo isset($_POST['hoten']) ? $_POST['hoten'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="">Ngày sinh : </label>
                <input type="date" name="ngaysinh" value="<?php echo isset($_POST['ngaysinh']) ? $_POST['ngaysinh'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="">Giới tính</label>
                <input type="text" name="gioitinh" class="form-control" require value="<?php echo isset($_POST['gioitinh']) ? $_POST['gioitinh'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="">Địa chỉ</label>
                <input type="text" name="diachi" class="form-control" require value="<?php echo isset($_POST['diachi']) ? $_POST['diachi'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="">Số điện thoại</label>
                <input type="text" name="sdtnv" class="form-control" require value="<?php echo isset($_POST['sdtnv']) ? $_POST['sdtnv'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="text" name="email" class="form-control" require value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="">Tên tài khoản</label>
                <input type="text" name="tentaikhoan" class="form-control" require value="<?php echo isset($_POST['tentaikhoan']) ? $_POST['tentaikhoan'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="">Mật khẩu</label>
                <input type="password" name="matkhau" class="form-control" require value="<?php echo isset($_POST['matkhau']) ? $_POST['matkhau'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="">Chức vụ</label>
                <select class="form-control" name="idcv">
                    <?php
                    while ($row_cv = mysqli_fetch_assoc($query_cv)) { ?>
                        <option value="<?php echo $row_cv['idcv']; ?>"><?php echo $row_cv['tenchucvu']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <button name="sbm" class="btn btn-success" type="sumit">Thêm</button>
        </form>
    </div>
</div>