<?php
$idsklh = $_GET['idsklh'];

function bindDDLList($connect, $Value)
{
    $ListDDL = mysqli_query($connect, "SELECT iddiemdulich, tendiemdulich from diemdulich");
    echo "<select name='iddiemdulich' class='form-control'>";
    while ($row = mysqli_fetch_array($ListDDL)) {
        if ($row['iddiemdulich'] == $Value) {
            echo "<option value='" . $row['iddiemdulich'] . "' selected>" . $row['tendiemdulich'] . "</option>";
        } else echo "<option value='" . $row['iddiemdulich'] . "'>" . $row['tendiemdulich'] . "</option>";
    }
    echo "</select>";
}
$sql_sklh = "SELECT * FROM sukienlehoi WHERE idsklh = $idsklh";
$query_sklh = mysqli_query($connect, $sql_sklh);
$row_up = mysqli_fetch_assoc($query_sklh);

if (isset($_POST['sbm'])) {
    $mssklh = $_POST['mssklh'];
    $tensklh = $_POST['tensklh'];
    $thoigiandienra = $_POST['thoigiandienra'];
    $noidienra = $_POST['noidienra'];
    $gioithieusklh = $_POST['gioithieusklh'];
    $iddiemdulich = $_POST['iddiemdulich'];
    if ($mssklh == "" || $tensklh == "" || $thoigiandienra == "" || $noidienra == "" || $gioithieusklh == "" || $iddiemdulich == "") {
        $loi = 'Vui lòng không để trống thông tin';
        echo "<script type='text/javascript'>alert('$loi');</script>";
    } else {
        if ($_FILES['hinhanhsklh']['name'] =='') {
            $idsklh = $row_up['idsklh'];
        } else {
            $path_user = '../img/sklh/';
            
            if (!file_exists($path_user)) {
                mkdir($path_user, 0777, false);
            } else if (file_exists($path_user . $idsklh)) {
                unlink($path_user . $idsklh);
            }
            move_uploaded_file($_FILES['hinhanhsklh']['tmp_name'], $path_user . $idsklh);
        }

        $sql = "UPDATE sukienlehoi SET mssklh = '$mssklh',tensklh = '$tensklh', thoigiandienra='$thoigiandienra',noidienra='$noidienra',gioithieusklh='$gioithieusklh',iddiemdulich= '$iddiemdulich' Where idsklh ='$idsklh'";
        $query = mysqli_query($connect, $sql);
        // header('location: index.php?page_admin=danhsachsklh');
?>
        <script type="text/javascript">
            location.href = 'index.php?page_admin=danhsachsklh';
        </script>
<?php
    }
}
?>

<div class="card">
    <div class="card-header">
        <h1>Sửa Sự kiện lễ hội</h1>
    </div>
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Mã sự kiện lễ hội</label>
                <input type="text" name="mssklh" class="form-control" require value="<?php echo $row_up['mssklh']; ?>">
            </div>
            <div class="form-group">
                <label for="">Tên sự kiện lễ hội</label>
                <input type="text" name="tensklh" class="form-control" require value="<?php echo $row_up['tensklh']; ?>">
            </div>
            <div class="form-group">
                <label for="">Hình ảnh</label>
                <input type="file" name="hinhanhsklh" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Thời gian diễn ra</label>
                <input type="text" name="thoigiandienra" class="form-control" require value="<?php echo $row_up['thoigiandienra']; ?>">
            </div>
            <div class="form-group">
                <label for="">Nơi diễn ra</label>
                <input type="text" name="noidienra" class="form-control" require value="<?php echo $row_up['noidienra']; ?>">
            </div>
            <div class="form-group">
                <label for="">Giới thiệu </label>
                <input type="text" name="gioithieusklh" class="form-control" require value="<?php echo $row_up['gioithieusklh']; ?>">
            </div>
            <div class="form-group">
                <label for="">Điểm du lịch </label>
                <?php bindDDLList($connect, $row_up['iddiemdulich']); ?>
            </div>
            <button name="sbm" class="btn btn-success" type="sumit">Sửa</button>
        </form>
    </div>
</div>