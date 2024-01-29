<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Mostrar Datos</h2>
    
    <br>
    <nav>
        <ul>
            <li><a href="formGestionarPrincipal.php">Inicio</a></li>
            <li><a href="formInsertarProducto.php">Insetar</a></li>
            <li><a href="formConsultarDescripcion.php">Consultar descripción</a></li>
            <li><a href="formModificarProducto.php">Modificar</a></li>
            <li><a href="formEliminarProducto.php">Eliminar</a></li>
            <li><a href="formConsultarStock.php">Consultar por stock</a></li>
        </ul>
    </nav>
    <br>

    <form action="../Controlador/controlaVerProductos.php" method="post">
        <input type="submit" value="Mostrar Datos">
    </form>
    
</body>
</html>