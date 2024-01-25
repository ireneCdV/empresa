<?php
    include_once '../Modelo/ProveedorDB.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST["nombre"];
        $apellidos = $_POST["apellidos"];
        $codigo = $_POST["codigo"];
        $pwd = $_POST["pwd"];
        $telefono = $_POST["telefono"];
    
        $resultadoRegistro = ProveedorDB::add($codigo, $nombre, $apellidos, $telefono, $pwd);
    
        if ($resultadoRegistro) {
           
            header("Location: ../Vista/formInicioSesion.php");
        exit();
            
        } else {
            // Error en el registro
            echo "Error al registrar el usuario. Por favor, intenta nuevamente.";
        }
    }

?>