<?php
    $id = $_GET['idph'];
    $sql = "DELETE FROM phanhoi WHERE idph = $id";
    $query = mysqli_query($connect,$sql);
    // header('location:./index.php?page_admin=danhsachphanhoi');
?>
    <script type="text/javascript">location.href = 'index.php?page_admin=danhsachphanhoi';</script>
