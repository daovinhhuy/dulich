<?php
if (isset($_POST['sbm'])) {
    $tenloaitour = $_POST['tenloaitour'];
    $sql_ten = "SELECT tenloaitour FROM loaitour WHERE tenloaitour='$tenloaitour'";
    $query_ten =  mysqli_query($connect, $sql_ten);
    $row_ten = mysqli_num_rows($query_ten);

    if ($tenloaitour == "") {
        $loi_1 = "Vui lòng điền đầy đủ thông tin";
        echo "<script type='text/javascript'>alert('$loi_1');</script>";
    } elseif ($row_ten > 0) {
        $loi = "Tên loại tour đã tồn tại !";
        echo "<script type='text/javascript'>alert('$loi');</script>";
    } else {
        $sql = "INSERT INTO loaitour (tenloaitour)
        VALUE ('$tenloaitour')";
        $query = mysqli_query($connect, $sql);
        // header('location: index.php?page_admin=danhsachloaitour');
?>
        <script type="text/javascript">
            location.href = 'index.php?page_admin=danhsachloaitour';
        </script>
<?php
    }
}
?>
<div class="card">
    <div class="card-header">
        <h1>Thêm Loại tour</h1>
    </div>
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Tên Loại tour</label>
                <input type="text" name="tenloaitour" class="form-control" require>
            </div>
            <button name="sbm" class="btn btn-success" type="sumit">Thêm</button>
        </form>
    </div>
</div>