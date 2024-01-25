<?php
include_once '../Modelo/ProveedorDB.php';

// Inicia la sesión
session_start();

// Verificar si se ha enviado la solicitud POST para cerrar la sesión
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cerrar_sesion"])) {
    ProveedorDB::cerrarSesion();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['opciones_proveedor'])) {
        header("Location: ../Vista/formGestionarProveedor.php");
        exit();
    } elseif (isset($_POST['opciones_productos'])) {
        header("Location: ../Vista/formGestionarProducto.php");
        exit();
    } 
}
?>
