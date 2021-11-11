<?php
    $id = $_GET['idkh'];
    $sql = "DELETE FROM khachhang WHERE idkh = $id";
    $query = mysqli_query($connect,$sql);
    // header('location: index.php?page_admin=danhsachkhachhang');
?>
<script type="text/javascript">location.href = 'index.php?page_admin=danhsachkhachhang';</script>