<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['ver_todo'])) {
        header("Location: ../Vista/formVerProductos.php");
        exit();
    } elseif (isset($_POST['insertar'])) {
        header("Location: ../Vista/formInsertarProducto.php");
        exit();
    }  elseif (isset($_POST['consultar_description'])) {
        header("Location: ../Vista/formConsultarDescripcion.php");
        exit();
    } elseif (isset($_POST['modificar'])) {
        header("Location: ../Vista/formModificarProducto.php");
        exit();
    } elseif (isset($_POST['eliminar'])) {
        header("Location: ../Vista/formEliminarProducto.php");
        exit();
    } elseif (isset($_POST['consultar_stock'])) {
        header("Location: ../Vista/formConsultarStock.php");
        exit();
    } elseif (isset($_POST['cerrar_sesion'])) {
        header("Location: ../Vista/formInicioSesion.php");
        exit();
    }
}
?>
