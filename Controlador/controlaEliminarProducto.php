<?php
session_start();
include_once "../Modelo/ProveedorDB.php";
include_once "../Modelo/ProductoDB.php";

// Obtener el código del proveedor desde la variable de sesión
$codigoProveedor = isset($_SESSION['codigoProveedor']) ? $_SESSION['codigoProveedor'] : null;

// Verificar si el usuario ha iniciado sesión
if (!$codigoProveedor) {
    // Redirigir a la página de inicio de sesión si no hay sesión iniciada
    header("Location: ../Vista/formIniciarSesion.php");
    exit();
}

// Obtener el proveedor por su código
$proveedor = ProveedorDB::get($codigoProveedor);

if (!$proveedor) {
    echo "Proveedor no encontrado.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtén el código del producto seleccionado
    $codigoProducto = isset($_POST['codigoProducto']) ? $_POST['codigoProducto'] : null;

    // Obtén la información del producto desde la base de datos
    $producto = ProductoDB::get($codigoProducto);

    // Rellena los campos del formulario con la información del producto
    if ($producto) {
        $descripcion = $producto['descripcion'];
        $precio = $producto['precio'];
        $stock = $producto['stock'];
    } else {
        // Manejar el caso en que el producto no se encuentra
        $descripcion = $precio = $stock = "";
    }
}
?>
