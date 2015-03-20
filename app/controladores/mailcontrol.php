<?php
/**
* 
*/
class MailControl extends Control
{
	
	function index()
	{
		if(isset($_POST['emi_correo'])){
			$emi_nombre = $_POST['emi_nombre'];
			$emi_correo = $_POST['emi_correo'];
			$rec_nombre = $_POST['rec_nombre'];
			$rec_correo = $_POST['rec_correo'];
			$asunto = $_POST['asunto'];
			$msj = $_POST['msj'];
			Correo::correoSimple($emi_nombre, $emi_correo, $rec_nombre, $rec_correo, $asunto, $msj);
			echo "El correo a sido enviado a: $rec_correo";
		}
	}
}
?>