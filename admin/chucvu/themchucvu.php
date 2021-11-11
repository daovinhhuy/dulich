<?php 
    if(isset($_POST['sbm'])){
        $mscv = $_POST['mscv'];
        $tenchucvu = $_POST['tenchucvu'];
        
    $sql_ms = "SELECT mscv FROM chucvu WHERE mscv='$mscv'";
    $query_ms =  mysqli_query($connect, $sql_ms);
    $row_ms = mysqli_num_rows($query_ms);

    $sql_ten = "SELECT tenchucvu FROM chucvu WHERE tenchucvu='$tenchucvu'";
    $query_ten =  mysqli_query($connect, $sql_ten);
    $row_ten = mysqli_num_rows($query_ten);

    if($tenchucvu==""||$mscv==""){
        $loi = "Vui lòng nhập đầy đủ thông tin";
        echo "<script type='text/javascript'>alert('$loi');</script>";
    }elseif($row_ms>0){
        $loi_1 = "Mã số chức vụ ".$mscv." đã có ";
        echo "<script type='text/javascript'>alert('$loi_1');</script>";
    }elseif($row_ten>0){
        $loi_2 = "Tên chức vụ ".$tenchucvu." đã có";
        echo "<script type='text/javascript'>alert('$loi_2');</script>";
    }else{
        $sql = "INSERT INTO chucvu (mscv ,tenchucvu)
        VALUE ('$mscv','$tenchucvu')";
        $query = mysqli_query($connect, $sql);
        // header('location: index.php?page_admin=danhsachchucvu');
    ?>
        <script type="text/javascript">location.href = 'index.php?page_admin=danhsachchucvu';</script>
<?php
    }
    }
?>

    <div class="card"> 
        <div class ="card-header">
            <h1>Thêm Chức vụ</h1>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                    <label for="">Mã Chức vụ</label>
                    <input type="text" name = "mscv"  class="form-control" require value="<?php echo isset($_POST['mscv']) ? $_POST['mscv'] : ''; ?>">
                </div>    
            <div class="form-group">
                    <label for="">Tên Chức vụ</label>
                    <input type="text" name = "tenchucvu"  class="form-control" require value="<?php echo isset($_POST['tenchucvu']) ? $_POST['tenchucvu'] : ''; ?>">
                </div>
                <button name="sbm" class = "btn btn-success" type="sumit">Thêm</button>
            </form>
        </div>
    </div>
