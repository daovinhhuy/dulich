<?php
$sql_lt = "SELECT * FROM loaitour ";
$query_lt = mysqli_query($connect, $sql_lt);


if (isset($_POST['sbm'])) {
    $mstour = $_POST['mstour'];
    $tentour = $_POST['tentour'];

    $hinhanhtour = $_FILES['hinhanhtour']['name'];
    $hinhanhtour_tmp = $_FILES['hinhanhtour']['tmp_name'];

    $gioithieutour = $_POST['gioithieutour'];
    $ngaydangtour = date('Y-m-d');
    $ngaykhoihanh = $_POST['ngaykhoihanh'];
    $ngayketthuc = $_POST['ngayketthuc'];
    $diemkhoihanh = $_POST['diemkhoihanh'];
    $soluongkhach = $_POST['soluongkhach'];
    $giatour = $_POST['giatour'];
    $idloaitour = $_POST['idloaitour'];

    $ngay_kh = strtotime($ngaydangtour) < strtotime($ngaykhoihanh); 
    $ngay_kt = strtotime($ngaykhoihanh) < strtotime($ngayketthuc);
    $ngay_tt = strtotime($ngayketthuc)/3600/24 - strtotime($ngaykhoihanh)/3600/24 ;
    // echo $ngay_tt;exit;
    // echo $ngay_kh;
    // echo 'ákbhd';
    // echo $ngay_kt; exit;
    $sql_ms = "SELECT mstour FROM tour WHERE mstour='$mstour'";
    $query_ms =  mysqli_query($connect, $sql_ms);
    $row_ms = mysqli_num_rows($query_ms);

    // $sql_ngay = "SELECT ngaydangtour, ngaykhoihanh, ngayketthuc FROM tour WHERE ngaydangtour='$ngaydangtour'< ngaykhoihanh='$ngaykhoihanh'<ngayketthuc='$ngayketthuc'";
    // $query_ngay = mysqli_query($connect,$sql_ngay);
    // $row_ngay = mysqli_num_rows($query_ngay);

    if($row_ms > 0){
        $loi ='Mã số tour đã tồn tại ! Vui lòng sử dụng mã số tour khác';
        echo "<script type='text/javascript'>alert('$loi');</script>";
    }
    else if($mstour==""||$tentour==""||$hinhanhtour==""||$gioithieutour==""||$ngaykhoihanh==""||$ngayketthuc==""||$diemkhoihanh==""||$soluongkhach==""||$giatour==""||$idloaitour==""){
        $loi_1 ="Vui lòng điền đầy đủ thông tin";
        echo "<script type='text/javascript'>alert('$loi_1');</script>";
    }else if($ngay_kh==0){
        $loi_2 = "Ngày khởi hành không phù hợp ";
        echo "<script type='text/javascript'>alert('$loi_2');</script>";
    }else if($ngay_kt==0){
        $loi_3 = "Ngày kết thúc không phù hợp ";
        echo "<script type='text/javascript'>alert('$loi_3');</script>";
    }else if($ngay_tt>30){
        $loi_4 = "Ngày kết thúc không được lớn hơn ngày khởi hành 30 ngày ";
        echo "<script type='text/javascript'>alert('$loi_4');</script>";
    }
    else{
        $sql = "INSERT INTO tour (mstour, tentour, gioithieutour,ngaydangtour,ngaykhoihanh, ngayketthuc, diemkhoihanh, soluongkhach, giatour, idloaitour)
        VALUE ('$mstour','$tentour', '$gioithieutour','$ngaydangtour','$ngaykhoihanh','$ngayketthuc','$diemkhoihanh','$soluongkhach','$giatour', '$idloaitour')";
        $query = mysqli_query($connect, $sql);
        move_uploaded_file($hinhanhtour_tmp,'../img/tour/'.$connect->insert_id);
     ?>
    <script type="text/javascript">location.href = 'index.php?page_admin=danhsachtour';</script>
    <?php
    }
    // header('location: index.php?page_admin=danhsachtour');
    ?>
    <!-- <script type="text/javascript">location.href = 'index.php?page_admin=danhsachtour';</script> -->
<?php
}
?>
<div class="card">
    <div class="card-header">
        <h1>Thêm Tour</h1>
    </div>
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Mã Tour</label>
                <input type="text" name="mstour" class="form-control" require value="<?php echo isset($_POST['mstour']) ? $_POST['mstour'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="">Tên Tour</label>
                <input type="text" name="tentour" class="form-control" require value="<?php echo isset($_POST['tentour']) ? $_POST['tentour'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="">Hình ảnh</label>
                <input type="file" name="hinhanhtour" >
            </div>
            <div class="form-group">
                <label for="">Giới thiệu tour</label>
                <input type="text" name="gioithieutour" class="form-control"  require value="<?php echo isset($_POST['gioithieutour']) ? $_POST['gioithieutour'] : ''; ?>"></input>
            </div>
            <div class="form-group">
                <label for="">Ngày khởi hành :</label>
                <input type="date" name="ngaykhoihanh"  require value="<?php echo isset($_POST['ngaykhoihanh']) ? $_POST['ngaykhoihanh'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="">Ngày kết thúc :</label>
                <input type="date" name="ngayketthuc"  require value="<?php echo isset($_POST['ngayketthuc']) ? $_POST['ngayketthuc'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="">Điểm khởi hành</label>
                <input type="text" name="diemkhoihanh" class="form-control" require value="<?php echo isset($_POST['diemkhoihanh']) ? $_POST['diemkhoihanh'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="">Số lượng khách</label>
                <input type="text" name="soluongkhach" class="form-control" require value="<?php echo isset($_POST['soluongkhach']) ? $_POST['soluongkhach'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="">Giá tour</label>
                <input type="text" name="giatour" class="form-control" require value="<?php echo isset($_POST['giatour']) ? $_POST['giatour'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="">Loại tour</label>
                <select class="form-control" name="idloaitour">
                    <?php
                    while ($row_lt = mysqli_fetch_assoc($query_lt)) { ?>
                        <option value="<?php echo $row_lt['idloaitour']; ?>"><?php echo $row_lt['tenloaitour']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <button name="sbm" class="btn btn-success" type="sumit">Thêm</button>
        </form>
    </div>
</div>