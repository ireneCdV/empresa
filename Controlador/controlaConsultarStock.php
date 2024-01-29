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
    $stock = $_POST["stock"]; 

    // Obtén todos los campeones desde la base de datos
    $productos = ProductoDB::obtenerPorDebajoStock($stock, $proveedor);
    

    if ($productos) {
        echo "<h3>Lista de Productos por debajo de un Stock:</h3>";
        echo "<table border='1'>
                <tr>
                    <th>Codigo</th>
                    <th>Descripcion</th>
                    <th>Precio</th>
                    <th>Stock</th>
                </tr>";
    
        foreach ($productos as $producto) {
            echo "<tr>
                    <td>" . $producto->getCodigoProducto() . "</td>
                    <td>" . $producto->getDescripcion() . "</td>
                    <td>" . $producto->getPrecio() . "</td>
                    <td>" . $producto->getStock() . "</td>
                  </tr>";
        }
    
        echo "</table>";
    } else {
        echo "<p>No se han encontrado productos por debajo del stock mínimo.</p>";
    }
}
?>
