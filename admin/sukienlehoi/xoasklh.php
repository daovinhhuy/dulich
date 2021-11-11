<?php
    $id = $_GET['idsklh'];
    $sql = "DELETE FROM sukienlehoi WHERE idsklh = $id";
    $query = mysqli_query($connect,$sql);
    // header('location: index.php?page_admin=danhsachsklh');
?>
<script type="text/javascript">location.href = 'index.php?page_admin=danhsachsklh';</script>