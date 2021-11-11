<?php
$id = $_GET['idtrangthai'];
$sql_tt = "SELECT * FROM trangthai WHERE idtrangthai = $id";
$query_tt = mysqli_query($connect, $sql_tt);
$row_up = mysqli_fetch_assoc($query_tt);

if (isset($_POST['sbm'])) {
    $tentrangthai = $_POST['tentrangthai'];
    $sql = "UPDATE trangthai SET tentrangthai = '$tentrangthai' Where idtrangthai ='$id'";
    $query = mysqli_query($connect, $sql);
    // header('location: index.php?page_admin=danhsachtrangthai');
?>
    <script type="text/javascript">location.href = 'index.php?page_admin=danhsachtintuc';</script>
<?php
}
?>

<div class="card">
    <div class="card-header">
        <h1>Sửa Trạng thái</h1>
    </div>
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Tên Trạng thái</label>
                <input type="text" name="tentrangthai" class="form-control" require value="<?php echo $row_up['tentrangthai']; ?>">
            </div>
            <button name="sbm" class="btn btn-success" type="sumit">Sửa</button>
        </form>
    </div>
</div>