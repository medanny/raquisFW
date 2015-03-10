<?php
/**
 * correo.mod.php
 * 
 */

class Correo{

public static function correoSimple($emi_nombre, $emi_correo, $rec_nombre, $rec_correo, $asunto, $msj) {
        
        // multiple recipients
        $to = $rec_correo;
        
        // subject
        $subject = $asunto;
        
        // message
        $message = $msj;
        
        // To send HTML mail, the Content-type header must be set
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        
        // Additional headers
        $headers.= 'To:' . $rec_nombre . ' <' . $rec_correo . '>' . "\r\n";
        $headers.= 'From:' . $emi_nombre . ' <' . $emi_correo . '>' . "\r\n";
        
        // Mail it
        mail($to, $subject, $message, $headers);
}

public static function correoAdjunto($filename, $path, $mailto, $from_mail, $from_name, $replyto, $subject, $message) {
        $file = $path;
        $file_size = filesize($file);
        $handle = fopen($file, "r");
        $content = fread($handle, $file_size);
        fclose($handle);
        $content = chunk_split(base64_encode($content));
        $uid = md5(uniqid(time()));
        $name = basename($file);
        $header = "From: " . $from_name . " <" . $from_mail . ">\r\n";
        $header.= "Reply-To: " . $replyto . "\r\n";
        $header.= "MIME-Version: 1.0\r\n";
        $header.= "Content-Type: multipart/mixed; boundary=\"" . $uid . "\"\r\n\r\n";
        $header.= "This is a multi-part message in MIME format.\r\n";
        $header.= "--" . $uid . "\r\n";
        $header.= "Content-type:text/plain; charset=iso-8859-1\r\n";
        $header.= "Content-Transfer-Encoding: 7bit\r\n\r\n";
        $header.= $message . "\r\n\r\n";
        $header.= "--" . $uid . "\r\n";
        $header.= "Content-Type: application/octet-stream; name=\"" . $filename . "\"\r\n";
        
        // use different content types here
        $header.= "Content-Transfer-Encoding: base64\r\n";
        $header.= "Content-Disposition: attachment; filename=\"" . $filename . "\"\r\n\r\n";
        $header.= $content . "\r\n\r\n";
        $header.= "--" . $uid . "--";
        if (mail($mailto, $subject, "", $header)) {
            
            // echo '<script language="javascript">';
            // echo 'alert("Thank You, your application has been summited!")';
            // echo '</script>';
            
            
        } else {
            
            //echo '<script language="javascript">';
            //echo 'alert("We are sorry there was a problem processing your form.")';
            //echo '</script>';
            
            
        }
    }


    public static function mandarCorreoSMTP($correo_destino, $nombre_destino, $asunto, $cuerpo) {
        include ($nivel_dir . "CONF/conf.php");
        
        date_default_timezone_set('America/El_Salvador');
        
        //Se define la zona horaria
        require_once ('class.phpmailer.php');
        
        //Incluimos la clase phpmailer
        $mail = new PHPMailer(true);
        
        // Declaramos un nuevo correo, el parametro true significa que mostrara excepciones y errores.
        
        $mail->IsSMTP();
        
        // Se especifica a la clase que se utilizará SMTP
        
        try {
            
            //------------------------------------------------------
            $correo_emisor = CORREO_EMISOR;
            
            //Correo a utilizar para autenticarse
            //con Gmail o en caso de GoogleApps utilizar con @tudominio.com
            $nombre_emisor = NOMBRE_EMISOR;
            
            //Nombre de quien envía el correo
            $contrasena = CONTRASENA;
            
            //contraseña de tu cuenta en Gmail
            $correo_destino = $correo_destino;
            
            //Correo de quien recibe
            $nombre_destino = $nombre_destino;
            
            //Nombre de quien recibe
            //--------------------------------------------------------
            $mail->SMTPDebug = 0;
            
            // Habilita información SMTP (opcional para pruebas)
            // 1 = errores y mensajes
            // 2 = solo mensajes
            $mail->SMTPAuth = true;
            
            // Habilita la autenticación SMTP
            $mail->SMTPSecure = "ssl";
            
            // Establece el tipo de seguridad SMTP
            $mail->Host = "smtp.gmail.com";
            
            // Establece Gmail como el servidor SMTP
            $mail->Port = 465;
            
            // Establece el puerto del servidor SMTP de Gmail
            $mail->Username = $correo_emisor;
            
            // Usuario Gmail
            $mail->Password = $contrasena;
            
            // Contraseña Gmail
            
            //A que dirección se puede responder el correo
            $mail->AddReplyTo($correo_emisor, $nombre_emisor);
            
            //La direccion a donde mandamos el correo
            $mail->AddAddress($correo_destino, $nombre_destino);
            
            //De parte de quien es el correo
            $mail->SetFrom($correo_emisor, $nombre_emisor);
            
            //Asunto del correo
            $mail->Subject = $asunto;
            
            //Mensaje alternativo en caso que el destinatario no pueda abrir correos HTML
            $mail->AltBody = 'Para ver el mensaje necesita un cliente de correo compatible con HTML.';
            
            //El cuerpo del mensaje, puede ser con etiquetas HTML
            
            ob_start();
            
            $content = ob_get_clean();
            
            //contenido de correo
            $mail->Body = $cuerpo;
            
            $mail->Send();
        }
        catch(phpmailerException $e) {
            echo $e->errorMessage();
            
            //Errores de PhpMailer
            
            
        }
        catch(Exception $e) {
            echo $e->getMessage();
            
            //Errores de cualquier otra cosa.
            
            
        }
    }
}