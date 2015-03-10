<?php
if (isset($errores)) {

	echo $errores;
}
?>
<form method="POST" action=""> 
<input type="text" name="nombre" placeholder="nombre"><br>
<input type="text" name="correo" placeholder="correo"><br>
<input type="text" name="escuela" placeholder="escuela"><br>
<input type="submit" value="registrar">
</form>
<table>
<tr>
<th>Nombre</th>
<th>Correo</th>
<th>Escuela</th>	
</tr>
<?php
foreach($registros as $registro){
?>
	<tr>
		<td><?=$registro['nombre']?></td>
		<td><?=$registro['correo']?></td>
		<td><?=$registro['escuela']?></td>
	</tr>
<?php
}


?>