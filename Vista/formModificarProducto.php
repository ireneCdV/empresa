<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Modificar Productos</h2>
    <br>
    <nav>
        <ul>
            <li><a href="formGestionarPrincipal.php">Inicio</a></li>
            <li><a href="formVerProductos.php">Ver todos</a></li>
            <li><a href="formInsertarProducto.php">Insetar</a></li>
            <li><a href="formConsultarDescripcion.php">Consultar descripción</a></li>
            <li><a href="formEliminarProducto.php">Eliminar</a></li>
            <li><a href="formConsultarStock.php">Consultar por stock</a></li>
        </ul>
    </nav>
    <br>

<form id="productForm" action="controlaModificarProducto.php" method="post">
        <label for="codigo_producto">Selecciona un producto:</label>
        <select name="codigo_producto" id="codigo_producto" >
            <?php
            
            foreach ($productosProveedor as $producto) {
                echo "<option value='{$producto['codigoProducto']}'>{$producto['codigoProducto']}</option>";
            }
            ?>
        </select>
        <br>
        <label for="descripcion">Descripción:</label>
        <input type="text" name="descripcion" id="descripcion" readonly>
        <br>
        <label for="precio">Precio:</label>
        <input type="text" name="precio" id="precio" readonly>
        <br>
        <label for="stock">Stock:</label>
        <input type="text" name="stock" id="stock" readonly>
        <br>
        <input id="update_producto" type="submit" value="Guardar cambios">
    </form>
    
</body>
</html>