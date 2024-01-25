<?php
session_start();
include_once '../Modelo/ProveedorDB.php';

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $codigoProveedor = $_POST["codigoProveedor"];
    $pwd = $_POST["pwd"];

    $result = ProveedorDB::InicioSesion($codigoProveedor, $pwd);

    if ($result && password_verify($pwd,$result['pwd'])) {

        //Mantener sesion iniciada 
        $_SESSION['codigoProveedor'] = $result['codigoProveedor'];

        header("Location: ../Vista/formGestionarPrincipal.php");
        exit();
       

    } else {
        echo "El usuario introducido no existe en la BBDD";
    }

}
?>