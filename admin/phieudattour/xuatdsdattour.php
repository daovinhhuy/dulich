<?php
    require_once "../../models/database.php";
    require('../../assets/PHPExcel/Classes/PHPExcel.php');
    if(isset($_POST['btnExport']))
    {
         $OjExcel = new PHPExcel();
         //$OjExcel = PHPExcel_IOFactory::load('../PHPExcel/Classes/demo.xlsx');
         $OjExcel -> setActiveSheetIndex(0);//Tạo Tiêu đề cho bảng - tiêu đề ở vị trí 0
         $OjExcel -> getActiveSheet()->setTitle('Danh Sách Phiếu Đặt tour');
         $Sheet = $OjExcel->setActiveSheetIndex();
         $SoDong = '1';
        $Sheet -> setCellValue('A1','Số phiếu');
        $Sheet -> setCellValue('B1','Số điện thoại');
        $Sheet -> setCellValue('C1','Tên khách hàng');
        $Sheet -> setCellValue('D1','Địa chỉ');
        $Sheet -> setCellValue('E1','Email');
        $Sheet -> setCellValue('F1','Nghề nghiệp');
        $Sheet -> setCellValue('G1','Tên công ty');
        $Sheet -> setCellValue('H1','Số vé');
        $Sheet -> setCellValue('I1','Ngày đặt');
        $Sheet -> setCellValue('J1','Tên tour');
        $sql_1 = "SELECT * 
        FROM phieudattour p inner join tour t on p.idtour = t.idtour
        inner join khachhang k on p.idkh = k.idkh";
         $Result = mysqli_query($connect,$sql_1);
         while ($Row = mysqli_fetch_array($Result)){        
              $SoDong++;     
              // echo $SoDong; exit;      
             $Sheet -> setCellValue('A'.$SoDong,$Row['sophieu']);
             $Sheet -> setCellValue('B'.$SoDong,$Row['sdt']);
             $Sheet -> setCellValue('C'.$SoDong,$Row['tenkh']);
             $Sheet -> setCellValue('D'.$SoDong,$Row['diachi']);
             $Sheet -> setCellValue('E'.$SoDong,$Row['email']);
             $Sheet -> setCellValue('F'.$SoDong,$Row['nghenghiep']);
             $Sheet -> setCellValue('G'.$SoDong,$Row['tencongty']);
             $Sheet -> setCellValue('H'.$SoDong,$Row['sove']);
             $Sheet -> setCellValue('I'.$SoDong,$Row['ngaydat']);
             $Sheet -> setCellValue('J'.$SoDong,$Row['tentour']);
             // $SoDong++;
         }
         $Filename = 'phieudattour.xlsx';
         $OjWriter = new PHPExcel_Writer_Excel2007($OjExcel);
         $OjWriter -> save($Filename);
         header('Content-disposition: attachment; filename='.$Filename);
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
?>