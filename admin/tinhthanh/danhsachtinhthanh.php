<?php
    $sql = "SELECT * FROM tinhthanh ";
    if(isset($_POST['submit'])){
        $s = $_POST['search'];
        $sql = "SELECT * FROM tinhthanh WHERE mstinhthanh LIKE '%$s%' or tentinhthanh LIKE '%$s%'";
    }
    $query = mysqli_query($connect, $sql);
?>

    <div class="card">
    <div class="card-header text-center">
            <h1>Danh sách Tỉnh thành</h1>
        </div>
        <div class="card-body">
        <form action="" method="POST" class="form-inline" enctype="multipart/form-data">
            <div class="form-group">
                <input class="form-control" name="search" placeholder="Nhập nội dung tìm kiếm" value="<?php echo isset($_POST['search']) ? $_POST['search'] : ''; ?>">
                <button type="submit" name="submit" class="btn btn-primary btn-sm">Tìm Kiếm</button>
            </div>
        </form>
        <a class="btn btn-primary" href="index.php?page_admin=themtinhthanh"style ="float: right "><i class="fa fa-plus-circle" aria-hidden="true" >Thêm mới</i></a>
        <br><br>         
            <table class="table table-bordered">
                <thead class="thead-dark text-center">
                    <tr>
                        <th>STT</th>
                        <th>Mã Tỉnh thành</th>
                        <th>Tên Tỉnh thành</th>
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
                        <td><?php echo $row['mstinhthanh']; ?></td>
                        <td><?php echo $row['tentinhthanh']; ?></td>
                        <td style ="text-align: center">
                            <a class="btn btn-outline-success fa fa-edit" href="index.php?page_admin=suatinhthanh&idtinhthanh=<?php echo $row['idtinhthanh']; ?>"> Sửa</a>  
                        </td>

                        <td style ="text-align: center">
                            <a class="btn btn-outline-danger fa fa-trash" onclick="return Del('<?php echo $row['tentinhthanh']; ?>')" href="index.php?page_admin=xoatinhthanh&idtinhthanh=<?php echo $row['idtinhthanh']; ?>"> Xóa </a> 
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
        return confirm("Bạn có chắc muốn xóa Tỉnh thành : "+ name + " không ?");   
    }
</script>