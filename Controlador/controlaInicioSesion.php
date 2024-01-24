<?php
include_once '../Modelo/ProveedorDB.php';

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $codigoProveedor = $_POST["codigoProveedor"];
    $pwd = $_POST["pwd"];

    $result = ProveedorDB::InicioSesion($codigoProveedor, $pwd);

    if ($result && password_verify($pwd,$result['pwd'])) {
        echo "USUARIO CORRECTAMENTE LOGUEADO";

        /* // Mostrar un botón para redirigir a otra página
        echo '<form action="../Vista/formIndex.php" method="get">';
        echo '<br>';
        echo '<input type="submit" value="Pulse aquí para ir al juego">';
        echo '</form>'; */

    } else {
        echo "El usuario introducido no existe en la BBDD";
    }

}
?>