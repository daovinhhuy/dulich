<?php
    $id = $_GET['idtintuc'];
    $sql = "DELETE FROM tintuc WHERE idtintuc = $id";
    $query = mysqli_query($connect,$sql);
    // header('location: index.php?page_admin=danhsachtintuc');
?>
<script type="text/javascript">location.href = 'index.php?page_admin=danhsachtintuc';</script>