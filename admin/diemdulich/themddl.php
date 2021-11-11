<?php 
    $sql_tt = "SELECT * FROM tinhthanh ";
    $query_tt = mysqli_query($connect,$sql_tt);

    
    if(isset($_POST['sbm'])){
        $msdiemdulich = $_POST['msdiemdulich'];
        $tendiemdulich = $_POST['tendiemdulich'];
        $hinhanhddl = $_FILES['hinhanhddl']['name'];
        $hinhanhddl_tmp = $_FILES['hinhanhddl']['tmp_name'];
        $gioithieu = $_POST['gioithieu'];
        $idtinhthanh = $_POST['idtinhthanh'];

        $sql_ms = "SELECT msdiemdulich FROM diemdulich WHERE msdiemdulich='$msdiemdulich'";
        $query_ms =  mysqli_query($connect, $sql_ms);
        $row_ms = mysqli_num_rows($query_ms);
        if($msdiemdulich==""||$tendiemdulich==""||$hinhanhddl==""||$gioithieu==""||$idtinhthanh==""){
            $loi ='Vui lòng nhập đầy đủ thông tin';
            echo "<script type='text/javascript'>alert('$loi');</script>";
        }elseif($row_ms>0){
            $loi_1 ='Mã số điểm du lịch đã tồn tại ! Vui lòng sử dụng mã số khác';
            echo "<script type='text/javascript'>alert('$loi_1');</script>";
        }else{
        $sql = "INSERT INTO diemdulich (msdiemdulich, tendiemdulich, gioithieu, idtinhthanh)
        VALUE ('$msdiemdulich','$tendiemdulich',  '$gioithieu', '$idtinhthanh')";
        $query = mysqli_query($connect, $sql);
        // print_r($_FILES);
        // print_r("id: ".$connect->insert_id);exit;
        move_uploaded_file($hinhanhddl_tmp,'../img/diemdulich/'.$connect->insert_id);
        // header('location: index.php?page_admin=danhsachddl');
    ?>
        <script type="text/javascript">location.href = 'index.php?page_admin=danhsachddl';</script>
<?php
}
}
?>

    <div class="card"> 
        <div class ="card-header">
            <h1>Thêm Điểm du lịch</h1>
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Mã điểm du lịch</label>
                    <input type="text" name = "msdiemdulich"  class="form-control" require value="<?php echo isset($_POST['msdiemdulich']) ? $_POST['msdiemdulich'] : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="">Tên Điểm du lịch</label>
                    <input type="text" name = "tendiemdulich"  class="form-control" require value="<?php echo isset($_POST['tendiemdulich']) ? $_POST['tendiemdulich'] : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="">Hình ảnh</label>
                    <input type="file" name = "hinhanhddl" >
                </div>
                <div class="form-group">
                    <label for="">Giới thiệu</label>
                    <input type="text" name = "gioithieu" class="form-control" require value="<?php echo isset($_POST['gioithieu']) ? $_POST['gioithieu'] : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="">Tỉnh thành</label>
                    <select class="form-control" name="idtinhthanh">
                        <?php
                            while($row_tt =mysqli_fetch_assoc($query_tt)){?>
                                <option value = "<?php echo $row_tt['idtinhthanh'];?>"><?php echo $row_tt['tentinhthanh'];?></option>
                           <?php }?> 
                    </select>
                </div>
                <button name="sbm" class = "btn btn-success" type="sumit">Thêm</button>
            </form>
        </div>
    </div>
