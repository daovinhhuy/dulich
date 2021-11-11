<?php
$sql_tour = "SELECT * FROM tour ";
$query_tour = mysqli_query($connect, $sql_tour);

$sql_kh = "SELECT * FROM khachhang ";
$query_kh = mysqli_query($connect, $sql_kh);

$sql_trangthai = "SELECT * FROM trangthai ";
$query_trangthai = mysqli_query($connect, $sql_trangthai);

if (isset($_POST['sbm'])) {
    $tenkh = $_POST['tenkh'];
    $diachi = $_POST['diachi'];
    $sdt = $_POST['sdt'];
    $email = $_POST['email'];
    $nghenghiep = $_POST['nghenghiep'];
    $tencongty = $_POST['tencongty'];
    $sove = $_POST['sove'];
    $ngaydat = date('Y-m-d');
    $idtour = $_POST['idtour'];
    $idtrangthai = '1';
    //lấy được idkh đã có sdt
    $sql_idkh = "SELECT idkh FROM khachhang WHERE sdt = '$sdt' ";
    $query_idkh = mysqli_query($connect, $sql_idkh);
    $row = mysqli_fetch_row($query_idkh);
    $idkh_id = $row[0];

    $sql_ve = "SELECT t.*, v.tongsove, t.soluongkhach - v.tongsove soveconlai FROM tour t
	LEFT JOIN ( SELECT p.idtour, SUM( p.sove ) tongsove FROM phieudattour p WHERE p.idtour='$idtour' and p.idtrangthai <>3 GROUP BY p.idtour) v ON t.idtour = v.idtour
    WHERE t.idtour = '$idtour'";

    $query_ve = mysqli_query($connect, $sql_ve);
    $row_ve = mysqli_fetch_assoc($query_ve);
    // print_r($row_ve);exit;
    $tongsove = $row_ve['tongsove'];
    $soveconlai = $row_ve['soveconlai'];

    if ($tenkh == "" || $diachi == "" || $sdt == "" || $email == "" || $nghenghiep == "" || $tencongty == "" || $sove == "" || $idtour == "") {
        $loi = 'Vui lòng nhập đầy đủ thông tin';
        echo "<script type='text/javascript'>alert('$loi');</script>";
    }elseif($sove<=0){
        $loi_5 = "Số vé phải lớn hơn 0";
        echo "<script type='text/javascript'>alert('$loi_5');</script>";
    }else
    if ($soveconlai < $sove) {
        $loi_ve = "Số vé hiện tại của tour này chỉ còn " . $soveconlai . "";
        echo "<script type='text/javascript'>alert('$loi_ve');</script>";
    } else {
        if (!isset($idkh_id)) {
            //nếu chưa có tt kh thì thêm mới kh và tiến hành đặt tour
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
                $sql = "INSERT INTO phieudattour ( sove, ngaydat, idtour, idkh , idtrangthai)
                    VALUE ('$sove', '$ngaydat', '$idtour','$id_is','$idtrangthai') ";
                $query = mysqli_query($connect, $sql);
                // header('location: index.php?page_admin=danhsachphieudattour');
?>
                <script type="text/javascript">
                    location.href = 'index.php?page_admin=danhsachphieudattour';
                </script>
            <?php
            }
        } else {
            //nếu đã có thông tin theo sdt thì thêm tt vào
            $sql_thongtin = "INSERT INTO phieudattour ( sove, ngaydat, idtour, idkh , idtrangthai)
            VALUE ('$sove', '$ngaydat', '$idtour','$idkh_id','$idtrangthai') ";
            $query = mysqli_query($connect, $sql_thongtin);
            // thay đổi thông tin nếu khách hàng muốn thay đổi 
            $sql_up = "UPDATE khachhang SET  tenkh = '$tenkh',diachi ='$diachi', email= '$email', nghenghiep ='$nghenghiep',tencongty ='$tencongty' Where idkh ='$idkh_id'";
            $query = mysqli_query($connect, $sql_up);
            ?>
            <script type="text/javascript">
                location.href = 'index.php?page_admin=danhsachphieudattour';
            </script>
<?php
        }
    }
}
?>
<div class="card">
    <div class="card-header">
        <h1>Thêm Phiếu đặt tour</h1>
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
                <label for="">Công ty </label>
                <input type="text" name="tencongty" id="tencongty_id" class="form-control" require value="<?php echo isset($_POST['tencongty']) ? $_POST['tencongty'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="">Số vé </label>
                <input type="text" name="sove" class="form-control" require value="<?php echo isset($_POST['sove']) ? $_POST['sove'] : ''; ?>">
            </div>

            <div class="form-group">
                <label for="">Tour</label>
                <select class="form-control" name="idtour">
                    <?php
                    while ($row_tour = mysqli_fetch_assoc($query_tour)) { ?>
                        <option value="<?php echo $row_tour['idtour']; ?>"><?php echo $row_tour['tentour']; ?></option>
                    <?php } ?>
                </select>
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
                $("#tenkh_id").val(res.tenkh);
                $("#diachi_id").val(res.diachi);
                $("#email_id").val(res.email);
                $("#nghenghiep_id").val(res.nghenghiep);
                $("#tencongty_id").val(res.tencongty);
            });
        });
    });
</script>