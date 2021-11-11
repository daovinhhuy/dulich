<?php
$sql_tour = "SELECT * FROM tour ";
$query_tour = mysqli_query($connect, $sql_tour);

$sql_ddl = "SELECT * FROM diemdulich ";
$query_ddl = mysqli_query($connect, $sql_ddl);

if (isset($_POST['sbm'])) {
    $ngay = $_POST['ngay'];
    $thoigian = $_POST['thoigian'];
    $hoatdong = $_POST['hoatdong'];
    $idtour = $_POST['idtour'];
    $iddiemdulich = $_POST['iddiemdulich'];

    $sql_ngay = "SELECT * FROM tour WHERE idtour = '$idtour' AND '$ngay' BETWEEN ngaykhoihanh AND ngayketthuc";
    $query_ngay = mysqli_query($connect, $sql_ngay);
    if (mysqli_num_rows($query_ngay)==0) {
        $loi = "Ngày không thuộc tour ! Vui lòng chọn ngày phù hợp";
        echo "<script type='text/javascript'>alert('$loi');</script>";;
    } else if ($ngay == "" || $thoigian == "" || $hoatdong == "") {
        $loi_1 = "vui lòng điền đầy đủ thông tin";
        echo "<script type='text/javascript'>alert('$loi_1');</script>";;
    } else {
        $sql = "INSERT INTO chitietlt (ngay, thoigian, hoatdong, idtour, iddiemdulich)
        VALUE ('$ngay', '$thoigian','$hoatdong' , '$idtour', '$iddiemdulich')";
        $query = mysqli_query($connect, $sql);
        // header('location: index.php?page_admin=danhsachchitietlt');
?>
        <script type="text/javascript">location.href = 'index.php?page_admin=danhsachchitietlt';</script>
<?php
    }
}
?>

<div class="card">
    <div class="card-header">
        <h1>Thêm Lịch trình</h1>
    </div>
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Ngày :</label>
                <input type="date" name="ngay" require value="<?php echo isset($_POST['ngay']) ? $_POST['ngay'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="">Thời gian</label>
                <input type="text" name="thoigian" class="form-control" require value="<?php echo isset($_POST['thoigian']) ? $_POST['thoigian'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="">Hoạt động</label>
                <input type="text" name="hoatdong" class="form-control" require value="<?php echo isset($_POST['hoatdong']) ? $_POST['hoatdong'] : ''; ?>">
            </div>

            <div class="form-group">
                <label for="">Tour</label>
                <select class="form-control" name="idtour">
                    <?php
                    while ($row_tour = mysqli_fetch_assoc($query_tour)) { ?>
                        <option value="<?php echo $row_tour['idtour']; ?>"><?php echo $row_tour['tentour'] . " ( từ " . $row_tour['ngaykhoihanh'] . " đến " . $row_tour['ngayketthuc'] . ")"; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Điểm du lịch</label>
                <select class="form-control" name="iddiemdulich">
                    <?php
                    while ($row_ddl = mysqli_fetch_assoc($query_ddl)) { ?>
                        <option value="<?php echo $row_ddl['iddiemdulich']; ?>"><?php echo $row_ddl['tendiemdulich']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <button name="sbm" class="btn btn-success" type="sumit">Thêm</button>
        </form>
    </div>
</div>