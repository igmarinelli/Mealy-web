<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

        try {
            $mail = new PHPMailer(true);
            //$mail->SMTPDebug = 2;
            $mail->isSMTP();
            $mail->Host = 'mx1.hostinger.com';
						$mail->SMTPAuth = true;
						$mail->Username = 'hi@mealy.me';
						$mail->Password = 'mealyme9597'; 
            $mail->Port = 587;
            $mail->SMTPSecure = 'ssl';
            $mail->setFrom('hi@mealy.me', 'Mealy');

            $mail->addAddress('igmdesigner@gmail.com'); 

            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = 'Top 10 Indicadores Fora - ' . $subject . $today->format('d/m/y');

            //HEADER
            $mail->Body = '<div><span style="font-size: normal;">Ol&aacute;, ' . $u['firstname'] . '!</span></div><div><span style="font-size: normal;">&nbsp;</span></div><div><span style="font-size: normal;">' . $catch . ', estes foram os&nbsp;<u>Top 10 Indicadores Piores</u>&nbsp;que ficaram fora de seus limites:</span></div><div><span style="font-size: normal;">&nbsp;</span></div>';

            //FOOTER
            $mail->Body .= file_get_contents('../templates/emailtopfooter.php');

            echo $mail->Body;

            $mail->send();
            echo 'Message has been sent';

            User::updateCheck($sql, $u['id'], $today->format('d'));

        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }