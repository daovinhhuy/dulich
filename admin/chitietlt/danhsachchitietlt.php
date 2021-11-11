<?php
$sql = "SELECT * FROM chitietlt inner join tour on chitietlt.idtour = tour.idtour inner join diemdulich on chitietlt.iddiemdulich = diemdulich.iddiemdulich ";
    
    if(isset($_POST['sbm'])){
        $s = $_POST['search'];
        // print_r($s);
        $sql = "SELECT * FROM chitietlt inner join tour on chitietlt.idtour = tour.idtour inner join diemdulich on chitietlt.iddiemdulich = diemdulich.iddiemdulich WHERE tentour LIKE '%$s%' or ngay LIKE '%$s%'";
    }
    $query = mysqli_query($connect, $sql);
?>
<div class="card">
    <div class="card-header text-center">
        <h1>Danh sách chi tiết lịch trình</h1>
    </div>
    <div class="card-body">
        <form action="" method="POST" class="form-inline" enctype="multipart/form-data" >
        <div class="form-group" >
            <input class="form-control" name ="search" placeholder="Nhập nội dung tìm kiếm" value="<?php echo isset($_POST['search']) ? $_POST['search'] : ''; ?>">
            <button name="sbm" class="btn btn-primary btn-sm" type="submit" >Tìm Kiếm</button>
        </div>
        </form>
        <a class="btn btn-primary" style="float: right; width:10%; padding:10px;" href="index.php?page_admin=themchitietlt" ><i class="fa fa-plus-circle" aria-hidden="true"> Thêm mới</i></a>
        <br><br>
        <table class="table table-bordered ">
            <thead class="thead-dark text-center">
                <tr>
                    <th>STT</th>
                    <th>Ngày</th>
                    <th>Thời gian</th>
                    <th>Hoạt động</th>
                    <th>Tour</th>
                    <th>Điểm du lịch</th>
                    <th>Hành động</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while ($row  = mysqli_fetch_assoc($query)) { ?>
                    <tr>
                        <td style="text-align: center;"><?php echo $i++; ?></td>
                        <td><?php echo $row['ngay']; ?></td>
                        <td><?php echo $row['thoigian']; ?></td>
                        <td><?php echo $row['hoatdong']; ?></td>
                        <td><?php echo $row['tentour']; ?></td>
                        <td><?php echo $row['tendiemdulich']; ?></td>
                        <td style="text-align: center">
                            <a class="btn btn-outline-success fa fa-edit" href="index.php?page_admin=suachitietlt&idchitietlt=<?php echo $row['idchitietlt']; ?>"> Sửa</a>
                        </td>

                        <td style="text-align: center">
                            <a class="btn btn-outline-danger fa fa-trash" onclick="return Del('<?php echo $row['tentour']; ?>')" href="index.php?page_admin=xoachitietlt&idchitietlt=<?php echo $row['idchitietlt']; ?>"> Xóa </a>
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
    function Del(name) {
        return confirm("Bạn có chắc muốn xóa Chi tiết lịch trình của tour: " + name + " không ?");
    }
</script>