<?php
$id = $_GET['idtinhthanh'];
$sql_tt = "SELECT * FROM tinhthanh WHERE idtinhthanh = $id";
$query_tt = mysqli_query($connect, $sql_tt);
$row_up = mysqli_fetch_assoc($query_tt);

if (isset($_POST['sbm'])) {
    $mstinhthanh = $_POST['mstinhthanh'];
    $tentinhthanh = $_POST['tentinhthanh'];
    if($tentinhthanh==""||$mstinhthanh==""){
        $loi = "Vui lòng nhập đầy đủ thông tin";
        echo "<script type='text/javascript'>alert('$loi');</script>";
    }else{
        $sql = "UPDATE tinhthanh SET mstinhthanh = '$mstinhthanh' , tentinhthanh = '$tentinhthanh' Where idtinhthanh ='$id'";
        $query = mysqli_query($connect, $sql);
    // header('location: index.php?page_admin=danhsachtinhthanh');
    ?>
    <script type="text/javascript">location.href = 'index.php?page_admin=danhsachtinhthanh';</script>
    <?php
}
}
?>

<div class="card">
    <div class="card-header">
        <h1>Sửa Tỉnh thành</h1>
    </div>
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Mã tỉnh thành</label>
                <input type="text" name="mstinhthanh" class="form-control" require value="<?php echo $row_up['mstinhthanh']; ?>">
            </div>
            <div class="form-group">
                <label for="">Tên tỉnh thành</label>
                <input type="text" name="tentinhthanh" class="form-control" require value="<?php echo $row_up['tentinhthanh']; ?>">
            </div>
            <button name="sbm" class="btn btn-success" type="sumit">Sửa</button>
        </form>
    </div>
</div>