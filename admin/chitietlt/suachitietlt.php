<?php

$idchitietlt = $_GET['idchitietlt'];

function bindTourList($connect, $Value)
{
    $ListTour = mysqli_query($connect, "SELECT idtour, tentour, ngaykhoihanh, ngayketthuc from tour");
    echo "<select name='idtour' class='form-control'>";
    while ($row = mysqli_fetch_array($ListTour)) {
        if ($Value==$row['idtour']) {
            echo "<option value='" . $row['idtour'] . "' selected>" . $row['tentour'] ."( từ ".$row['ngaykhoihanh']." đến ".$row['ngayketthuc']." )". "</option>";
        } else echo "<option value='" . $row['idtour'] . "'>" . $row['tentour'] ."( từ ".$row['ngaykhoihanh']." đến ".$row['ngayketthuc']." )"."</option>";
    }
    echo "</select>";
}
function bindDDLList($connect, $Value)
{
    $Listddl = mysqli_query($connect, "SELECT iddiemdulich, tendiemdulich from diemdulich");
    echo "<select name='iddiemdulich' class='form-control'>";
    while ($row = mysqli_fetch_array($Listddl)) {
        if ($row['iddiemdulich'] == $Value) {
            echo "<option value='" . $row['iddiemdulich'] . "' selected>" . $row['tendiemdulich'] . "</option>";
        } else echo "<option value='" . $row['iddiemdulich'] . "'>" . $row['tendiemdulich'] . "</option>";
    }
    echo "</select>";
}


$sql_ddl = "SELECT * FROM diemdulich ";
$query_ddl = mysqli_query($connect, $sql_ddl);

$sql_ct = "SELECT * FROM chitietlt WHERE idchitietlt = $idchitietlt";
$query_ct = mysqli_query($connect, $sql_ct);
$row_up = mysqli_fetch_assoc($query_ct);

if (isset($_POST['sbm'])) {
    $ngay = $_POST['ngay'];
    $thoigian = $_POST['thoigian'];
    $hoatdong = $_POST['hoatdong'];
    $idtour = $_POST['idtour'];
    $iddiemdulich = $_POST['iddiemdulich'];

    $sql_ngay = "SELECT * FROM tour WHERE idtour = '$idtour' AND '$ngay' BETWEEN ngaykhoihanh AND ngayketthuc";
    $query_ngay = mysqli_query($connect, $sql_ngay);
    if (mysqli_num_rows($query_ngay) == 0) {
        $loi = "Ngày không thuộc tour ! Vui lòng chọn ngày phù hợp";
        echo "<script type='text/javascript'>alert('$loi');</script>";;
    } else if ($ngay == "" || $thoigian == "" || $hoatdong == "") {
        $loi_1 = "vui lòng điền đầy đủ thông tin";
        echo "<script type='text/javascript'>alert('$loi_1');</script>";;
    } else {
        $sql = "UPDATE chitietlt SET ngay = '$ngay', thoigian = '$thoigian', hoatdong = '$hoatdong', idtour = '$idtour', iddiemdulich = '$iddiemdulich' Where idchitietlt ='$idchitietlt'";
        $query = mysqli_query($connect, $sql);
        // header('location:index.php?page_admin=danhsachchitietlt');
?>
        <script type="text/javascript">
            location.href = 'index.php?page_admin=danhsachchitietlt';
        </script>
<?php
    }
}
?>

<div class="card">
    <div class="card-header">
        <h1>Sửa lịch trình</h1>
    </div>
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Ngày :</label>
                <input type="date" name="ngay" require value="<?php echo $row_up['ngay']; ?>">
            </div>
            <div class="form-group">
                <label for="">Thời gian </label>
                <input type="text" name="thoigian" class="form-control" require value="<?php echo $row_up['thoigian']; ?>">
            </div>
            <div class="form-group">
                <label for="">Hoạt động </label>
                <input type="text" name="hoatdong" class="form-control" require value="<?php echo $row_up['hoatdong']; ?>">
            </div>
            <div class="form-group">

                <div class="form-group">
                    <label for="">Tour </label>
                    <?php bindTourList($connect, $row_up['idtour']); ?>
                </div>
                <div class="form-group">
                    <label for="">Điểm du lịch </label>
                    <?php bindDDLList($connect,$row_up['iddiemdulich']); ?>
                </div>

                <button name="sbm" class="btn btn-success" type="sumit">Sửa</button>
        </form>
    </div>
</div>