<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require 'phpMailer/PHPMailer.php';
require 'phpMailer/Exception.php';
require 'phpMailer/SMTP.php';

class MailService
{
    private const SERVER_SMTP = "smtp.hostinger.com";
    private const SERVER_IMAP = "imap.hostinger.com";
    private const MAIL        = "master@souche-dev.deepcampfire.online";
    private const PASSWORD    = "gOLUM2804.";



    public static function mailConfirmation($mailUser)
    {
        $user = NewUserService::getNewUser($mailUser);

        $to = $mailUser;
        $subject = "No reply // Confirmation Mail de {$user->loginTmpUser}";
        $content = "<h2 style='color: #6f1d1b; background-color: #FFE6A7' >Bienvenue dans la Souche</h2>
                    <p>Il te reste plus qu'une étape avant de profiter de toutes les fonctionalités de la Souche<br>
                    Pour ça il te suffit de cliquer sur ce <a href='http://souche-dev.deepcampfire.online/confirmMail?id=".$user->idTmpUser."'>lien</a><br>
                    Et de rentré ce code : <strong>" . $user->codeTmpUser . "</strong><br>
                    Merci pour votre confiance<br>
                    Cordialement <br></p>
                    <p>Souche Modo Familly Club (･ω<)☆</p>";

        self::sendMail($to, $subject, $content);
    }

    private static function sendMail($to, string $subject, string $content, $wordWarp = 50)
    {
        $mail = new PHPMailer();
        $mail->CharSet = "UTF-8";

            $mail->addAddress($to);
            $mail->setFrom("master@souche-dev.deepcampfire.online", "Souche Modo Familly Club");

            $mail->Subject = $subject;
            $mail->WordWrap = $wordWarp;

            $mail->isHTML();
            $mail->Body = $content;
//            $mail->msgHTML($content);

        try {
            $mail->send();
            if(!empty(self::SERVER_IMAP)) {
                // Add the message to the IMAP.Sent mailbox
                $mail_string = $mail->getSentMIMEMessage();
                $imap_stream = imap_open("{".self::SERVER_IMAP."}", self::MAIL, self::PASSWORD);
                imap_append($imap_stream, "{".self::SERVER_IMAP."}INBOX.Sent", $mail_string);
            }
        }catch (\Exception $exception){
            echo $exception->getMessage();
            die();
        }

    }
}