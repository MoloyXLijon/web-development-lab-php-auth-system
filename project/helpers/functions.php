<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function sendOTP($to, $otp) {
    echo "<div class='alert alert-info'>Pretending to send OTP <strong>$otp</strong> to <strong>$to</strong>.</div>";
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'moloy.das@uttarauniversity.edu.bd';
        $mail->Password   = 'setup-your-mail-password';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('moloy.das@uttarauniversity.edu.bd', 'Php Lab');
        $mail->addAddress($to);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Your OTP Code';
        $mail->Body    = "Your OTP is: <b>$otp</b>";

        $mail->send();
        return true;
    } catch (Exception $e) {
        echo "Mailer Error: {$mail->ErrorInfo}";
    }
}

