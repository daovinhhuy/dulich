<?php
  require_once"../models/database.php";	
  	require '../includes/PHPMailer.php';
	require '../includes/SMTP.php';
	require '../includes/Exception.php';
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;	
	use PHPMailer\PHPMailer\SMTP;

  	$sql =mysqli_query($connect,"SELECT * FROM tour t 
      INNER JOIN phieudattour p ON p.idtour = t.idtour 
      INNER JOIN khachhang kh ON kh.idkh = p.idkh");
   
   while ($row = mysqli_fetch_assoc($sql)) {
   		
        sendEmail($row['email'],$row['tenkh'],$row['tentour'],$row['ngaykhoihanh']);
   }
function sendEmail($email , $tenkh, $tentour, $ngaykhoihanh)
{
	$mail = new PHPMailer();
	$mail->isSMTP();
	$mail->CharSet = 'UTF-8';
	$mail->Host = "smtp.gmail.com";
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = "tls";
	$mail->Port = "587";
	$mail->Username = "dvhuy-cntt12@tdu.edu.vn"; //Người gửi mail
	$mail->Password = "12345678";
	$mail->Subject = "Thông báo về Tour khách hàng đã book sắp khởi hành"; //tiêu đề email
	$mail->setFrom('dvhuy-cntt12@tdu.edu.vn');//Người gửi mail
	
	// echo '123';
	// print_r($mail);
	// exit;
	$mail->Body = " Xin chào bạn $tenkh, Tour $tentour sẽ khởi hành vào ngày $ngaykhoihanh. Quý khách vui lòng đến nơi khởi hành đúng giờ. ";
	$mail->addAddress($email);//Người nhận mail
	
	if ( $mail->send() ){
		echo "Gửi Email thành công đến khách hàng!";
	}else{
		echo "Lỗi: " . $mail->ErrorInfo;
	}
	$mail->smtpClose();
	}
?>