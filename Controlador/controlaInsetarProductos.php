<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['codigoProveedor'])) {
    echo "Acceso no autorizado. Debes iniciar sesión primero.";
    exit();
}

// Continuar con el resto del código para insertar productos
include_once "../Modelo/ProductoDB.php";
include_once "../Modelo/Producto.php";
include_once "../Modelo/ProveedorDB.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $codigo_producto = $_POST["codigo_producto"];
    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];
    $stock = $_POST["stock"];

    // Obtener el proveedor usando el código del producto
    $proveedor = ProveedorDB::get($_SESSION['codigoProveedor']);

    // Verificar si se obtuvo un proveedor
    if ($proveedor) {
        // Crear una instancia de Producto con los datos del formulario y el objeto Proveedor
        $newProducto = new Producto($codigo_producto, $descripcion, $precio, $stock, $proveedor);

        // Intentar agregar el producto
        if (ProductoDB::add($newProducto, $proveedor)) {
            $mensaje = "Producto insertado correctamente";
        } else {
            $mensaje = "No se ha podido insertar el producto";
        }
    } else {
        $mensaje = "No se encontró un proveedor para el código de producto proporcionado.";
    }

    // Imprimir el mensaje después de toda la lógica de procesamiento
    echo "<br>" . $mensaje;
}
?>
