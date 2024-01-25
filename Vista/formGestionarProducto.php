<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Gestion de Productos</h2>
    <form action="../Controlador/controlaInicioSesion.php" method="post">

        <input type="submit" name="ver_todo" value="Ver Todos">
        <input type="submit" name="consultar_description" value="Consultar por Descripcion">
        <input type="submit" name="modificar" value="Modificar">
        <input type="submit" name="eliminar" value="Eliminar">
        <input type="submit" name="consultar_stock" value="Consultar por stock">
        
        <button type="submit" name="cerrar_sesion">
            <img src="../img/cerrarSesion.png" alt="Cerrar sesión">
        </button>

    
    </form>
    
</body>
</html>