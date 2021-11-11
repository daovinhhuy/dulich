<?php
    $sql = "SELECT * FROM diemdulich inner join tinhthanh on diemdulich.idtinhthanh = tinhthanh.idtinhthanh ";
    if(isset($_POST['submit'])){
        $s = $_POST['search'];
        $sql = "SELECT * FROM diemdulich inner join tinhthanh on diemdulich.idtinhthanh = tinhthanh.idtinhthanh WHERE msdiemdulich LIKE '%$s%' or tendiemdulich LIKE '%$s%' or tentinhthanh LIKE '%$s%' ";
    }
    $query = mysqli_query($connect, $sql);
?>
    <div class="card">
    <div class="card-header text-center">
            <h1>Danh sách Điểm du lịch</h1>
        </div>
        <div class="card-body">
        <form action="" method="POST" class="form-inline" enctype="multipart/form-data" >
        <div class="form-group" >
            <input class="form-control" name ="search" placeholder="Nhập nội dung tìm kiếm" value="<?php echo isset($_POST['search']) ? $_POST['search'] : ''; ?>">
            <button type="submit" name="submit" class="btn btn-primary btn-sm">Tìm Kiếm</button>
        </div>
        </form>
        <a class="btn btn-primary" href="index.php?page_admin=themddl"style ="float: right "><i class="fa fa-plus-circle" aria-hidden="true" > Thêm mới</i></a>
        <br><br>         
            <table class="table table-bordered">
                <thead class="thead-dark text-center">
                    <tr>
                        <th>STT</th>
                        <th>Mã điểm du lịch</th>
                        <th>Tên Điểm du lịch</th>
                        <th>Hình ảnh</th>
                        <th>Giới thiệu</th>
                        <th>Tỉnh thành</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $i =1 ;
                    while($row  = mysqli_fetch_assoc($query)){?>
                <tr>
                        <td style="text-align: center;"><?php echo $i++; ?></td>
                        <td><?php echo $row['msdiemdulich']; ?></td>
                        <td><?php echo $row['tendiemdulich']; ?></td>
                        <td>
                            <img style="width : 150px;" src="../img/diemdulich/<?php echo $row['iddiemdulich']."?".time();?>"> 
                        </td>
                        <td><?php echo substr( $row['gioithieu'],0,200);?></td>
                        <td><?php echo $row['tentinhthanh'];?></td>
                        <td style ="text-align: center">
                            <a class="btn btn-outline-success fa fa-edit" href="index.php?page_admin=suaddl&iddiemdulich=<?php echo $row['iddiemdulich']; ?>"> Sửa</a>  
                        </td>

                        <td style ="text-align: center">
                            <a class="btn btn-outline-danger fa fa-trash" onclick="return Del('<?php echo $row['tendiemdulich']; ?>')" href="index.php?page_admin=xoaddl&iddiemdulich=<?php echo $row['iddiemdulich']; ?>"> Xóa </a> 
                        </td>
                    </tr>
                <?php
                    }
                ?>
                </tbody>    
            </table>

        </div>
    </div>


<script>
    function Del(name){
        return confirm("Bạn có chắc muốn xóa Điểm du lịch : "+ name + " không ?");   
    }
</script>