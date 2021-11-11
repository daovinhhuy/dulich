<?php
    $id = $_GET['idphieudangky'];
    $sql = "DELETE FROM phieudangkytour WHERE idphieudangky = $id";
    $query = mysqli_query($connect,$sql);
    // header('location: index.php?page_admin=danhsachphieudangkytour');
?>
<script type="text/javascript">location.href = 'index.php?page_admin=danhsachphieudangkytour';</script>