<?php
    $id = $_GET['idloaitour'];
    $sql = "DELETE FROM loaitour WHERE idloaitour = $id";
    $query = mysqli_query($connect,$sql);
    // header('location: index.php?page_admin=danhsachloaitour');
?>
<script type="text/javascript">location.href = 'index.php?page_admin=danhsachloaitour';</script>