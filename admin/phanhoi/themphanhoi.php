<?php
$sql_tour = "SELECT * FROM tour ";
$query_tour = mysqli_query($connect, $sql_tour);

$sql_kh = "SELECT * FROM khachhang ";
$query_kh = mysqli_query($connect, $sql_kh);
// if (mysqli_num_rows($result) == 0) {
//     $row = mysqli_fetch_row($query_kh);
//     $idkh_id = $row[0];
// }else{
//     $idkh_id="";
// }
if (isset($_POST['sbm'])) {
    $sdt = $_POST['sdt'];
    $tenkh = $_POST['tenkh'];
    $noidungph = $_POST['noidungph'];
    $ngayph = date('Y-m-d');
    $idtour = $_POST['idtour'];

    //Lấy idkh theo số điện thoại đã nhập
    $sql_idkh = "SELECT idkh FROM khachhang WHERE sdt = '$sdt' ";
    $query_idkh = mysqli_query($connect, $sql_idkh);
    $row = mysqli_fetch_row($query_idkh);
    $idkh_id = $row[0];
    if($sdt==""||$tenkh==""||$noidungph==""){
        $loi_2 = "Vui lòng không để trống thông tin";
        echo "<script type='text/javascript'>alert('$loi_2');</script>";
    }else if (!isset($idkh_id)) {
        $loi = 'Không tồn tại khách hàng với số điện thoại vừa nhập';
        echo "<script type='text/javascript'>alert('$loi');</script>";
    } else if ($noidungph == "") {
        $loi_1 = 'Vui lòng nhập nội dung phản hồi';
        echo "<script type='text/javascript'>alert('$loi_1');</script>";
    } else {
        $sql = "INSERT INTO phanhoi (noidungph, ngayph, idtour,idkh)
        VALUE ('$noidungph', '$ngayph', '$idtour','$idkh_id')";
        $query = mysqli_query($connect, $sql);
        // header('location: index.php?page_admin=danhsachphanhoi');
?>
        <script type="text/javascript">
            location.href = 'index.php?page_admin=danhsachphanhoi';
        </script>
    <?php
    }
}
?>
<div class="card">
    <div class="card-header">
        <h1>Thêm Phản hồi</h1>
    </div>
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Số điện thoại </label>
                <input type="text" name="sdt" id="sdt_id" class="form-control" require value="<?php echo isset($_POST['sdt']) ? $_POST['sdt'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="">Tên khách hàng </label>
                <input type="text" name="tenkh" id="tenkh_id" class="form-control" require value="<?php echo isset($_POST['tenkh']) ? $_POST['tenkh'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="">Nội dung phản hồi </label>
                <input type="text" name="noidungph" class="form-control" require value="<?php echo isset($_POST['noidungph']) ? $_POST['noidungph'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="">Tour</label>
                <select class="form-control" name="idtour" id="idtour">
                    <?php
                    while ($row_tour = mysqli_fetch_assoc($query_tour)) { ?>
                        <option value="<?php echo $row_tour['idtour']; ?>"><?php echo $row_tour['tentour']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <button name="sbm" class="btn btn-success" type="sumit">Thêm</button>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#sdt_id").change(function() {
            var sdt = $("#sdt_id").val();
            $.post('khachhang/layttkhachhang.php', {
                sodientthoai: sdt,
                laytttour: 1
            }, function(response) {
                var res = jQuery.parseJSON(response);
                $("#tenkh_id").val(res.tenkh);
                $('#idtour').empty();
                $.each(res.tttour, function(i, item) {
                    $('#idtour').append($('<option>', {
                        value: item.idtour,
                        text: item.tentour
                    }));
                });
            });
        });
    });
</script>