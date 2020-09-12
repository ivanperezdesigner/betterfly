<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

$email= $_POST['email'];
$destino = ["admin@betterflyhseq.com","joseivanperezdiaz1@gmail.com", "marjorieperez@betterflyhseq.com"];
$asunto = "Mensaje página Betterfly HSEQ";
$name = $_REQUEST['nombre'];
$iphone = $_REQUEST['iphone'];
$sst = $_REQUEST['sst'];
$calidad = $_REQUEST['calidad'];
$ambiental = $_REQUEST['ambiental'];
$covid = $_REQUEST['covid'];
$message = $_REQUEST['message'];

if(empty($email)){
    header("Location:".$_SERVER['HTTP_REFERER']);
    echo "Hay campos vacíos, por favor llenar los campos requeridos con * <a href=\"\">Volver</a>.";
}else{
    $carta ="Este es un nuevo contacto de tu página Betterfly HSEQ Nombre: $name Teléfono: $iphone Correo: $email Mensaje: $message Servicios: $sst $calidad $ambiental $covid";
    mail($destino[0],$asunto,$carta);
    mail($destino[1],$asunto,$carta);
    mail($destino[2],$asunto,$carta);
    header("Location:".$_SERVER['HTTP_REFERER']);
    echo 'El mensaje ha sido enviado';
}
?>




<!-- 
$action = $_REQUEST['action'];

if ($action == "") {
?>
    Campos del formulario editables
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="action" value="submit"> <br><br>
        Nombre*<br>
        <input name="nombre" type="text" value="" size="30" placeholder="Escriba su nombre" /><br><br>
        Teléfono*<br>
        <input name="iphone" type="text" value="" size="30" placeholder="Escriba su teléfono" /><br><br>
        Correo*<br>
        <input name="email" type="text" value="" size="30" placeholder="Escriba su correo" /><br><br>
        Mensaje*<br>
        <textarea name="message" rows="7" cols="30"></textarea><br><br>

        <input type="submit" value="Enviar" />
    </form>
-->


<?php
// } else {

    // Variables donde se guardan los datos del formulario 
    $name = $_REQUEST['nombre'];
    $iphone = $_REQUEST['iphone'];
    $email = $_REQUEST['email'];
    $message = $_REQUEST['message'];

    $mail = new PHPMailer;
    // Condicional de campos vacíos 
    if (($name == "") || ($iphone == "") || ($email == "") || ($message == "")) {
        echo "Hay campos vacíos, por favor llenar los campos requeridos con * <a href=\"\">Volver</a>.";
    } else {


        try {
            // $mail->SMTPDebug = 4;                               // Habilitar el debug

            $mail->isSMTP();                                      // Usar SMTP
            $mail->Host = '	mail.betterflyhseq.com';  // Especificar el servidor SMTP reemplazando por el nombre del servidor donde esta alojada su cuenta
            $mail->SMTPAuth = true;                               // Habilitar autenticacion SMTP
            $mail->Username = 'admin@betterflyhseq.com';                 // Nombre de usuario SMTP donde debe ir la cuenta de correo a utilizar para el envio
            $mail->Password = 'nmu40cIP*';                           // Clave SMTP donde debe ir la clave de la cuenta de correo a utilizar para el envio
            $mail->SMTPSecure = 'ssl';                            // Habilitar encriptacion
            $mail->Port = 465;                                    // Puerto SMTP                     
            $mail->Timeout       =   30;
            $mail->AuthType = 'LOGIN';

            //Destinatarios 

            $mail->setFrom('admin@betterflyhseq.com');     //Direccion de correo remitente (DEBE SER EL MISMO "Username")
            $mail->addAddress('admin@betterflyhseq.com');     // Agregar el destinatario
            $mail->addBCC($email); // Direccion con copia del envío
            $mail->addReplyTo('admin@betterflyhseq.com');     //Direccion de correo para respuestas     



            //Contenido
            $mail->isHTML(true);
            $mail->Subject = 'Mensaje de la pagina web';
            $mail->Body    = "Nombre: $name <br> Teléfono: $iphone <br> Correo: $email <br>  Mensaje: $message <br>"; // Contenido del mensaje. 

            $mail->send();
            echo 'El mensaje ha sido enviado';
        } catch (Exception $e) {
            echo 'El mensaje no pudo ser enviado. Mailer Error: ', $mail->ErrorInfo;
        }
    }
// }
?>