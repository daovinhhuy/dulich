<?php
$idphieu = $_GET['idphieu'];

function bindTourList($connect, $Value)
{
    $ListTour = mysqli_query($connect, "SELECT idtour, tentour from tour");
    echo "<select name='idtour' class='form-control'>";
    while ($row = mysqli_fetch_array($ListTour)) {
        if ($row['idtour'] == $Value) {
            echo "<option value='" . $row['idtour'] . "' selected>" . $row['tentour'] . "</option>";
        } else echo "<option value='" . $row['idtour'] . "'>" . $row['tentour'] . "</option>";
    }
    echo "</select>";
}

$sql_kh = "SELECT * FROM khachhang ";
$query_kh = mysqli_query($connect, $sql_kh);

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

$sql_pdt = "SELECT * FROM phieudattour WHERE idphieu = $idphieu";
$query_pdt = mysqli_query($connect, $sql_pdt);
$row_up = mysqli_fetch_assoc($query_pdt);

if (isset($_POST['sbm'])) {
    $sophieu = $_POST['sophieu'];
    $sove = $_POST['sove'];
    $idtour = $_POST['idtour'];
    $idtrangthai = $_POST['idtrangthai'];

    $sql_ms = "SELECT sophieu FROM phieudattour WHERE sophieu='$sophieu'";
    $query_ms =  mysqli_query($connect, $sql_ms);
    $row_ms = mysqli_num_rows($query_ms);

    $sql_ve = "SELECT t.*, v.tongsove, t.soluongkhach - v.tongsove soveconlai FROM tour t
	LEFT JOIN ( SELECT p.idtour, SUM( p.sove ) tongsove FROM phieudattour p WHERE p.idtour='$idtour' and p.idtrangthai <>3 GROUP BY p.idtour) v ON t.idtour = v.idtour
    WHERE t.idtour = '$idtour'";

    $query_ve = mysqli_query($connect, $sql_ve);
    $row_ve = mysqli_fetch_assoc($query_ve);
    $tongsove = $row_ve['tongsove'];
    $soveconlai = $row_ve['soveconlai'];
    if($sophieu==""||$sove==""){
        $loi ='Vui lòng không để trống thông tin';
        echo "<script type='text/javascript'>alert('$loi');</script>";
    }
    elseif($row_ms>0){
        $loi_1 ='Số phiếu đã tồn tại ! Vui lòng sử dụng số phiếu khác';
        echo "<script type='text/javascript'>alert('$loi_1');</script>";
    }
    elseif($soveconlai<$sove){
        $loi_2 ="Số vé hiện tại của tour này chỉ còn " . $soveconlai . "";
        echo "<script type='text/javascript'>alert('$loi_2');</script>";
    }
    else{
        $sql = "UPDATE phieudattour SET sophieu = '$sophieu', sove ='$sove', idtour ='$idtour', idtrangthai ='$idtrangthai'
        Where idphieu ='$idphieu'";
    $query = mysqli_query($connect, $sql);
?>
    <script type="text/javascript">location.href = 'index.php?page_admin=danhsachphieudattour';</script>
<?php
    }
}
?>
<div class="card">
    <div class="card-header">
        <h1>Sửa Phiếu đặt tour</h1>
    </div>
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Số phiếu</label>
                <input type="text" name="sophieu" class="form-control" require value="<?php echo isset($_POST['sophieu']) ? $_POST['sophieu'] : $row_up['sophieu']; ?>">
            </div>
            <div class="form-group">
                <label for="">Số vé </label>
                <input type="text" name="sove" class="form-control" require value="<?php echo $row_up['sove']; ?>">
            </div>
            <div class="form-group">
                <label for="">Tour </label>
                <?php bindTourList($connect, $row_up['idtour']); ?>
            </div>
            <div class="form-group">
                <label for="">Trạng thái</label>
                <?php bindTThaiList($connect, $row_up['idtrangthai']); ?>
            </div>
            <button name="sbm" class="btn btn-success" type="sumit">Sửa</button>
        </form>
    </div>
</div>