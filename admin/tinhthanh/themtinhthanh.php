<?php
if (isset($_POST['sbm'])) {
    $mstinhthanh = $_POST['mstinhthanh'];
    $tentinhthanh = $_POST['tentinhthanh'];

    $sql_ms = "SELECT mstinhthanh FROM tinhthanh WHERE mstinhthanh='$mstinhthanh'";
    $query_ms =  mysqli_query($connect, $sql_ms);
    $row_ms = mysqli_num_rows($query_ms);

    $sql_ten = "SELECT tentinhthanh FROM tinhthanh WHERE tentinhthanh='$tentinhthanh'";
    $query_ten =  mysqli_query($connect, $sql_ten);
    $row_ten = mysqli_num_rows($query_ten);

    if($tentinhthanh==""||$mstinhthanh==""){
        $loi = "Vui lòng nhập đầy đủ thông tin";
        echo "<script type='text/javascript'>alert('$loi');</script>";
    }elseif($row_ms>0){
        $loi_1 = "Mã số tỉnh thành ".$mstinhthanh." đã có ";
        echo "<script type='text/javascript'>alert('$loi_1');</script>";
    }elseif($row_ten>0){
        $loi_2 = "Tên tỉnh thành ".$tentinhthanh." đã có";
        echo "<script type='text/javascript'>alert('$loi_2');</script>";
    }else{
        $sql = "INSERT INTO tinhthanh (mstinhthanh, tentinhthanh)
        VALUE ('$mstinhthanh', '$tentinhthanh')";
        $query = mysqli_query($connect, $sql);
    // header('location:index.php?page_admin=danhsachtinhthanh');
?>  
    <script type="text/javascript">location.href = 'index.php?page_admin=danhsachtinhthanh';</script>
<?php 
    }
}
?>

<div class="card">
    <div class="card-header">
        <h1>Thêm Tỉnh thành</h1>
    </div>
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Mã Tỉnh thành</label>
                <input type="text" name="mstinhthanh" class="form-control" require value="<?php echo isset($_POST['mstinhthanh']) ? $_POST['mstinhthanh'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="">Tên Tỉnh thành</label>
                <input type="text" name="tentinhthanh" class="form-control" require value="<?php echo isset($_POST['tentinhthanh']) ? $_POST['tentinhthanh'] : ''; ?>">
            </div>
            <button name="sbm" class="btn btn-success" type="sumit">Thêm</button>
        </form>
    </div>
</div>
