<?php
    $id = $_GET['idnhanvien'];
    $sql = "DELETE FROM nhanvien WHERE idnhanvien = $id";
    $query = mysqli_query($connect,$sql);
    // header('location:index.php?page_admin=danhsachnhanvien');
?>
<script type="text/javascript">location.href = 'index.php?page_admin=danhsachnhanvien';</script>