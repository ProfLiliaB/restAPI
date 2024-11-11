<?php
// $to = 'lilia.bsilveira@sp.senac.br'; // Substitua pelo endereço de e-mail do destinatário
// $subject = 'Confirmação de Cadastro';
// $message = 'Obrigado por se cadastrar em nosso site! Clique abaixo para confirmar seu e-mail:';
// $message .= 'http://www.seusite.com/confirmacao.php?email=' . urlencode($to);
// $headers = 'From: Lilia Borges teste' . "\r\n" .
//            'Reply-To: liliapds@gmail.com' . "\r\n";
// if (mail($to, $subject, $message, $headers)) {
//     echo 'E-mail enviado com sucesso!';
// } else {
//     echo 'Falha ao enviar o e-mail.';
// }
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    // Configurações do servidor
    $mail->SMTPDebug = SMTP::DEBUG_OFF;   
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'liliapds@gmail.com';
    $mail->Password = '';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    // Destinatários
    $mail->setFrom('noreply@gmail.com', 'Site teste');
    $mail->addAddress('liliadppmu@gmail.com');  
    $mail->isHTML(true);
    $mail->Subject = 'Email Marketing';
    $mail->msgHTML(file_get_contents('email.html'), __DIR__);
    //$mail->Body    = 'Mensagem do Corpo do Email usando a Biblioteca PHPMail()';
    $mail->CharSet = 'UTF-8'; 
    $mail->isHTML(true);
    $mail->addAttachment('img.svg');
    $mail->AltBody = 'Email Marketing Soluções Web';
    if($mail->send()) {
        echo 'E-mail enviado com sucesso!';
    } else {
        echo "Email não enviado!";
    }    
} catch (Exception $e) {
    echo "Falha ao enviar o e-mail. Erro: {$mail->ErrorInfo}";
}