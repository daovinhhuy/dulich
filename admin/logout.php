<?php
session_start();
if(isset($_SESSION['nhanvien']) && $_SESSION['nhanvien'] != NULL){
    unset($_SESSION['nhanvien']);
    header('location:index.php');
}
?>
