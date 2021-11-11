<?php
$id = $_GET['idloaitour'];
$sql_lt = "SELECT * FROM loaitour WHERE idloaitour = $id";
$query_lt = mysqli_query($connect, $sql_lt);
$row_up = mysqli_fetch_assoc($query_lt);

if (isset($_POST['sbm'])) {
    $tenloaitour = $_POST['tenloaitour'];
    $sql_ten = "SELECT tenloaitour FROM loaitour WHERE tenloaitour='$tenloaitour'";
    $query_ten =  mysqli_query($connect, $sql_ten);
    $row_ten = mysqli_num_rows($query_ten);
    if($tenloaitour==""){
        $loi_1 ="Vui lòng không để trống thông tin";
        echo "<script type='text/javascript'>alert('$loi_1');</script>";
    }elseif($row_ten){
        $loi = "Tên loại tour đã tồn tại !";
        echo "<script type='text/javascript'>alert('$loi');</script>";
    }
    else{
        $sql = "UPDATE loaitour SET tenloaitour = '$tenloaitour' Where idloaitour ='$id'";
        $query = mysqli_query($connect, $sql);
        // header('location: index.php?page_admin=danhsachloaitour');
        ?>
        <script type="text/javascript">location.href = 'index.php?page_admin=danhsachloaitour';</script>
        <?php
    }
}
?>

<div class="card">
    <div class="card-header">
        <h1>Sửa Loại tour</h1>
    </div>
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Tên Loại tour</label>
                <input type="text" name="tenloaitour" class="form-control" require value="<?php echo $row_up['tenloaitour']; ?>">
            </div>
            <button name="sbm" class="btn btn-success" type="sumit">Sửa</button>
        </form>
    </div>
</div>