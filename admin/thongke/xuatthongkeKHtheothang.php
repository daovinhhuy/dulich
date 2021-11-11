<?php
require_once "../../models/database.php";
require('../../assets/PHPExcel/Classes/PHPExcel.php');
if (isset($_POST['btnExportTKve'])) {
    $OjExcel = new PHPExcel();
    //$OjExcel = PHPExcel_IOFactory::load('../PHPExcel/Classes/demo.xlsx');
    $OjExcel->setActiveSheetIndex(0); //Tạo Tiêu đề cho bảng - tiêu đề ở vị trí 0  
    $OjExcel->getActiveSheet()->setTitle('Thống kê số vé theo tháng ');
    $Sheet = $OjExcel->setActiveSheetIndex();
    $SoDong = '1';
    $Sheet->setCellValue('A1', 'Tháng');
    $Sheet->setCellValue('B1', 'Số lượng vé');
    $sql_tkthang = "SELECT (MONTH(ngaydat)) as thang, SUM(sove) as tongve 
        FROM phieudattour GROUP BY thang ORDER BY thang asc ";
    $query_tkthang = mysqli_query($connect, $sql_tkthang);
    while ($Row = mysqli_fetch_array($query_tkthang)) {
        $SoDong++;
        // echo $SoDong; exit;
        $Sheet->setCellValue('A' . $SoDong, $Row['thang']);
        $Sheet->setCellValue('B' . $SoDong, $Row['tongve']);
    }
    $Filename = 'xuatE_TKVe.xlsx';
    $OjWriter = new PHPExcel_Writer_Excel2007($OjExcel);
    $OjWriter->save($Filename);
    header('Content-disposition: attachment; filename=' . $Filename);
    header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Length: ' . filesize($Filename));
    header('Content-Transfer-Encoding: binary');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    //ob_clean();
    //flush(); 
    readfile($Filename);
    return;
}
