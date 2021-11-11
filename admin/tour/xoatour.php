<?php
    $id = $_GET['idtour'];
    $sql = "DELETE FROM tour WHERE idtour = $id";
    $query = mysqli_query($connect,$sql);
    // header('location: index.php?page_admin=danhsachtour');
?>
<script type="text/javascript">location.href = 'index.php?page_admin=danhsachtour';</script>