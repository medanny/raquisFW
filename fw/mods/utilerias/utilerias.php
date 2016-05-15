<?php
/**
 * Utilerias.
 *
 * Clase encargada de empaquetar herramientas para facilitar el desarrollo.
 * @package Modulos
 * @author Daniel Lozano Carrillo
 * @version 2.4
 *
 */

namespace fw\mods\utilerias;
class Utilerias
{
    /**
     * redireccionamiento seguro es usado para poder redireccionar, a una nueva pagina y no
     * recibir erroress de headers already sent, ect...
     * @param  String $url url de  la pagina a redireccionar.
     */
    public static function redirectSeguro($url) {
        
        // Solo usar header redirec si no ah sido usado, para envitar error
        //de headers ya redirecionadas.
        
        if (!headers_sent()) {
            
            header('HTTP/1.1 301 Moved Permanently');
            header('Location: ' . $url);
            
            // para IE
            header("Connection: close");
        }
        
        // Metodo HTML/JAVASCRIP:
        // Si no funciona en php intentar otros metodos.
        
        print '<html>';
        print '<head><title>Te estamos redirecionando...</title>';
        print '<meta http-equiv="Refresh" content="0;url=' . $url . '" />';
        print '</head>';
        print '<body onload="location.replace(\'' . $url . '\')">';
        
        // Si javascript no funciona
        // el usuario podra darclick en un lunk
        print 'Debes de ser redirecionado a:<br />';
        print '<a href="' . $url . '">' . $url . '</a><br /><br />';
        
        print 'Si no funciona, porfavor dar click en link.<br />';
        
        print '</body>';
        print '</html>';
        
        // salir
        exit;
    }
    
    /**
     * Elimnar numeros de un String.
     * @param  String $texto String al cual se le eliminaran los numeros.
     * @return String        Texto sin numeros.
     */
    public static function eliminarNumeros($texto) {
        return preg_replace('/[0-9]+/', '', $texto);
    }
    
    /**
     * Clase encargada de generar numeros que no se repitan.
     * @param  int $min Numero Minimo
     * @param  int $max Numaro Maxico
     * @return int      Numero Generado
     */
    public static function crypto_redoeado_seguro($min, $max) {
        $range = $max - $min;
        if ($range < 0) return $min;
        
        $log = log($range, 2);
        $bytes = (int)($log / 8) + 1;
        
        $bits = (int)$log + 1;
        
        $filter = (int)(1 << $bits) - 1;
        
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter;
            
            
            
        } while ($rnd >= $range);
        return $min + $rnd;
    }
    
    /**
     * Generar un String de Numeros y Letras
     * @param  int $tamano Tamano del string a devolver
     * @return String      Texto o Token generado
     */
    public static function generarToken($tamano) {
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";
        for ($i = 0; $i < $tamano; $i++) {
            $token.= $codeAlphabet[self::crypto_redoeado_seguro(0, strlen($codeAlphabet)) ];
        }
        return $token;
    }
    

    /**
     * Generador de Claves
     * @param  int $tamano Tamano del string a devolver
     * @return String      Texto o Clave generada
     */
    public static function generarClave($tamano) {
        
        //caracteres que usaremos
        $caracteres = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!%,-:;@_{}~";
        for ($i = 0, $pass = '', $len = strlen($caracteres); $i < $tamano; $i++) {
            $pass.= $caracteres[mt_rand(0, $len - 1) ];
        }
        return $pass;
    }


    public static function borrarTextoEntre($princio, $fin, $string){
        $principioPos = strpos($string, $principio);
        $finPos = strpos($string, $fin);
        if ($principioPos === false || $finPos === false) {
            return $string;
        }
        $textToDelete = substr($string, $principioPos, ($finPos + strlen($fin)) - $principioPos);
        return str_replace($textToDelete, '', $string);
    }

    public static function textoEntre($string, $start, $end){ // string, incio, final
    $string = " ".$string;
    $ini = strpos($string,$start);
    if ($ini == 0) return "";
    $ini += strlen($start);   
    $len = strpos($string,$end,$ini) - $ini;
    return substr($string,$ini,$len);
}



}
