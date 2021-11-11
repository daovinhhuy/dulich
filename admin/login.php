<?php
    session_start();
    include_once('../models/database.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="../assets/libs/css/css_login.css">
    <script src="../assets/vendor/jquery/jquery-3.5.1.min.js"></script>
    <title>Đăng nhập trang quản trị</title>
</head>
<body>
<?php
error_reporting (E_ALL ^ E_NOTICE);
if(isset($_SESSION['nhanvien']))
{
	echo "<script language='javascript'>window.location='index.php';</script>";
}
if(isset($_POST['btnLogin']))
{
	$Username =  trim($_POST['txtTenDangNhap']);
	$Password = trim($_POST['txtMatKhau']);
	$loi = "Bạn chưa nhập tài khoản hoặc mật khẩu";
    $loi_1="Sai tài khoản hoặc mật khẩu";
    
	if($Username==""||$Password=="")
	{
		echo "<script type='text/javascript'>alert('$loi');</script>";
	}
	else
	{
		$Username = mysqli_real_escape_string($connect,$Username);
		$Password = md5($Password);
        $sql= "SELECT * FROM nhanvien WHERE tentaikhoan='$Username' AND matkhau='".$Password."'";
		$result = mysqli_query($connect,$sql) or die(mysqli_error($connect));
        if(mysqli_num_rows($result)==1){
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $_SESSION['nhanvien'] = $Username;
            header('location:index.php');
        }
        else if(mysqli_num_rows($result)==0){
            // echo "<script>setTimeout(function(){showSwalLoginError();},100);</script>";
            echo  "<script type='text/javascript'>alert('$loi_1');</script>";
        }
	}
}
?>
 <div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <form  class="box" method="POST"  action="">
                    <h1>Đăng nhập</h1>
                    <p class="text-muted"> Vui lòng nhập tài khoản và mật khẩu</p>
                    <input type="text" name="txtTenDangNhap"  placeholder="Nhập vào tên tài khoản" value="<?php echo isset($_POST['txtTenDangNhap']) ? $_POST['txtTenDangNhap'] : ''; ?>">
                    <input type="password" name="txtMatKhau" placeholder="Nhập vào mật khẩu">

                    <!-- <button type="submit" name="btnLogin" class="btn btn-primary">Đăng nhập</button> -->
                    <input type="submit" name="btnLogin"  class="btn btn-primary" id="btnLogin" value="Đăng nhập"/>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>

