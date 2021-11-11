<?php
$sql_kh = "SELECT * FROM khachhang ";
$query_kh = mysqli_query($connect, $sql_kh);

$sql_trangthai = "SELECT * FROM trangthai ";
$query_trangthai = mysqli_query($connect, $sql_trangthai);

if (isset($_POST['sbm'])) {
    $tenkh = $_POST['tenkh'];
    $sdt = $_POST['sdt'];
    $diachi = $_POST['diachi'];
    $email = $_POST['email'];
    $nghenghiep = $_POST['nghenghiep'];
    $tencongty = $_POST['tencongty'];
    $sove = $_POST['sove'];
    $ngaydangky = date('Y-m-d');
    $ngaykhoihanh = $_POST['ngaykhoihanh'];
    $diemkhoihanh = $_POST['diemkhoihanh'];
    $diemden = $_POST['diemden'];
    $idtrangthai = 1;
    $ngay = $ngaykhoihanh > $ngaydangky;

    $sql_idkh = "SELECT idkh FROM khachhang WHERE sdt = '$sdt' ";
    $query_idkh = mysqli_query($connect, $sql_idkh);
    $row = mysqli_fetch_row($query_idkh);
    $idkh_id = $row[0];

    if ($sdt == "" || $tenkh == "" || $diachi == "" || $email == "" || $nghenghiep == "" || $tencongty == "" || $sove == "" || $ngaykhoihanh == "" || $diemkhoihanh == "" || $diemden == "") {
        $loi = "Vui lòng điền đầy đủ thông tin";
        echo "<script type='text/javascript'>alert('$loi');</script>";
    }elseif($sove<=0){
        $loi_5 = "Số vé phải lớn hơn 0";
        echo "<script type='text/javascript'>alert('$loi_5');</script>";
    }
    elseif ($ngay == 0) {
        $loi_1 = "Ngày khởi hành không phù hợp";
        echo "<script type='text/javascript'>alert('$loi_1');</script>";
    } else {
        if (!isset($idkh_id)) {
            //nếu chưa có tt kh thì thêm mới kh và tiến hành đặt tour
            //kiểm tra email
            $sql_email = "SELECT email FROM khachhang WHERE email='$email'";
            $query_email =  mysqli_query($connect, $sql_email);
            $row_email = mysqli_num_rows($query_email);
            if ($row_email > 0) {
                $loi_4 = "Email đã được đăng ký vui lòng nhập email khác";
                echo "<script type='text/javascript'>alert('$loi_4');</script>";
            } else {
                $sql_add = "INSERT INTO khachhang (tenkh, diachi, sdt, email, nghenghiep, tencongty)
                VALUE ('$tenkh','$diachi','$sdt', '$email', '$nghenghiep', '$tencongty')";
                $query_add = mysqli_query($connect, $sql_add);

                $id_is = $connect->insert_id;
                // echo $id_is;
                $sql = "INSERT INTO phieudangkytour ( sove, ngaydangky, ngaykhoihanh, diemkhoihanh, diemden, idkh, idtrangthai)
                    VALUE ('$sove','$ngaydangky','$ngaykhoihanh','$diemkhoihanh','$diemden','$id_is','$idtrangthai')";
                // print_r($sql);exit;
                $query = mysqli_query($connect, $sql);
                // header('location: index.php?page_admin=danhsachphieudattour');
?>
                <script type="text/javascript">
                    location.href = 'index.php?page_admin=danhsachphieudangkytour';
                </script>
            <?php
            }
        } else {
            //nếu đã có thông tin theo sdt thì thêm tt vào
            $sql = "INSERT INTO phieudangkytour ( sove, ngaydangky, ngaykhoihanh, diemkhoihanh, diemden, idkh, idtrangthai)
            VALUE ('$sove','$ngaydangky','$ngaykhoihanh','$diemkhoihanh','$diemden','$idkh_id','$idtrangthai')";
            // print_r($sql);exit;
            $query = mysqli_query($connect, $sql);
            // thay đổi thông tin nếu khách hàng muốn thay đổi 
            $sql_up = "UPDATE khachhang SET  tenkh = '$tenkh',diachi ='$diachi', email= '$email', nghenghiep ='$nghenghiep',tencongty ='$tencongty' Where idkh ='$idkh_id'";
            $query = mysqli_query($connect, $sql_up);

            //header('location: index.php?page_admin=danhsachphieudangkytour');
            ?>
            <script type="text/javascript">
                location.href = 'index.php?page_admin=danhsachphieudangkytour';
            </script>
<?php
        }
    }
}
?>

<div class="card">
    <div class="card-header">
        <h1>Thêm Phiếu đăng ký tour</h1>
    </div>
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Số điện thoại </label>
                <input type="text" name="sdt" id="sdt_id" class="form-control" require value="<?php echo isset($_POST['sdt']) ? $_POST['sdt'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="">Họ tên </label>
                <input type="text" name="tenkh" id="tenkh_id" class="form-control" require value="<?php echo isset($_POST['tenkh']) ? $_POST['tenkh'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="">Địa chỉ </label>
                <input type="text" name="diachi" id="diachi_id" class="form-control" require value="<?php echo isset($_POST['diachi']) ? $_POST['diachi'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="">Email </label>
                <input type="email" name="email" id="email_id" class="form-control" require value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="">Nghề nghiệp </label>
                <input type="text" name="nghenghiep" id="nghenghiep_id" class="form-control" require value="<?php echo isset($_POST['nghenghiep']) ? $_POST['nghenghiep'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="">Tên Công ty </label>
                <input type="text" name="tencongty" id="tencongty_id" class="form-control" require value="<?php echo isset($_POST['tencongty']) ? $_POST['tencongty'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="">Số vé </label>
                <input type="number" name="sove" class="form-control" require value="<?php echo isset($_POST['sove']) ? $_POST['sove'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="">Ngày khởi hành </label>
                <input type="date" name="ngaykhoihanh" require value="<?php echo isset($_POST['ngaykhoihanh']) ? $_POST['ngaykhoihanh'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="">Điểm khởi hành</label>
                <input type="text" name="diemkhoihanh" class="form-control" require value="<?php echo isset($_POST['diemkhoihanh']) ? $_POST['diemkhoihanh'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="">Điểm đến</label>
                <input type="text" name="diemden" class="form-control" require value="<?php echo isset($_POST['diemden']) ? $_POST['diemden'] : ''; ?>">
            </div>
            <button name="sbm" class="btn btn-success" type="sumit">Thêm</button>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#sdt_id").change(function() {
            var sdt = $("#sdt_id").val();
            // alert(sdt);
            $.post('khachhang/layttkhachhang.php', {
                sodientthoai: sdt
            }, function(response) {
                // alert(response.hoten);
                var res = jQuery.parseJSON(response);
                // alert(res.hoten);
                // alert(res.email);
                $("#tenkh_id").val(res.tenkh);
                $("#diachi_id").val(res.diachi);
                $("#email_id").val(res.email);
                $("#nghenghiep_id").val(res.nghenghiep);
                $("#tencongty_id").val(res.tencongty);

                // $("#mypar").html(response.amount);
            });
        });

    });
</script>