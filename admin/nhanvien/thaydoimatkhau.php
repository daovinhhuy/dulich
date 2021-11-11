<?php
$id = $_GET['idnhanvien'];
if (isset($_POST['sbm'])) {
    $matkhau1 = $_POST['matkhau1'];
    $matkhau2 = $_POST['matkhau2'];
    $matkhau3 = $_POST['matkhau3'];

    $ss = $matkhau2 == $matkhau3;
    $matkhau1 = md5($matkhau1);
    $sql = "SELECT * FROM nhanvien WHERE matkhau='" . $matkhau1 . "'";
    $result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
    if (mysqli_num_rows($result) == 0) {
        $loi = "Mật khẩu cũ không đúng";
        echo  "<script type='text/javascript'>alert('$loi');</script>";
    } else {
        if($matkhau2==""){
            $loi_2 = "Bạn chưa nhập mật khẩu mới";
            echo  "<script type='text/javascript'>alert('$loi_2');</script>";
        }else if($matkhau3==""){
            $loi_3 ="Bạn chưa nhập lại mật khẩu mới";
            echo  "<script type='text/javascript'>alert('$loi_3');</script>";
        }
        else if ($ss == 0) {
            $loi_1 = "Mật khẩu mới và nhập lại không giống nhau";
            echo  "<script type='text/javascript'>alert('$loi_1');</script>";
        } else {
            $matkhau2 = md5($matkhau2);
            $sql_mk = "UPDATE nhanvien SET matkhau ='$matkhau2' WHERE idnhanvien ='$id' ";
            $query_mk = mysqli_query($connect, $sql_mk);
            $tc = "Thay đổi mật khẩu thành công";
            echo  "<script type='text/javascript'>alert('$tc');</script>";
?>
            <script type="text/javascript">location.href = 'index.php?page_admin=danhsachnhanvien';</script>
<?php
        }
    }
}
?>
<div class="card">
    <div class="card-header">
        <h1>Thay đổi mật khẩu</h1>
    </div>
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Nhập mật khẩu cũ</label>
                <input type="password" name="matkhau1" id="password1" class="form-control" value="<?php echo isset($_POST['matkhau1']) ? $_POST['matkhau1'] : ''; ?>">
                <input type="button" id="showPassword1" value="Hiện" class="button">
            </div>
            <div class="form-group">
                <label for="">Nhập mật khẩu mới</label>
                <input type="password" name="matkhau2" id="password2" class="form-control" value="<?php echo isset($_POST['matkhau2']) ? $_POST['matkhau2'] : ''; ?>">
                <input type="button" id="showPassword2" value="Hiện" class="button">
            </div>
            <div class="form-group">
                <label for="">Nhập lại mật khẩu mới</label>
                <input type="password" name="matkhau3" id="password3" class="form-control" value="<?php echo isset($_POST['matkhau3']) ? $_POST['matkhau3'] : ''; ?>">
                <input type="button" id="showPassword3" value="Hiện" class="button">
            </div>
            <button name="sbm" class="btn btn-success" type="sumit">Xác nhận</button>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#showPassword1').on('click', function() {
            var passwordField = $('#password1');
            var passwordFieldType = passwordField.attr('type');
            if (passwordFieldType == 'password') {
                passwordField.attr('type', 'text');
                $(this).val('Ẩn');
            } else {
                passwordField.attr('type', 'password');
                $(this).val('Hiện');
            }
        });
        $('#showPassword2').on('click', function() {
            var passwordField = $('#password2');
            var passwordFieldType = passwordField.attr('type');
            if (passwordFieldType == 'password') {
                passwordField.attr('type', 'text');
                $(this).val('Ẩn');
            } else {
                passwordField.attr('type', 'password');
                $(this).val('Hiện');
            }
        });
        $('#showPassword3').on('click', function() {
            var passwordField = $('#password3');
            var passwordFieldType = passwordField.attr('type');
            if (passwordFieldType == 'password') {
                passwordField.attr('type', 'text');
                $(this).val('Ẩn');
            } else {
                passwordField.attr('type', 'password');
                $(this).val('Hiện');
            }
        });
    });
</script>