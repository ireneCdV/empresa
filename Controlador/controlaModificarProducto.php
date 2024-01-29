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

// Verificar si se ha enviado la solicitud POST para actualizar los datos del producto
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_producto"])) {
    // Obtener los datos actualizados del formulario
    $codigoProducto = $_POST["codigo_producto"];
    $newDescripcion = $_POST["descripcion"];
    $newPrecio = $_POST["precio"];
    $newStock = $_POST["stock"];

    // Obtener el producto actual desde la base de datos
    $productoActual = ProductoDB::get($codigoProducto);

    // Verificar si el producto existe
    if ($productoActual) {
        // Actualizar la información del producto
        $productoActual->setDescripcion($newDescripcion);
        $productoActual->setPrecio($newPrecio);
        $productoActual->setStock($newStock);

        // Guardar los cambios en la base de datos
        ProductoDB::update($productoActual);

        // Establecer una variable de sesión con el mensaje de éxito
        $_SESSION['mensaje_exito'] = "Producto modificado correctamente";

        // Redirigir a la página que muestra el formulario de gestión de productos
        header("Location: ../Vista/formModificarProducto.php");
        exit();
    } else {
        // Producto no encontrado, manejar el error según tu lógica
        $_SESSION['mensaje_error'] = "Error: Producto no encontrado";
        header("Location: ../Vista/formModificarProducto.php");
        exit();
    }
}

?>