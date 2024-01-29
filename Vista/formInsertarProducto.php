<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Insertar Productos</h2>
    <br>
    <nav>
        <ul>
            <li><a href="formGestionarPrincipal.php">Inicio</a></li>
            <li><a href="formVerProductos.php">Ver todos</a></li>
            <li><a href="formConsultarDescripcion.php">Consultar descripción</a></li>
            <li><a href="formModificarProducto.php">Modificar</a></li>
            <li><a href="formEliminarProducto.php">Eliminar</a></li>
            <li><a href="formConsultarStock.php">Consultar por stock</a></li>
        </ul>
    </nav>
    <br>
    <form action="../Controlador/controlaInsetarProductos.php" method="post">
        <label for="codigo_producto">Codigo Producto: </label>
        <input type="text" name="codigo_producto" required>
        <br>
        <br>    
        <label for="descripcion">Descripcion: </label>
        <input type="text" name="descripcion" required>
        <br>
        <br>
        <label for="precio">Precio: </label>
        <input type="text" name="precio" required>
        <br>
        <br>
        <label for="stock">Stock: </label>
        <input type="number" name="stock" required>
        <br>
        <br>    
        <input type="submit"value="Insertar">

    </form>
    
</body>
</html>