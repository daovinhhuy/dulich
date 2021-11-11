<?php
    $id = $_GET['idtrangthai'];
    $sql = "DELETE FROM trangthai WHERE idtrangthai = $id";
    $query = mysqli_query($connect,$sql);
    // header('location: index.php?page_admin=danhsachtrangthai');
?>
    <script type="text/javascript">location.href = 'index.php?page_admin=danhsachtintuc';</script>
