<?php
if (isset($_POST['sbm'])) {
    $tentintuc = $_POST['tentintuc'];

    $hinhanhtt = $_FILES['hinhanhtt']['name'];
    $hinhanhtt_tmp = $_FILES['hinhanhtt']['tmp_name'];

    $noidung = $_POST['noidung'];
    $ngaydang = date('Y-m-d');
    if ($tentintuc == "" || $hinhanhtt == "" || $noidung == "") {
        $loi_1 = "Vui lòng điền đầy đủ thông tin";
        echo "<script type='text/javascript'>alert('$loi_1');</script>";
    } else {
        $sql = "INSERT INTO tintuc (tentintuc, noidung, ngaydang)
        VALUE ('$tentintuc', '$noidung', '$ngaydang')";
        $query = mysqli_query($connect, $sql);
        move_uploaded_file($hinhanhtt_tmp, '../img/tintuc/' . $connect->insert_id);
        // header('location: index.php?page_admin=danhsachtintuc');
?>
        <script type="text/javascript">
            location.href = 'index.php?page_admin=danhsachtintuc';
        </script>
<?php
    }
}
?>

<div class="card">
    <div class="card-header">
        <h1>Thêm Tin tức</h1>
    </div>
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Tên Tin tức</label>
                <input type="text" name="tentintuc" class="form-control" require value="<?php echo isset($_POST['tentintuc']) ? $_POST['tentintuc'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="">Hình ảnh</label>
                <input type="file" name="hinhanhtt">
            </div>
            <div class="form-group">
                <label for="">Nội dung</label>
                <input type="text" name="noidung" class="form-control"  require value="<?php echo isset($_POST['noidung']) ? $_POST['noidung'] : ''; ?>"></input>
            </div>
            <button name="sbm" class="btn btn-success" type="sumit"> Thêm</button>
        </form>
    </div>
</div>