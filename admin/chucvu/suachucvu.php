<?php
$id = $_GET['idcv'];
$sql_cv = "SELECT * FROM chucvu WHERE idcv = $id";
$query_cv = mysqli_query($connect, $sql_cv);
$row_up = mysqli_fetch_assoc($query_cv);

if (isset($_POST['sbm'])) {
    $mscv = $_POST['mscv'];
    $tenchucvu = $_POST['tenchucvu'];

    if ($tenchucvu == "" || $mscv == "") {
        $loi = "Vui lòng không để trống thông tin";
        echo "<script type='text/javascript'>alert('$loi');</script>";
    } else {
        $sql = "UPDATE chucvu SET mscv = '$mscv', tenchucvu = '$tenchucvu' Where idcv ='$id'";
        $query = mysqli_query($connect, $sql);
        // header('location: index.php?page_admin=danhsachchucvu');
?>
        <script type="text/javascript">
            location.href = 'index.php?page_admin=danhsachchucvu';
        </script>
<?php
    }
}
?>

<div class="card">
    <div class="card-header">
        <h1>Sửa Chức vụ</h1>
    </div>
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Mã Chức vụ</label>
                <input type="text" name="mscv" class="form-control" require value="<?php echo $row_up['mscv']; ?>">
            </div>
            <div class="form-group">
                <label for="">Tên Chức vụ</label>
                <input type="text" name="tenchucvu" class="form-control" require value="<?php echo $row_up['tenchucvu']; ?>">
            </div>
            <button name="sbm" class="btn btn-success" type="sumit">Sửa</button>

        </form>
    </div>
</div>