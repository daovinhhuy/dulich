<?php
    $id = $_GET['idcv'];
    $sql = "DELETE FROM chucvu WHERE idcv = $id";
    $query = mysqli_query($connect,$sql);
    // header('location: index.php?page_admin=danhsachchucvu');
?>
<script type="text/javascript">location.href = 'index.php?page_admin=danhsachchucvu';</script>