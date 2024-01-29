<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Consultar por Descripcion</h2>
    <br>
    <nav>
        <ul>
            <li><a href="formGestionarPrincipal.php">Inicio</a></li>
            <li><a href="formVerProductos.php">Ver todos</a></li>
            <li><a href="formInsertarProducto.php">Insetar</a></li>
            <li><a href="formModificarProducto.php">Modificar</a></li>
            <li><a href="formEliminarProducto.php">Eliminar</a></li>
            <li><a href="formConsultarStock.php">Consultar por stock</a></li>
        </ul>
    </nav>
    <br>
    <form action="../Controlador/controlaConsultarDescripcion.php" method="post">

        <label for="descripcion">Descripcion: </label>
        <input type="text" name="descripcion" required>
        <br>
        <br>    
        <input type="submit"value="Consultar">
    </form>
    
</body>
</html>