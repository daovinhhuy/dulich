<?php
include '../models/database.php';
//Thống kê loại tour có bao nhiêu tour 
$sql_tktour = "SELECT lt.idloaitour, lt.tenloaitour, COUNT(idtour) tong
    FROM loaitour lt, tour t
    WHERE lt.idloaitour = t.idloaitour GROUP BY t.idloaitour";
$query_tktour = mysqli_query($connect, $sql_tktour);
$loaitour = array();

$dataloaitour = json_encode($loaitour);

$sql_tkthang = "SELECT (MONTH(ngaydat)) as thang, SUM(sove) as tongve 
FROM phieudattour GROUP BY thang ORDER BY thang asc ";
$query_tkthang = mysqli_query($connect, $sql_tkthang);
$tkthang = array();
while ($row_tkthang = mysqli_fetch_assoc($query_tkthang)) {
    $tkthang[] = array('x' => $row_tkthang['thang'], 'y' => $row_tkthang['tongve']);
}
$datathang = json_encode($tkthang);
// echo $datathang;exit;
?>
<div class="card">
    <div class="card-header text-center">
        <h1>Thống kê </h1>

    </div>
    <div class="dashboard-wrapper">
        <div class="row">
            <!-- ============================================================== -->
            <!-- pie chart  -->
            <!-- ============================================================== -->
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                <div class="card">
                    <h5 class="card-header">Thống kê theo loại tour </h5>
                    <div class="card-body">
                        <div id="c3chart_pie"></div>
                    </div>
                    <form method="POST" action="thongke/xuatthongketheoLT.php" style="float: right;">
                        <button class="btn btn-success" type="submit" name="btnExportLT">Xuất dữ liệu ra file Excel >></button>
                    </form>
                </div>
            </div>
            <!-- ============================================================== -->
            <!--bar chart  -->
            <!-- ============================================================== -->
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="card">
                    <h5 class="card-header">Thống kê khách hàng theo tháng</h5>
                    <div class="card-body">
                        <div id="morris_bar"></div>
                    </div>
                    <form method="POST" action="thongke/xuatthongkeKHtheothang.php" style="float: right;">
                        <button class="btn btn-success" type="submit" name="btnExportTKve">Xuất dữ liệu ra file Excel >></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        var dataloaitour = [];
        var i = 0;
        <?php
        while ($row_tktour = mysqli_fetch_assoc($query_tktour)) {
        ?>
            dataloaitour[i] = Array('<?php echo $row_tktour['tenloaitour']; ?>', '<?php echo $row_tktour['tong']; ?>');
            i++;
        <?php
        }
        ?>
        var datathang = JSON.parse('<?php echo $datathang; ?>');
    </script>