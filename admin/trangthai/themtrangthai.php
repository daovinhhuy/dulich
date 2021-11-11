<?php
if (isset($_POST['sbm'])) {
    $tentrangthai = $_POST['tentrangthai'];
    $sql = "INSERT INTO trangthai (tentrangthai) VALUE ('$tentrangthai')";
    $query = mysqli_query($connect, $sql);
    // header('location: index.php?page_admin=danhsachtrangthai');
?>
    <script type="text/javascript">location.href = 'index.php?page_admin=danhsachtintuc';</script>
<?php
}
?>
<div class="card">
    <div class="card-header">
        <h1>Thêm Trạng thái</h1>
    </div>
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Tên Trạng thái</label>
                <input type="text" name="tentrangthai" class="form-control" require>
            </div>
            <button name="sbm" class="btn btn-success" type="sumit">Thêm</button>
        </form>
    </div>
</div>