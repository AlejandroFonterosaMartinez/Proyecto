<?php
require_once('..' . DIRECTORY_SEPARATOR . 'Model' . DIRECTORY_SEPARATOR . 'registro_modelo.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'phpmailer' . DIRECTORY_SEPARATOR . 'phpmailer' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'Exception.php';
require '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'phpmailer' . DIRECTORY_SEPARATOR . 'phpmailer' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'PHPMailer.php';
require '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'phpmailer' . DIRECTORY_SEPARATOR . 'phpmailer' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'SMTP.php';

if (isset($_POST['submit'])) {
    $nombre = $_POST['username'];
    $apellidos = $_POST['apellidos'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    // ENVIO DEL CORREO:
    /*$mail = new PHPMailer(true);
    try {
    //Server settings
    $mail->SMTPDebug = 2; //Enable verbose debug output
    $mail->isSMTP(); //Send using SMTP
    $mail->Host = 'smtp.office365.com'; //Set the SMTP server to send through
    $mail->SMTPAuth = true; //Enable SMTP authentication
    $mail->Username = 'servidorcorreo'; //SMTP username
    $mail->Password = ''; //SMTP password
    $mail->SMTPSecure = 'tls'; //Enable implicit TLS encryption
    $mail->Port = 587; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    //Recipients
    $mail->setFrom('alejandrofonterosamartinez@hotmail.com', 'Mailer');
    $mail->addAddress($email, $nombre); //Add a recipient
    //Content
    $mail->isHTML(true); //Set email format to HTML
    $mail->Subject = 'Registro en BricoTeis SL';
    $mail->Body = 'Gracias por registrarte en BricoTeis SL, ' . $nombre . '  disfruta de nuestros productos.</b>';
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $mail->send();
    } catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    */
    // REGISTRO
    $registro = new UserRegistration();
    $registro->register($nombre, $apellidos, $fecha_nacimiento, $email, $password);
    session_start();
    setcookie("Usuario", $email, time() + 60 * 60 * 24 * 30, DIRECTORY_SEPARATOR);
    $_SESSION['correo'] = $email;
}