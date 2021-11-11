<?php 
    if(isset($_POST['sbm'])){
        $mskh = $_POST['mskh'];
        $tenkh = $_POST['tenkh'];
        $diachi = $_POST['diachi'];
        $sdt = $_POST['sdt'];
        $email = $_POST['email'];
        $nghenghiep = $_POST['nghenghiep'];
        $tencongty = $_POST['tencongty'];

        $sql_ms = "SELECT mskh FROM khachhang WHERE mskh='$mskh'";
        $query_ms =  mysqli_query($connect, $sql_ms);
        $row_ms = mysqli_num_rows($query_ms);

        $sql_sdt = "SELECT sdt FROM khachhang WHERE sdt='$sdt'";
        $query_sdt =  mysqli_query($connect, $sql_sdt);
        $row_sdt = mysqli_num_rows($query_sdt);

        $sql_email = "SELECT email FROM khachhang WHERE email='$email'";
        $query_email =  mysqli_query($connect, $sql_email);
        $row_email = mysqli_num_rows($query_email);

        if($mskh==""||$tenkh==""||$diachi==""||$sdt==""||$email==""||$nghenghiep==""||$tencongty==""){
            $loi="Vui lòng không để trống thông tin";
            echo "<script type='text/javascript'>alert('$loi');</script>";
        }elseif($row_ms>0){
            $loi_1="Mã khách hàng ".$mskh." này đã được sử dụng";
            echo "<script type='text/javascript'>alert('$loi_1');</script>";
        }elseif($row_sdt>0){
            $loi_2="Số điện thoại ".$sdt." này đã được sử dụng";
            echo "<script type='text/javascript'>alert('$loi_2');</script>";
        }elseif($row_email>0){
            $loi_3="Email ".$email." này đã được sử dụng";
            echo "<script type='text/javascript'>alert('$loi_3');</script>";
        }
        else{
        $sql = "INSERT INTO khachhang (mskh, tenkh, diachi, sdt, email, nghenghiep, tencongty)
        VALUE ('$mskh','$tenkh','$diachi','$sdt','$email','$nghenghiep','$tencongty')";
        $query = mysqli_query($connect, $sql);
        // header('location: index.php?page_admin=danhsachkhachhang');
        ?>
        <script type="text/javascript">location.href = 'index.php?page_admin=danhsachkhachhang';</script>
<?php
        }
    }
?>
    <div class="card"> 
        <div class ="card-header">
            <h1>Thêm Khách hàng</h1>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Mã khách hàng</label>
                    <input type="text" name = "mskh"  class="form-control" require value="<?php echo isset($_POST['mskh']) ? $_POST['mskh'] : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="">Tên khách hàng</label>
                    <input type="text" name = "tenkh"  class="form-control" require value="<?php echo isset($_POST['tenkh']) ? $_POST['tenkh'] : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="">Địa chỉ</label>
                    <input type="text" name = "diachi"  class="form-control" require value="<?php echo isset($_POST['diachi']) ? $_POST['diachi'] : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="">Số điện thoại</label>
                    <input type="number" name = "sdt"  class="form-control" require value="<?php echo isset($_POST['sdt']) ? $_POST['sdt'] : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" name = "email"  class="form-control" require value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="">Nghề nghiệp</label>
                    <input type="text" name = "nghenghiep"  class="form-control" require value="<?php echo isset($_POST['nghenghiep']) ? $_POST['nghenghiep'] : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="">Công ty</label>
                    <input type="text" name = "tencongty"  class="form-control" require value="<?php echo isset($_POST['tencongty']) ? $_POST['tencongty'] : ''; ?>">
                </div>
                <button name="sbm" class = "btn btn-success" type="sumit">Thêm</button>
            </form>
        </div>
    </div>
