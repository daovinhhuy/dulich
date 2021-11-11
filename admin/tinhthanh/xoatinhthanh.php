<?php
    $id = $_GET['idtinhthanh'];
    $sql = "DELETE FROM tinhthanh WHERE idtinhthanh = $id";
    $query = mysqli_query($connect,$sql);
    // header('location:index.php?page_admin=danhsachtinhthanh');
?>
    <script type="text/javascript">location.href = 'index.php?page_admin=danhsachtinhthanh';</script>