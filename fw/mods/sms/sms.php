<?php
/**
 * Class Sms
 * @package fw\mods\sms
 */

namespace fw\mods\sms;

class Sms {
    /**
     * @param $to Strig numero de telefono a mandar mensaje codigo pais + codigo de area + numero.
     * @param $text String texto a mandar.
     * @return mixed
     */
    public static function nuevo($to,$text){
        $url = 'https://rest.nexmo.com/sms/json?' . http_build_query(
                [
                    'api_key' =>  API_KEY,
                    'api_secret' => API_SECRET,
                    'to' => $to,
                    'from' => 'Daniel',
                    'text' => $text
                ]
            );

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        return $response;
    }

	
}