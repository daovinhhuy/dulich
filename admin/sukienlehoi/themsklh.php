<?php
$sql_ddl = "SELECT * FROM diemdulich ";
$query_ddl = mysqli_query($connect, $sql_ddl);


if (isset($_POST['sbm'])) {
    $mssklh = $_POST['mssklh'];
    $tensklh = $_POST['tensklh'];

    $hinhanhsklh = $_FILES['hinhanhsklh']['name'];
    $hinhanhsklh_tmp = $_FILES['hinhanhsklh']['tmp_name'];

    $thoigiandienra = $_POST['thoigiandienra'];
    $noidienra = $_POST['noidienra'];
    $gioithieusklh = $_POST['gioithieusklh'];
    $iddiemdulich = $_POST['iddiemdulich'];

    $sql_ms = "SELECT mssklh FROM sukienlehoi WHERE mssklh='$mssklh'";
    $query_ms =  mysqli_query($connect, $sql_ms);
    $row_ms = mysqli_num_rows($query_ms);
    if($mssklh==""||$tensklh==""||$thoigiandienra==""||$noidienra==""||$gioithieusklh==""||$iddiemdulich==""){
        $loi ='Vui lòng nhập đầy đủ thông tin';
        echo "<script type='text/javascript'>alert('$loi');</script>";
    }elseif($row_ms>0){
        $loi_1 ='Mã số sự kiện lễ hội đã có';
        echo "<script type='text/javascript'>alert('$loi_1');</script>";
    }else{
    $sql = "INSERT INTO sukienlehoi (mssklh, tensklh,  thoigiandienra, noidienra, gioithieusklh, iddiemdulich)
        VALUE ('$mssklh','$tensklh', '$thoigiandienra', '$noidienra', '$gioithieusklh', '$iddiemdulich')";
    $query = mysqli_query($connect, $sql);
    move_uploaded_file($hinhanhsklh_tmp, '../img/sklh/' . $connect->insert_id);
    // header('location: index.php?page_admin=danhsachsklh');
    ?>
    <script type="text/javascript">location.href = 'index.php?page_admin=danhsachsklh';</script>
<?php
}
}
?>

<div class="card">
    <div class="card-header">
        <h1>Thêm Sự kiện - Lễ hội</h1>
    </div>
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Mã Sự kiện- Lễ hội</label>
                <input type="text" name="mssklh" class="form-control" require value="<?php echo isset($_POST['mssklh']) ? $_POST['mssklh'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="">Tên Sự kiện- Lễ hội</label>
                <input type="text" name="tensklh" class="form-control" require value="<?php echo isset($_POST['tensklh']) ? $_POST['tensklh'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="">Hình ảnh</label>
                <input type="file" name="hinhanhsklh">
            </div>
            <div class="form-group">
                <label for="">Thời gian diễn ra</label>
                <input type="text" name="thoigiandienra" class="form-control" require value="<?php echo isset($_POST['thoigiandienra']) ? $_POST['thoigiandienra'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="">Nơi diễn ra</label>
                <input type="text" name="noidienra" class="form-control" require value="<?php echo isset($_POST['noidienra']) ? $_POST['noidienra'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="">Giới thiệu</label>
                <input type="text" name="gioithieusklh" class="form-control" require value="<?php echo isset($_POST['gioithieusklh']) ? $_POST['gioithieusklh'] : ''; ?>">
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