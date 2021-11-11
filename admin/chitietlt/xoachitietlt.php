<?php
    $id = $_GET['idchitietlt'];
    $sql = "DELETE FROM chitietlt WHERE idchitietlt = $id";
    $query = mysqli_query($connect,$sql);
    // header('location:index.php?page_admin=danhsachchitietlt');
?>
<script type="text/javascript">location.href = 'index.php?page_admin=danhsachchitietlt';</script>