<?php
    $id = $_GET['idphieu'];
    $sql = "DELETE FROM phieudattour WHERE idphieu = $id";
    $query = mysqli_query($connect,$sql);
    // header('location: index.php?page_admin=danhsachphieudattour');
?>
<script type="text/javascript">location.href = 'index.php?page_admin=danhsachphieudattour';</script>