<?php
$idtintuc = $_GET['idtintuc'];

$sql_tintuc = "SELECT * FROM tintuc WHERE idtintuc = $idtintuc";
$query_tintuc = mysqli_query($connect, $sql_tintuc);
$row_up = mysqli_fetch_assoc($query_tintuc);

if (isset($_POST['sbm'])) {
    $tentintuc = $_POST['tentintuc'];
    $noidung = $_POST['noidung'];
    if ($_FILES['hinhanhtt']['name'] == '') {
        $idtintuc = $row_up['idtintuc'];
    } else {
        $path_user = '../img/tintuc/';
        if (!file_exists($path_user)) {
            mkdir($path_user, 0777, false);
        }
        else if (file_exists($path_user . $idtintuc)) {
            unlink($path_user . $idtintuc);
        }
        move_uploaded_file($_FILES['hinhanhtt']['tmp_name'], $path_user . $idtintuc);
    }
    if($tentintuc==""||$noidung==""){
        $loi_1 ="Vui lòng không để trống thông tin";
        echo "<script type='text/javascript'>alert('$loi_1');</script>";
    }else{
        $sql = "UPDATE tintuc SET tentintuc = '$tentintuc',noidung ='$noidung' Where idtintuc ='$idtintuc'";
        $query = mysqli_query($connect, $sql);
        // header('location: index.php?page_admin=danhsachtintuc');
    ?>
        <script type="text/javascript">location.href = 'index.php?page_admin=danhsachtintuc';</script>
<?php
    }
}
?>

<div class="card">
    <div class="card-header">
        <h1>Sửa Tin tức</h1>
    </div>
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Tên Tin tức</label>
                <input type="text" name="tentintuc" class="form-control" require value="<?php echo $row_up['tentintuc']; ?>">
            </div>
            <div class="form-group">
                <label for="">Hình ảnh</label>
                <input type="file" name="hinhanhtt" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Nội dung</label>
                <input type="text" name="noidung" class="form-control" require value="<?php echo $row_up['noidung']; ?>">
            </div>
            <button name="sbm" class="btn btn-success" type="sumit">Sửa</button>
        </form>
    </div>
</div>