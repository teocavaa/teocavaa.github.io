<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['message']) || !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
    echo "No arguments Provided!";
    exit;
}

$name = $_POST['name'];
$email_address = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];

$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'mattecava02@gmail.com';        // la tua Gmail (dove ricevi i forward)
    $mail->Password   = 'mzlv nlhx qidc iqtk';       // app password generata da Google
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Mittente e destinatari
    $mail->setFrom('noreply@dockhub.net', 'Dockhub'); // mittente mostrato (richiede che Gmail lo permetta)
    $mail->addAddress('mattecava02@gmail.com');       // destinatario finale

    // Contenuto
    $mail->Subject = "Modulo di Contatto del Sito Web: $name";
    $body = "Hai ricevuto un nuovo messaggio dal modulo di contatto.\n\nNome: $name\nEmail: $email_address\nTelefono: $phone\n\nMessaggio:\n$message";
    $mail->Body = $body;
    $mail->CharSet = 'UTF-8';

    $mail->send();
    echo 'Email inviata';
} catch (Exception $e) {
    echo "Mailer Error: " . $mail->ErrorInfo;
}
