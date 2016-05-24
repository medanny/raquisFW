<?php

namespace fw\mods\qrs;
include_once (RUTA_MODULOS."qrs/qrcode/qrlib.php");
class Qr{


	public static function simple($texto,$directorio=null,$tamano=10){
		return QRcode::png($texto,$directorio,QR_ECLEVEL_H,$tamano,1);
	}

	public static function telefono($texto,$directorio=null,$tamano=10){
		$texto='tel:'.$texto;
		return QRcode::png($texto,$directorio,QR_ECLEVEL_H,$tamano,1);
	}

	public static function sms($texto,$directorio=null,$tamano=10){
		$texto='sms:'.$texto;
		return QRcode::png($texto,$directorio,QR_ECLEVEL_H,$tamano,1);
	}

	public static function email_simple($texto,$directorio=null,$tamano=10){
		$texto='mailto:'.$texto;
		return QRcode::png($texto,$directorio,QR_ECLEVEL_H,$tamano,1);
	}

	public static function email_completo($correo,$tema,$cuerpo,$directorio=null,$tamano=10){
		$texto='mailto:'.$correo.'?subject='.urlencode($tema).'&body='.urlencode($cuerpo);
		return QRcode::png($texto,$directorio,QR_ECLEVEL_L,$tamano,1);

	}

	public static function tarjeta($nombre,$telefono,$directorio=null,$tamano=10){
    $texto  = 'BEGIN:VCARD'."\n";
    $texto .= 'FN:'.$nombre."\n";
    $texto .= 'TEL;WORK;VOICE:'.$telefono."\n";
    $texto .= 'END:VCARD';
    return QRcode::png($texto,$directorio,QR_ECLEVEL_H,$tamano,1);

	}
}