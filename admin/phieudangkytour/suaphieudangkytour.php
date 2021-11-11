<?php
$idphieudangky = $_GET['idphieudangky'];

function bindTThaiList($connect, $Value)
{
    $ListTThai = mysqli_query($connect, "SELECT idtrangthai, tentrangthai from trangthai");
    echo "<select name='idtrangthai' class='form-control'>";
    while ($row = mysqli_fetch_array($ListTThai)) {
        if ($row['idtrangthai'] == $Value) {
            echo "<option value='" . $row['idtrangthai'] . "' selected>" . $row['tentrangthai'] . "</option>";
        } else echo "<option value='" . $row['idtrangthai'] . "'>" . $row['tentrangthai'] . "</option>";
    }
    echo "</select>";
}

$sql_pdk = "SELECT * FROM phieudangkytour WHERE idphieudangky = $idphieudangky";
$query_pdk = mysqli_query($connect, $sql_pdk);
$row_up = mysqli_fetch_assoc($query_pdk);

if (isset($_POST['sbm'])) {
    $sove = $_POST['sove'];
    $ngaykhoihanh = $_POST['ngaykhoihanh'];
    $diemkhoihanh = $_POST['diemkhoihanh'];
    $diemden = $_POST['diemden'];
    $idtrangthai = $_POST['idtrangthai'];
    $ngayhienhanh =date('Y-m-d');
    $ngay = $ngaykhoihanh > $ngayhienhanh;
    if ( $sove == "" || $ngaykhoihanh == "" || $diemkhoihanh == "" || $diemden == "") {
        $loi = "Vui lòng không để trống thông tin";
        echo "<script type='text/javascript'>alert('$loi');</script>";
    }elseif($ngay==0){
        $loi_1 = "Ngày khởi hành không phù hợp";
        echo "<script type='text/javascript'>alert('$loi_1');</script>";
    }else{
        $sql = "UPDATE phieudangkytour SET sove ='$sove', ngaykhoihanh ='$ngaykhoihanh', diemkhoihanh='$diemkhoihanh',diemden ='$diemden'
            ,idtrangthai ='$idtrangthai' Where idphieudangky ='$idphieudangky'";
        $query = mysqli_query($connect, $sql);
    // header('location: index.php?page_admin=danhsachphieudangkytour');
?>
    <script type="text/javascript">location.href = 'index.php?page_admin=danhsachphieudangkytour';</script>
<?php
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
                <label for="">Số vé </label>
                <input type="number" name="sove" class="form-control" require value="<?php echo $row_up['sove']; ?>">
            </div>
            <div class="form-group">
                <label for="">Ngày khởi hành </label>
                <input type="date" name="ngaykhoihanh" class="form-control" require value="<?php echo $row_up['ngaykhoihanh']; ?>">
            </div>
            <div class="form-group">
                <label for="">Điểm khởi hành</label>
                <input type="text" name="diemkhoihanh" class="form-control" require value="<?php echo $row_up['diemkhoihanh']; ?>">
            </div>
            <div class="form-group">
                <label for="">Điểm đến</label>
                <input type="text" name="diemden" class="form-control" require value="<?php echo $row_up['diemden']; ?>">
            </div>
            <div class="form-group">
                <label for="">Trạng thái</label>
                    <?php bindTThaiList($connect, $row_up['idtrangthai']); ?>
            </div>
            <button name="sbm" class="btn btn-success" type="sumit">Sửa</button>

        </form>
    </div>
</div>