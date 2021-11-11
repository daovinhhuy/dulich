<?php
    $id = $_GET['iddiemdulich'];
    $sql = "DELETE FROM diemdulich WHERE iddiemdulich = $id";
    $query = mysqli_query($connect,$sql);
    // header('location: index.php?page_admin=danhsachddl');
?>
<script type="text/javascript">location.href = 'index.php?page_admin=danhsachddl';</script>