<?php
session_start();
include_once "../Modelo/ProveedorDB.php";
include_once "../Modelo/ProductoDB.php";

// Obtener el código del proveedor desde la variable de sesión
$codigoProveedor = isset($_SESSION['codigoProveedor']) ? $_SESSION['codigoProveedor'] : null;

// Verificar si el usuario ha iniciado sesión
if (!$codigoProveedor) {
    // Redirigir a la página de inicio de sesión si no hay sesión iniciada
    header("Location: ../Vista/formInicioSesion.php");
    exit();
}

// Obtener el proveedor por su código
$proveedor = ProveedorDB::get($codigoProveedor);

if (!$proveedor) {
    echo "Proveedor no encontrado.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigoProducto = isset($_POST["codigoProducto"]) ? $_POST["codigoProducto"] : null;

    // Obtener el objeto Producto desde la base de datos
    $productos = ProductoDB::get($proveedor);

    // Imprimir los datos en forma de tabla
    echo "<h2>Datos del Producto</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Código</th><th>Nombre</th><th>Precio</th><th>Stock</th></tr>";

    foreach ($productos as $producto) {
        echo "<tr>";
        echo "<td>" . $producto->getCodigoProducto() . "</td>";
        echo "<td>" . $producto->getDescripcion() . "</td>";
        echo "<td>" . $producto->getPrecio() . "</td>";
        echo "<td>" . $producto->getStock() . "</td>";
        echo "</tr>";
    }

    echo "</table>";
}
?>
