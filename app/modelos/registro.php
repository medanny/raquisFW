<?php

   /**
   * 
   */
  
   class Registro extends Modelo
   {
   	
   	public function ponencias($horario){

   		return $this->aArray($this->query(
   			"SELECT * 
FROM ponencias, ponencia, horario, lugar
WHERE hora =$horario
AND ponencias.id_ponencia = ponencia.id
AND ponencias.hora = horario.id
AND ponencias.lugar = lugar.id
LIMIT 0 , 30" ));
   	}
   }

?>