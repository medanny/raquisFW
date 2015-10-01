<?php
var_dump($libros);

foreach ($libros as $keys) {
    # code...
    #
    foreach ($keys as $key => $value) {
        # code..
        echo $key . ":" . $value . "<br>";
    }

}
?>