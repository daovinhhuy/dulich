<?php
$iddiemdulich = $_GET['iddiemdulich'];

function bindTTList($connect, $Value)
{
    $ListTT = mysqli_query($connect, "SELECT idtinhthanh, tentinhthanh from tinhthanh");
    echo "<select name='idtinhthanh' class='form-control'>";
    while ($row = mysqli_fetch_array($ListTT)) {
        if ($row['idtinhthanh'] == $Value) {
            echo "<option value='" . $row['idtinhthanh'] . "' selected>" . $row['tentinhthanh'] . "</option>";
        } else echo "<option value='" . $row['idtinhthanh'] . "'>" . $row['tentinhthanh'] . "</option>";
    }
    echo "</select>";
}

$sql_ddl = "SELECT * FROM diemdulich WHERE iddiemdulich = $iddiemdulich";
$query_ddl = mysqli_query($connect, $sql_ddl);
$row_up = mysqli_fetch_assoc($query_ddl);

if (isset($_POST['sbm'])) {
    $msdiemdulich = $_POST['msdiemdulich'];
    $tendiemdulich = $_POST['tendiemdulich'];
    $gioithieu = $_POST['gioithieu'];
    $idtinhthanh = $_POST['idtinhthanh'];
    
    if($msdiemdulich==""||$tendiemdulich==""||$gioithieu==""||$idtinhthanh==""){
        $loi ='Vui lòng không để trống thông tin';
        echo "<script type='text/javascript'>alert('$loi');</script>";
    }else{
        if ($_FILES['hinhanhddl']['name'] == '') {
            $iddiemdulich = $row_up['iddiemdulich'];
        } else {
            $path_user = '../img/diemdulich/';
            if (!file_exists($path_user)) {
                mkdir($path_user, 0777, false);
                // echo '1';
            }
            else if (file_exists($path_user . $iddiemdulich)) {
                unlink($path_user . $iddiemdulich);
                // echo '2';
            }
            // Create the new file
            //  echo $path_user.$iddiemdulich ;
            //  print_r($_FILES); exit;
            move_uploaded_file($_FILES['hinhanhddl']['tmp_name'], $path_user . $iddiemdulich);
        }
        $sql = "UPDATE diemdulich SET msdiemdulich = '$msdiemdulich',tendiemdulich = '$tendiemdulich',
        gioithieu='$gioithieu',idtinhthanh= '$idtinhthanh' Where iddiemdulich ='$iddiemdulich'";
        $query = mysqli_query($connect, $sql);
        // header('location: index.php?page_admin=danhsachddl');
?>
    <script type="text/javascript">location.href = 'index.php?page_admin=danhsachddl';</script>
<?php
}
}
?>

<div class="card">
    <div class="card-header">
        <h1>Sửa Điểm du lịch</h1>
    </div>
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Mã điểm du lịch</label>
                <input type="text" name="msdiemdulich" class="form-control" require value="<?php echo $row_up['msdiemdulich']; ?>">
            </div>
            <div class="form-group">
                <label for="">Tên Điểm du lịch</label>
                <input type="text" name="tendiemdulich" class="form-control" require value="<?php echo $row_up['tendiemdulich']; ?>">
            </div>
            <div class="form-group">
                <label for="">Hình ảnh</label>
                <input type="file" name="hinhanhddl" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Giới thiệu</label>
                <input type="text" name="gioithieu" class="form-control" require value="<?php echo $row_up['gioithieu']; ?>">
            </div>
            <div class="form-group">
                <label for="">Tỉnh thành</label>
                <?php bindTTList($connect, $row_up['idtinhthanh']);?>
            </div>
            <button name="sbm" class="btn btn-success" type="sumit">Sửa</button>
        </form>
    </div>
</div>