<?php
    $sql = "SELECT * FROM khachhang ";
    if(isset($_POST['submit'])){
        $s=$_POST['search'];
        $sql = "SELECT * FROM khachhang WHERE mskh LIKE '%$s%' or tenkh LIKE '%$s%' or sdt LIKE '%$s%' ";
    }
    $query = mysqli_query($connect, $sql);
?>

    <div class="card">
    <div class="card-header text-center">
            <h1>Danh sách Khách hàng</h1>
        </div>
        <div class="card-body">
        <form action="" method="POST" class="form-inline" enctype="multipart/form-data" >
        <div class="form-group" >
            <input class="form-control" name ="search" placeholder="Nhập nội dung tìm kiếm" value="<?php echo isset($_POST['search']) ? $_POST['search'] : ''; ?>">
            <button type="submit" name="submit" class="btn btn-primary btn-sm">Tìm Kiếm</button>
        </div>
        </form>
        <a class="btn btn-primary" href="index.php?page_admin=themkhachhang"style ="float: right "><i class="fa fa-plus-circle" aria-hidden="true" >Thêm mới</i></a>
        <br><br>         
            <table class="table table-bordered">
                <thead class="thead-dark text-center">
                    <tr>
                        <th>STT</th>
                        <th>Mã khách hàng</th>
                        <th>Tên Khách hàng</th>
                        <th>Địa chỉ </th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Nghề nghiệp</th>
                        <th>Công ty</th>
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
                        <td><?php echo $row['mskh']; ?></td>
                        <td><?php echo $row['tenkh']; ?></td>
                        <td><?php echo $row['diachi']; ?></td>
                        <td><?php echo substr($row['sdt'],0,10); ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['nghenghiep']; ?></td>
                        <td><?php echo $row['tencongty']; ?></td>
                        <td style ="text-align: center">
                            <a class="btn btn-outline-success fa fa-edit" href="index.php?page_admin=suakhachhang&idkh=<?php echo $row['idkh']; ?>"> Sửa</a>  
                        </td>

                        <td style ="text-align: center">
                            <a class="btn btn-outline-danger fa fa-trash" onclick="return Del('<?php echo $row['tenkh']; ?>')" href="index.php?page_admin=xoakhachhang&idkh=<?php echo $row['idkh']; ?>"> Xóa </a> 
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
        return confirm("Bạn có chắc muốn xóa Khách hàng : "+ name + " không ?");   
    }
</script>