<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['registrar'])) {
        header("Location: ../Vista/formRegistro.php");
        exit();
    } elseif (isset($_POST['iniciar_sesion'])) {
        header("Location: ../Vista/formInicioSesion.php");
        exit();
    } 
}
?>
