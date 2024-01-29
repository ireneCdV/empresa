<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Eliminar Productos</h2>
    <br>
    <nav>
        <ul>
            <li><a href="formGestionarPrincipal.php">Inicio</a></li>
            <li><a href="formVerProductos.php">Ver todos</a></li>
            <li><a href="formInsertarProducto.php">Insetar</a></li>
            <li><a href="formConsultarDescripcion.php">Consultar descripción</a></li>
            <li><a href="formModificarProducto.php">Modificar</a></li>
            <li><a href="formConsultarStock.php">Consultar por stock</a></li>
        </ul>
    </nav>
    <br>

    <form id="productForm" action="controlaEliminarProducto.php" method="post">
    <label for="codigoProducto">Selecciona un producto:</label>
    <select name="codigoProducto" id="codigoProducto">
        <?php
            // Imprime las opciones del select con la lista de productos
            foreach ($productos as $producto) {
                echo "<option value=\"{$producto['codigo']}\">{$producto['nombre']}</option>";
            }
        ?>
    </select>
    <br>
    <label for="descripcion">Descripción:</label>
    <input type="text" name="descripcion" id="descripcion" value="<?php echo $descripcion; ?>" readonly>
    <br>
    <label for="precio">Precio:</label>
    <input type="text" name="precio" id="precio" value="<?php echo $precio; ?>" readonly>
    <br>
    <label for="stock">Stock:</label>
    <input type="text" name="stock" id="stock" value="<?php echo $stock; ?>" readonly>
    <br>
    <input type="submit" value="Eliminar">
</form>


    
</body>
</html>