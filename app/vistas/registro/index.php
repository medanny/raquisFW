<?php
var_dump($ponencias1);
?>
<?php
if (isset($errores)) {

	echo $errores;
}
?>
<?php
if (isset($resultado)) {

	echo $resultado;
}

?>

<form action="" method="POST">
	Nombre:
	<input type="text" name="nombre" placeholder="Nayma" required /><br>
	Apellido Paterno:
	<input type="text" name="apellidop" placeholder="Cruz" required /><br>
	Apellido Materno:
	<input type="text" name="apellidom" placeholder="Hernandez" required /><br>
	Edad:
	<input type="text" name="edad" placeholder="14"  required /><br>
	Sexo:
	<select name="sexo">
		<option>Sexo</option>
		<option value="1">Hombre</option>
		<option value="2">Mujer</option>
	</select><br>
	Escuela:
	<input type="text" name="escuela" required /><br>
	Codigo:
	<input type="text" name="codigo" required /><br>
	Primer Ponencia:
	<select name="ponencias1">
	      <option>Ponencias</option>
	      <?php

	      	foreach ($ponencias1 as $key) {
	      		echo "<option value='".$key['id']."'>".$key['ponencia']."</option>";

	      	}
	      ?>

	</select><br>
    
    Segunda Ponencia:
	<select name="ponencias2">
	      <option>Ponencias</option>
	      <?php
	      	foreach ($ponencias2 as $key) {
	      		echo "<option value='".$key['id']."'>".$key['ponencia']."</option>";
	      		
	      	}
	      ?>
	</select><br>


    Tercera Ponencia:
	<select name="ponencias3">
	      <option>Ponencias</option>
	</select><br>

	Cuarta Ponencia:
	<select name="ponencias4">
	      <option>Ponencias</option>

	</select><br>


	<input type="submit" value="enviar">

</form>

