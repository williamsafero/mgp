<?php
include "classes/class.phpmailer.php";
$mail = new PHPMailer;

// EMAIL SETUP (PENGIRIM)
$setmail = "yolandayudina@gmail.com";
$setmailpwd = "y0l4nd4y123";

// PENERIMA iini mg
$toemail = "williamsafero@yahoo.co.id";
$toname = "MrGG";

// IDENTITY FORM ini yg diisi
$myemail = $_POST['email'];
$myname = $_POST['name'];
$tosubject = "Pesan Dari Pengunjung Web";
$tmpbody = $_POST['message'];

$defBody = sprintf("Email: %s<br/>Name: %s<br/>=============================<br/>", $myemail,$myname);
$tobody = sprintf("%s%s", $defBody,$tmpbody);

//Enable SMTP debugging.
$mail->SMTPDebug = 0;
// 0 -> for Production
// 1 -> Client Debug
// 2 -> Server Debug

$mail->isSMTP();
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = true;
$mail->Username = $setmail;
$mail->Password = $setmailpwd;
$mail->SMTPSecure = "tls";
$mail->Port = 587;

$mail->setFrom($myemail);
$mail->FromName = sprintf("Message From: %s", $myname);

$mail->addAddress($toemail, $toname);

$mail->isHTML(true);

$mail->Subject = $tosubject;
$mail->Body    = $tobody;

if(!$mail->send()){
	echo "Mailer Error: " . $mail->ErrorInfo;
}
else{
	echo "<script>
      window.history.back();
    </script>";
}
?>