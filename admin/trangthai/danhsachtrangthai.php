<?php
    $sql = "SELECT * FROM trangthai ";
    $query = mysqli_query($connect, $sql);
?>

    <div class="card">
    <div class="card-header text-center">
            <h1>Danh sách Trạng thái</h1>
        </div>
        <div class="card-body">
        <a class="btn btn-primary" href="index.php?page_admin=themtrangthai"style ="float: right "><i class="fa fa-plus-circle" aria-hidden="true" >Thêm mới</i></a>
        <br><br>         
            <table class="table table-bordered">
                <thead class="thead-dark text-center">
                    <tr>
                        <th>STT</th>
                        <th>Tên Trạng thái</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $i =1 ;
                    while($row= mysqli_fetch_assoc($query)){?>
                <tr>
                        <td style="text-align: center;"><?php echo $i++; ?></td>
                        <td><?php echo $row['tentrangthai']; ?></td>
                        <td style ="text-align: center">
                            <a class="btn btn-outline-success fa fa-edit" href="index.php?page_admin=suatrangthai&idtrangthai=<?php echo $row['idtrangthai']; ?>"> Sửa</a>  
                        </td>

                        <td style ="text-align: center">
                            <a class="btn btn-outline-danger fa fa-trash" onclick="return Del('<?php echo $row['tentrangthai']; ?>')" href="index.php?page_admin=xoatrangthai&idtrangthai=<?php echo $row['idtrangthai']; ?>"> Xóa </a> 
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
        return confirm("Bạn có chắc muốn xóa Trạng thái : "+ name + " không ?");   
    }
</script>