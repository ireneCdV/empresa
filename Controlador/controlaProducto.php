<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['ver_datos'])) {
        header("Location: ../Vista/formVerProveedor.php");
        exit();
    } elseif (isset($_POST['iniciar_sesion'])) {
        header("Location: ../Vista/formInicioSesion.php");
        exit();
    } 
}
?>
