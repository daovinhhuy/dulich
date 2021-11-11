<?php
require_once "../../models/database.php";
require('../../assets/PHPExcel/Classes/PHPExcel.php');
if (isset($_POST['btnExportLT'])) {
    $OjExcel = new PHPExcel();
    //$OjExcel = PHPExcel_IOFactory::load('../PHPExcel/Classes/demo.xlsx');
    $OjExcel->setActiveSheetIndex(0); //Tạo Tiêu đề cho bảng - tiêu đề ở vị trí 0  
    $OjExcel->getActiveSheet()->setTitle('Thống kê tour theo loại tour ');
    $Sheet = $OjExcel->setActiveSheetIndex();
    $SoDong = '1';
    $Sheet->setCellValue('A1', 'Tên loại tour');
    $Sheet->setCellValue('B1', 'Số lượng tour');
    $sql_tktour = "SELECT lt.idloaitour, lt.tenloaitour, COUNT(idtour) tong
    FROM loaitour lt, tour t
    WHERE lt.idloaitour = t.idloaitour GROUP BY t.idloaitour";
    $query_tktour = mysqli_query($connect, $sql_tktour);
    while ($Row = mysqli_fetch_array($query_tktour)) {
        $SoDong++;
        // echo $SoDong; exit;
        $Sheet->setCellValue('A'.$SoDong, $Row['tenloaitour']);
        $Sheet->setCellValue('B'.$SoDong, $Row['tong']);
    }
    $Filename = 'xuatE_LT.xlsx';
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
