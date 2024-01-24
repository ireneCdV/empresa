<?php
    include_once '../Modelo/ProveedorDB.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST["nombre"];
        $apellidos = $_POST["apellidos"];
        $usuario = $_POST["codigo"];
        $pwd = $_POST["pwd"];
        $telefono = $_POST["telefono"];
    
        $resultadoRegistro = ProveedorDB::add($usuario, $nombre, $apellidos, $telefono, $pwd);
    
        if ($resultadoRegistro) {
            // Mostrar el mensaje 
            echo "El usuario $usuario ha sido introducido en el sistema con la contraseña $pwd";

            /* // Mostrar un botón para redirigir a otra página
            echo '<form action="../Vista/formIniciarSesion.php" method="get">';
            echo '<br>';
            echo '<input type="submit" value="Pulse aquí para ir a inicio sesión">';
            echo '</form>'; */
            
        } else {
            // Error en el registro
            echo "Error al registrar el usuario. Por favor, intenta nuevamente.";
        }
    }

?>