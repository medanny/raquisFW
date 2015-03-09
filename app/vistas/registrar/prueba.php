<?php
$nombre=Utilerias::generarToken(8).".png";
$dir="app/temporales/archivos_subidos/";
$img=$dir.$nombre;
Qr::email_completo("daniel@unav.edu.mx","Requiero Informacion","Tu texto aqui","app/temporales/archivos_subidos/".$nombre,5);
?>
<img src="http://registro.tutzilabs.com.mx/<?=$img?>"/>

<?php

if(Validar::entre(20,14,24)){
	echo "el valor es mejor";
}else{echo "el numero no es permitido";}

if(Validar::correo("Hello good bye")){
	echo "el correo es correcto";
}else{
	echo "el correo no es correcto";
}