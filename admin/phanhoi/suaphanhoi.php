<?php
$idph = $_GET['idph'];

$sql_tour = "SELECT * FROM tour ";
$query_tour = mysqli_query($connect, $sql_tour);

$sql_kh = "SELECT * FROM khachhang ";
$query_kh = mysqli_query($connect, $sql_kh);

$sql_ph = "SELECT * FROM phanhoi WHERE idph = $idph";
$query_ph = mysqli_query($connect, $sql_ph);
$row_up = mysqli_fetch_assoc($query_ph);

if (isset($_POST['sbm'])) {
    $noidungph = $_POST['noidungph'];
    $idtour = $_POST['idtour'];
    $idkh = $_POST['idkh'];
    $sql = "UPDATE phanhoi SET noidungph = '$noidungph', idtour = '$idtour', idkh = '$idkh' Where idph ='$idph'";
    $query = mysqli_query($connect, $sql);
    // header('location: index.php?page_admin=danhsachphanhoi');
    ?>
    <script type="text/javascript">location.href = 'index.php?page_admin=danhsachphanhoi';</script>
<?php
}
?>

<div class="card">
    <div class="card-header">
        <h1>Sửa phản hồi</h1>
    </div>
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Nội dung </label>
                <input type="text" name="noidungph" class="form-control" require value="<?php echo $row_up['noidungph']; ?>">
            </div>
            <div class="form-group">
                <label for="">Tour</label>
                <select class="form-control" name="idtour">
                    <?php
                    while ($row_tour = mysqli_fetch_assoc($query_tour)) { ?>
                        <option value="<?php echo $row_tour['idtour']; ?>"><?php echo $row_tour['tentour']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Khách hàng</label>
                <select class="form-control" name="idkh">
                    <?php
                    while ($row_kh = mysqli_fetch_assoc($query_kh)) { ?>
                        <option value="<?php echo $row_kh['idkh']; ?>"><?php echo $row_kh['tenkh']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <button name="sbm" class="btn btn-success" type="sumit">Sửa</button>
        </form>
    </div>
</div>