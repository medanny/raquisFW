<?php
/**
* 
*/
class RegistroControl extends Control
{
	
	public function index(){


			$this->set("ponencias1", $this->Registro->ponencias(1));
		    $this->set("ponencias2", $this->Registro->ponencias(2));
		    //$this->set("ponencias3", $this->ponencia(3));
		    //$this->set("ponencias4", $this->ponencia(4));

		if(isset($_POST['nombre'])){
			
			// numero, minimo, maximo
			var_dump($_POST); 
			
			if(! Validar::entre($_POST['edad'],"10","30")){
				$errores[]="Tu edad solo puede un numero.";
			}

			if($_POST['ponencias1'] == $_POST['ponencias2'] || $_POST['ponencias2'] == $_POST['ponencias3']  || $_POST['ponencias3'] ==$_POST['ponencias4'] || $_POST['ponencias4'] ==$_POST['ponencias1']){
				$errores[]="No puedes elegir la misma ponencia.";
			}

			if(isset ($errores)){
				$serrores;
				foreach ($errores as $key) {
					$serrores.=$key . "<br>";
					# code...
				}
				$this->set("errores",$serrores);
			}else{
				$this->set("resultado","Tus datos, an sdo guardos.");

			}
		    



		}

	}

}

?>


