<?php
    $sql ="SELECT t.*, v.tongsove, t.soluongkhach - v.tongsove soveconlai, loaitour.tenloaitour FROM tour t
	LEFT JOIN ( SELECT p.idtour, SUM( p.sove ) tongsove FROM phieudattour p GROUP BY p.idtour ) v ON t.idtour = v.idtour
    LEFT JOIN  loaitour on t.idloaitour = loaitour.idloaitour";
    if(isset($_POST['submit'])){
        $s = $_POST['search'];
        $sql ="SELECT t.*, v.tongsove, t.soluongkhach - v.tongsove soveconlai, loaitour.tenloaitour FROM tour t
	LEFT JOIN ( SELECT p.idtour, SUM( p.sove ) tongsove FROM phieudattour p GROUP BY p.idtour ) v ON t.idtour = v.idtour
    LEFT JOIN  loaitour on t.idloaitour = loaitour.idloaitour WHERE mstour LIKE '%$s%' or tentour LIKE '%$s%' or tenloaitour LIKE '%$s%'";
    }
    $query =mysqli_query($connect,$sql);
?>
<div class="card">
    <div class="card-header text-center">
            <h1>Danh sách tour</h1>
        </div>
        <div class="card-body">
        <form action="" method="POST" class="form-inline" enctype="multipart/form-data">
            <div class="form-group">
                <input class="form-control" name="search" placeholder="Nhập nội dung tìm kiếm" value="<?php echo isset($_POST['search']) ? $_POST['search'] : ''; ?>">
                <button type="submit" name="submit" class="btn btn-primary btn-sm">Tìm Kiếm</button>
            </div>
        </form>
        <a class="btn btn-primary" href="index.php?page_admin=themtour"style ="float: right "><i class="fa fa-plus-circle" aria-hidden="true" > Thêm mới</i></a>
        <br><br>         
            <table class="table table-bordered">
                <thead class="thead-dark text-center">
                    <tr>
                        <th>STT</th>
                        <th>Mã tour</th>
                        <th>Tên tour</th>
                        <th>Hình ảnh tour</th>
                        <th>Giới thiệu tour</th>
                        <th>Ngày đăng tour</th>
                        <th>Ngày khởi hành</th>
                        <th>Ngày kết thúc</th>
                        <th>Điểm khởi hành</th>
                        <th>Số lượng khách</th>
                        <th>Số vé đã được đặt</th>
                        <th>Số vé còn lại</th>
                        <th>Giá tour (VND) </th>
                        <th>Loại tour</th>
                        <th>Thông tin tour</th>
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
                        <td><?php echo $row['mstour']; ?></td>
                        <td><?php echo $row['tentour']; ?></td>
                        <td>
                            <img style="width : 150px;" src="../img/tour/<?php echo $row['idtour']."?".time();?>"> 
                        </td>
                        <td><?php echo substr($row['gioithieutour'],0,200);?></td>
                        <td><?php echo $row['ngaydangtour'];?></td>
                        <td><?php echo $row['ngaykhoihanh']; ?></td>
                        <td><?php echo $row['ngayketthuc']; ?></td>
                        <td><?php echo $row['diemkhoihanh'];?></td>
                        <td style ="text-align : right"><?php echo $row['soluongkhach'];?></td>
                        <td style ="text-align : right"><?php echo $row['tongsove'];?></td>
                        <td style ="text-align : right"><?php echo $row['soveconlai'];?></td>
                        <td><?php echo number_format($row['giatour']);?></td>
                        <td><?php echo $row['tenloaitour'];?></td>
                        <td style ="text-align: center">
                            <a class="btn btn-outline-secondary fa fa-chevron-circle-right" href="index.php?page_admin=thongtintour&idtour=<?php echo $row['idtour']; ?>"> Xem </a>  
                        </td>
                        <td style ="text-align: center">
                            <a class="btn btn-outline-success fa fa-edit" href="index.php?page_admin=suatour&idtour=<?php echo $row['idtour']; ?>"> Sửa</a>  
                        </td>

                        <td style ="text-align: center">
                            <a class="btn btn-outline-danger fa fa-trash" onclick="return Del('<?php echo $row['tentour']; ?>')" href="index.php?page_admin=xoatour&idtour=<?php echo $row['idtour']; ?>"> Xóa </a> 
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
        return confirm("Bạn có chắc muốn xóa Tour: " +name+ " không ?");   
    }
</script>