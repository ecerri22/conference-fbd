<?php
if ((isset($_POST['first_name'])) && (strlen(trim($_POST['first_name'])) > 0)) {
    $first_name = stripslashes(strip_tags($_POST['first_name']));
} else {
    $first_name = 'No name entered';
}
if ((isset($_POST['last_name'])) && (strlen(trim($_POST['last_name'])) > 0)) {
    $last_name = stripslashes(strip_tags($_POST['last_name']));
} else {
    $last_name = 'No name entered';
}
if ((isset($_POST['email'])) && (strlen(trim($_POST['email'])) > 0)) {
    $email = stripslashes(strip_tags($_POST['email']));
} else {
    $email = 'No email entered';
}
if ((isset($_POST['phone'])) && (strlen(trim($_POST['phone'])) > 0)) {
    $phone = stripslashes(strip_tags($_POST['phone']));
} else {
    $phone = 'No phone entered';
}
ob_start();
?>
<html>
<head>
    <style type="text/css">
    </style>
</head>
<body>
<table width="550" border="0" cellspacing="0" cellpadding="15">
    <tr bgcolor="#eeffee">
        <td>First Name</td>
        <td><?php echo $first_name; ?></td>
    </tr>
    <tr bgcolor="#eeeeff">
        <td>Last Name</td>
        <td><?php echo $last_name; ?></td>
    </tr>
    <tr bgcolor="#eeffee">
        <td>Email Address</td>
        <td><?php echo $email; ?></td>
    </tr>
    <tr bgcolor="#eeeeff">
        <td>Phone Number</td>
        <td><?php echo $phone; ?></td>
    </tr>
</table>
</body>
</html>
<?php
$body = ob_get_contents();

$to = 'you@domain.com';
$toname = 'Your Name';
//$anotheraddress = 'email@example.com';
//$anothername = 'Another Name';

require("phpmailer.php");

$mail = new PHPMailer();

$mail->From = $email;
$mail->FromName = $name;
$mail->AddAddress($to, $toname); // Put your email
//$mail->AddAddress($anotheraddress,$anothername); // addresses here

$mail->WordWrap = 50;
$mail->IsHTML(true);

$mail->Subject = "Demo Form:  Registration form submitted";
$mail->Body = $body;
$mail->AltBody = $message;

if (!$mail->Send()) {
    $recipient = $to;
    $subject = 'Registration form failed';
    $content = $body;
    mail($recipient, $subject, $content, "From: $name\r\nReply-To: $email\r\nX-Mailer: DT_formmail");
    exit;
}
?>
