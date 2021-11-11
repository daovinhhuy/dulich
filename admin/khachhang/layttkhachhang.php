<?php
    include_once('../../models/database.php');
    $sdt = $_POST['sodientthoai'];
    $sql_sdt = "SELECT * FROM khachhang WHERE sdt='$sdt' ";
    $query = mysqli_query($connect, $sql_sdt);
    while ($row  = mysqli_fetch_assoc($query)){
        $result = $row ;
    }
    if(isset($_POST['laytttour'])){
        $sql_tour = "SELECT t.idtour, t.mstour, t.tentour, t.ngaykhoihanh, t.ngayketthuc 
        FROM phieudattour p, tour t
        WHERE p.idtour = t.idtour and p.idkh = '".$result['idkh']."' AND p.idtrangthai = 2";
        $query = mysqli_query($connect, $sql_tour);
        $tttour = array() ;
        while ($row  = mysqli_fetch_assoc($query)){
            $tttour[] = $row ;
        }
        $result['tttour']= $tttour;
    }
    echo json_encode($result);
?>