<?php
// echo dirname(__FILE__);exit;
define('__SITE_PATH', dirname(__FILE__));
ini_set('display_errors', 1);
session_start();
if(!isset($_SESSION['nhanvien'])){
 	header('Location:login.php');
}
include('../models/database.php');
include "header_admin.php";

if (isset($_GET["page_admin"])) {
  switch ($_GET['page_admin']) {
      //Chi tiết của tour
    case 'danhsachchitietlt':
      require_once 'chitietlt/danhsachchitietlt.php';
      break;
    case 'themchitietlt':
      require_once 'chitietlt/themchitietlt.php';
      break;
    case 'suachitietlt':
      require_once 'chitietlt/suachitietlt.php';
      break;
    case 'xoachitietlt':
      require_once 'chitietlt/xoachitietlt.php';
      break;
      //Chức vụ
    case 'danhsachchucvu':
      require_once 'chucvu/danhsachchucvu.php';
      break;
    case 'themchucvu':
      require_once 'chucvu/themchucvu.php';
      break;
    case 'suachucvu':
      require_once 'chucvu/suachucvu.php';
      break;
    case 'xoachucvu':
      require_once 'chucvu/xoachucvu.php';
      break;
      // Điểm du lịch
    case 'danhsachddl':
      require_once 'diemdulich/danhsachddl.php';
      break;
    case 'themddl':
      require_once 'diemdulich/themddl.php';
      break;
    case 'suaddl':
      require_once 'diemdulich/suaddl.php';
      break;
    case 'xoaddl':
      require_once 'diemdulich/xoaddl.php';
      break;
      //Khách hàng
    case 'danhsachkhachhang':
      require_once 'khachhang/danhsachkhachhang.php';
      break;
    case 'themkhachhang':
      require_once 'khachhang/themkhachhang.php';
      break;
    case 'suakhachhang':
      require_once 'khachhang/suakhachhang.php';
      break;
    case 'xoakhachhang':
      require_once 'khachhang/xoakhachhang.php';
      break;
      //Loại tour
    case 'danhsachloaitour':
      require_once 'loaitour/danhsachloaitour.php';
      break;
    case 'themloaitour':
      require_once 'loaitour/themloaitour.php';
      break;
    case 'sualoaitour':
      require_once 'loaitour/sualoaitour.php';
      break;
    case 'xoaloaitour':
      require_once 'loaitour/xoaloaitour.php';
      break;
      //Nhân viên
    case 'danhsachnhanvien':
      require_once 'nhanvien/danhsachnhanvien.php';
      break;
    case 'themnhanvien':
      require_once 'nhanvien/themnhanvien.php';
      break;
    case 'thaydoimatkhau':
      require_once 'nhanvien/thaydoimatkhau.php';
      break;
    case 'suanhanvien':
      require_once 'nhanvien/suanhanvien.php';
      break;
    case 'xoanhanvien':
      require_once 'nhanvien/xoanhanvien.php';
      break;
      //Phản hồi
    case 'danhsachphanhoi':
      require_once 'phanhoi/danhsachphanhoi.php';
      break;
    case 'themphanhoi':
      require_once 'phanhoi/themphanhoi.php';
      break;
    case 'suaphanhoi':
      require_once 'phanhoi/suaphanhoi.php';
      break;
    case 'xoaphanhoi':
      require_once 'phanhoi/xoaphanhoi.php';
      break;
      //Phiếu đăng ký tour                       
    case 'danhsachphieudangkytour':
      require_once 'phieudangkytour/danhsachphieudangkytour.php';
      break;
    case 'themphieudangkytour':
      require_once 'phieudangkytour/themphieudangkytour.php';
      break;
    case 'suaphieudangkytour':
      require_once 'phieudangkytour/suaphieudangkytour.php';
      break;
    case 'xoaphieudangkytour':
      require_once 'phieudangkytour/xoaphieudangkytour.php';
      break;
      //Phiếu đặt tour
    case 'danhsachphieudattour':
      require_once 'phieudattour/danhsachphieudattour.php';
      break;
    case 'themphieudattour':
      require_once 'phieudattour/themphieudattour.php';
      break;
    case 'suaphieudattour':
      require_once 'phieudattour/suaphieudattour.php';
      break;
    case 'xoaphieudattour':
      require_once 'phieudattour/xoaphieudattour.php';
      break;
      //Sự kiện lễ hội
    case 'danhsachsklh':
      require_once 'sukienlehoi/danhsachsklh.php';
      break;
    case 'themsklh':
      require_once 'sukienlehoi/themsklh.php';
      break;
    case 'suasklh':
      require_once 'sukienlehoi/suasklh.php';
      break;
    case 'xoasklh':
      require_once 'sukienlehoi/xoasklh.php';
      break;
      //Tỉnh thành
    case 'danhsachtinhthanh':
      require_once 'tinhthanh/danhsachtinhthanh.php';
      break;
    case 'themtinhthanh':
      require_once 'tinhthanh/themtinhthanh.php';
      break;
    case 'suatinhthanh':
      require_once 'tinhthanh/suatinhthanh.php';
      break;
    case 'xoatinhthanh':
      require_once 'tinhthanh/xoatinhthanh.php';
      break;
      //Tin tức
    case 'danhsachtintuc':
      require_once 'tintuc/danhsachtintuc.php';
      break;
    case 'themtintuc':
      require_once 'tintuc/themtintuc.php';
      break;
    case 'suatintuc':
      require_once 'tintuc/suatintuc.php';
      break;
    case 'xoatintuc':
      require_once 'tintuc/xoatintuc.php';
      break;
      //Tour
    case 'danhsachtour':
      require_once 'tour/danhsachtour.php';
      break;
    case 'themtour':
      require_once 'tour/themtour.php';
      break;
    case 'suatour':
      require_once 'tour/suatour.php';
      break;
    case 'thongtintour':
      require_once 'tour/thongtintour.php';
      break;
    case 'xoatour':
      require_once 'tour/xoatour.php';
      break;
      //Trạng thái
    case 'danhsachtrangthai':
      require_once 'trangthai/danhsachtrangthai.php';
      break;
    case 'themtrangthai':
      require_once 'trangthai/themtrangthai.php';
      break;
    case 'suatrangthai':
      require_once 'trangthai/suatrangthai.php';
      break;
    case 'xoatrangthai':
      require_once 'trangthai/xoatrangthai.php';
      break;
    case '':
      require_once('thongke.php');
      break;
    default:
      require_once 'thongke.php';
      break;
  }
} else {
  include 'home_admin.php';
}
include "footer_admin.php";
?>