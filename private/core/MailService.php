<?php

require_once dirname(__DIR__, 2) . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailService
{
    /**
     * Send an email using Gmail SMTP.
     *
     * IMPORTANT:
     * Replace the two placeholder values below with your
     * real Gmail address and the 16-character Gmail App Password.
     */
    public static function send(
        string $to,
        string $subject,
        string $message
    ): bool {

        $to = trim($to);

        if (
            $to === '' ||
            !filter_var($to, FILTER_VALIDATE_EMAIL)
        ) {
            return false;
        }

        // Gmail account used to send project emails.
        $smtpUsername = 'aarshvanjari1@gmail.com';

        // Gmail App Password (16 characters).
        $smtpPassword = 'yyfgagnwzarofwlf';

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = $smtpUsername;
            $mail->Password   = $smtpPassword;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            $mail->CharSet = 'UTF-8';

            $mail->setFrom(
                $smtpUsername,
                'My School Management System'
            );

            $mail->addAddress($to);

            $mail->isHTML(false);
            $mail->Subject = $subject;
            $mail->Body    = $message;

            return $mail->send();

        } catch (Exception $e) {
            error_log(
                'MailService Error: ' . $mail->ErrorInfo
            );

            return false;
        }
    }
}
