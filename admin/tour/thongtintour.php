<?php
$id = $_GET['idtour'];
//truy vấn tất cả khách hàng đã đặt tour theo id của tour
$sql_kh = " SELECT t.tentour, kh.tenkh, p.sove, (p.sove*t.giatour)as tongtien
FROM tour t, khachhang kh, phieudattour p
WHERE t.idtour = p.idtour and kh.idkh = p.idkh and t.idtour='$id'";
$query_kh = mysqli_query($connect, $sql_kh);
//truy vấn thông tin của tour 
$sql = "SELECT * FROM tour t, chitietlt lt, diemdulich ddl, sukienlehoi s 
    WHERE t.idtour = lt.idtour and lt.iddiemdulich = ddl.iddiemdulich and ddl.iddiemdulich = s.iddiemdulich and t.idtour='$id' ";
$query = mysqli_query($connect, $sql);
$row_t = mysqli_fetch_assoc($query);

$sql_tong = "SELECT t.*, v.tongsove, t.giatour * v.tongsove tong    
FROM tour t
LEFT JOIN ( SELECT p.idtour, SUM( p.sove ) tongsove FROM phieudattour p WHERE p.idtour='$id' and p.idtrangthai <>3 GROUP BY p.idtour) v ON t.idtour = v.idtour
WHERE t.idtour = '$id'";
$query_tong = mysqli_query($connect, $sql_tong);
$row_tong= mysqli_fetch_assoc($query_tong);

//lấy lịch trình theo đúng id của tour
$sql_lt = "SELECT * 
FROM tour t, chitietlt lt
WHERE t.idtour = lt.idtour and lt.idtour = '$id'";
$query_lt = mysqli_query($connect, $sql_lt);

//điểm du lịch mà tour sẽ tới
$sql_ddl = " SELECT *
FROM chitietlt lt, diemdulich ddl
WHERE  lt.iddiemdulich = ddl.iddiemdulich and lt.idtour = '$id'";
$query_ddl = mysqli_query($connect, $sql_ddl);

$sql_sklh = "SELECT * FROM diemdulich ddl, sukienlehoi s, tour t, chitietlt lt
WHERE t.idtour = lt.idtour and lt.iddiemdulich = ddl.iddiemdulich and ddl.iddiemdulich = s.iddiemdulich and lt.idtour='$id'";
$query_sklh = mysqli_query($connect, $sql_sklh);

?>
<div class="card">
    <div class="card-header text-center">
        <h2>Thông tin : <?php echo $row_t['tentour']; ?></h2>
        <p>Tổng số vé đã được đặt:<?php echo $row_tong['tongsove'];?> vé </p>
        <p>Tổng tiền của tour :<?php echo number_format($row_tong['tong'], 0, ",", ".")."(VNĐ)".''; ?></p>
    </div>
    <div class="card-body">
        <h3>Khách hàng đã đặt tour</h3>
        <table class="table table-bordered">
            <thead class="thead-dark text-center">
                <tr>
                    <th>STT</th>
                    <th>Tên khách hàng</th>
                    <th>Số vé</th>
                    <th>Tổng tiền của khách hàng (VNĐ)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while ($row_kh = mysqli_fetch_assoc($query_kh)) { ?>
                    <tr>
                        <td style="text-align: center;"><?php echo $i++; ?></td>
                        <td><?php echo $row_kh['tenkh']; ?></td>
                        <td style="text-align : right"><?php echo $row_kh['sove']; ?></td>
                        <td><?php echo number_format($row_kh['tongtien'], 0, ",", "."); ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="card-body">
        <h3>Lịch trình của tour</h3>
        <table class="table table-bordered">
            <thead class="thead-dark text-center">
                <tr>
                    <th>STT</th>
                    <th>Ngày</th>
                    <th>Thời gian</th>
                    <th>Hoạt động</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while ($row_lt = mysqli_fetch_assoc($query_lt)) { ?>
                    <tr>
                        <td style="text-align: center;"><?php echo $i++; ?></td>
                        <td style="text-center"><?php echo $row_lt['ngay']; ?></td>
                        <td><?php echo $row_lt['thoigian']; ?></td>
                        <td><?php echo $row_lt['hoatdong']; ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="card-body">
        <h3>Điểm du lịch </h3>
        <table class="table table-bordered">
            <thead class="thead-dark text-center">
                <tr>
                    <th>STT</th>
                    <th>Điểm du lịch</th>
                    <th>Giới thiệu</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while ($row_ddl = mysqli_fetch_assoc($query_ddl)) { ?>
                    <tr>
                        <td style="text-align: center;"><?php echo $i++; ?></td>
                        <td><?php echo $row_ddl['tendiemdulich']; ?></td>
                        <td><?php echo $row_ddl['gioithieu']; ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="card-body">
        <h3>Sự kiện lễ hội diễn ra </h3>
        <table class="table table-bordered">
            <thead class="thead-dark text-center">
                <tr>
                    <th>STT</th>
                    <th>Sự kiện lễ hội</th>
                    <th>Giới thiệu</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while ($row_sklh = mysqli_fetch_assoc($query_sklh)) { ?>
                    <tr>
                        <td style="text-align: center;"><?php echo $i++; ?></td>
                        <td><?php echo $row_sklh['tensklh']; ?></td>
                        <td><?php echo $row_sklh['gioithieusklh']; ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>