<?php
$idtour = $_GET['idtour'];
// settype("int",$idtour);
// $sql_lt = "SELECT * FROM loaitour ";
// $query_lt = mysqli_query($connect, $sql_lt);
function bindLTList($connect, $Value)
{
    $ListTTS = mysqli_query($connect, "SELECT idloaitour, tenloaitour from loaitour");
    echo "<select name='idloaitour' class='form-control'>";
    while ($row = mysqli_fetch_array($ListTTS)) {
        if ($row['idloaitour'] == $Value) {
            echo "<option value='" . $row['idloaitour'] . "' selected>" . $row['tenloaitour'] . "</option>";
        } else echo "<option value='" . $row['idloaitour'] . "'>" . $row['tenloaitour'] . "</option>";
    }
    echo "</select>";
}
$sql_tour = "SELECT * FROM tour WHERE idtour = $idtour";
$query_tour = mysqli_query($connect, $sql_tour);
$row_up = mysqli_fetch_assoc($query_tour);
// print_r($row_up);exit;

if (isset($_POST['sbm'])) {
    // print_r($_POST);exit;
    $idtour = $row_up['idtour'];
    $mstour = $_POST['mstour'];
    $tentour = $_POST['tentour'];
    $gioithieutour = $_POST['gioithieutour'];
    $ngaykhoihanh = $_POST['ngaykhoihanh'];
    $ngayketthuc = $_POST['ngayketthuc'];
    $diemkhoihanh = $_POST['diemkhoihanh'];
    $soluongkhach = $_POST['soluongkhach'];
    $giatour = $_POST['giatour'];
    $idloaitour = $_POST['idloaitour'];

    $ngayhientai = date('Y-m-d');
    $ngay_kh = strtotime($ngayhientai) < strtotime($ngaykhoihanh); 
    $ngay_kt = strtotime($ngaykhoihanh) < strtotime($ngayketthuc);

    $sql_ms = "SELECT mstour FROM tour WHERE mstour='$mstour'";
    $query_ms =  mysqli_query($connect, $sql_ms);
    $row_ms = mysqli_num_rows($query_ms);

    if ($_FILES['hinhanhtour']['name'] == '') {
        $idtour = $row_up['idtour'];
    } else {
        $path_user = '../img/tour/';
        if (!file_exists($path_user)) {
            mkdir($path_user, 0777, false);
        } else if (file_exists($path_user . $idtour)) {
            unlink($path_user . $idtour);
        }
        move_uploaded_file($_FILES['hinhanhtour']['tmp_name'], $path_user . $idtour);
    }
    if ($mstour == "" || $tentour == ""|| $gioithieutour == "" || $ngaykhoihanh == "" || $ngayketthuc == "" || $diemkhoihanh == "" || $soluongkhach == "" || $giatour == "") {
        $loi_1 = "Vui l??ng ??i???n ?????y ????? th??ng tin";
        echo "<script type='text/javascript'>alert('$loi_1');</script>";
    }elseif($ngay_kh==0){
        $loi_2 = "Ng??y kh???i h??nh kh??ng ph?? h???p ";
        echo "<script type='text/javascript'>alert('$loi_2');</script>";
    }elseif($ngay_kt==0){
        $loi_3 = "Ng??y k???t th??c kh??ng ph?? h???p ";
        echo "<script type='text/javascript'>alert('$loi_3');</script>";
    }
    else{
        $sql_up = "UPDATE tour SET mstour='$mstour',tentour='$tentour',gioithieutour='$gioithieutour',
        ngaykhoihanh='$ngaykhoihanh',ngayketthuc='$ngayketthuc',diemkhoihanh='$diemkhoihanh',
        soluongkhach='$soluongkhach',giatour='$giatour',idloaitour='$idloaitour' Where idtour =" . $idtour;
        // print_r($sql);exit;
        $query = mysqli_query($connect, $sql_up);
        // print_r($query);exit;
        // header('location: index.php?page_admin=danhsachtour');
        ?>
        <script type="text/javascript">location.href = 'index.php?page_admin=danhsachtour';</script>
<?php
    }
}
?>

<div class="card">
    <div class="card-header">
        <h1>S???a Tour</h1>
    </div>
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">M?? Tour</label>
                <input type="text" name="mstour" class="form-control" require value="<?php echo $row_up['mstour']; ?>">
            </div>
            <div class="form-group">
                <label for="">T??n Tour</label>
                <input type="text" name="tentour" class="form-control" require value="<?php echo $row_up['tentour']; ?>">
            </div>
            <div class="form-group">
                <label for="">H??nh ???nh</label>
                <input type="file" name="hinhanhtour">
            </div>
            <div class="form-group">
                <label for="">Gi???i thi???u tour</label>
                <input type="text" name="gioithieutour" class="form-control" require value="<?php echo $row_up['gioithieutour']; ?>">
            </div>
            <div class="form-group">
                <label for="">Ng??y kh???i h??nh</label>
                <input type="date" name="ngaykhoihanh"  require value="<?php echo $row_up['ngaykhoihanh']; ?>">
            </div>
            <div class="form-group">
                <label for="">Ng??y k???t th??c</label>
                <input type="date" name="ngayketthuc"  require value="<?php echo $row_up['ngayketthuc']; ?>">
            </div>
            <div class="form-group">
                <label for="">??i???m kh???i h??nh</label>
                <input type="text" name="diemkhoihanh" class="form-control" require value="<?php echo $row_up['diemkhoihanh']; ?>">
            </div>
            <div class="form-group">
                <label for="">S??? l?????ng kh??ch</label>
                <input type="text" name="soluongkhach" class="form-control" require value="<?php echo $row_up['soluongkhach']; ?>">
            </div>
            <div class="form-group">
                <label for="">Gi?? tour</label>
                <input type="text" name="giatour" class="form-control" require value="<?php echo $row_up['giatour']; ?>">
            </div>
            <div class="form-group">
                <label for="">Lo???i tour:</label>
                <?php bindLTList($connect, $row_up['idloaitour']); ?>
            </div>
            <button name="sbm" class="btn btn-success" type="sumit"> S???a </button>
        </form>
    </div>
</div>