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
            
            $mail->setFrom('hi@mealy.me', 'Mealy');

            $mail->addAddress($_COOKIE["userEmail"]); 

            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = 'Mealy - Your Receipt [' . $_COOKIE["reservationCode"] . ']';

            //HEADER
            $mail->Body = "Hello world";

            $mail->send();
            echo 'Message has been sent';

        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }