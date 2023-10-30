<?php
$to      = 'kurniawab.agung@gmail.com';
$subject = 'Email Confirmation';
$message = 'Please verify your email
Dear Company Name,
You have registered to Join ITPCLagos, this is your temporary login
------------------------------------------------------------
username : your email address
password : password
------------------------------------------------------------
To login to your account please follow this url : http://v2.itpclagos.com/member/';
$headers = 'From:ITPCLagos < admin@itpclagos.com>' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
?>