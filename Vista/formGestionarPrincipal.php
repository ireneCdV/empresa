<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>¿Que desea gestionar?</h2>

    <form action="../Controlador/controlaIndex.php" method="post">
        <input type="submit" name="opciones_proveedor" value="Gestionar Proveedor">
        <input type="submit" name="opciones_productos" value="Gestionar Productos">
        <!-- <input type="submit" name="cerrar_sesion" value="Cerrar sesion"> -->
        <!-- Botón de cerrar sesión con una imagen -->
        <button type="submit" name="cerrar_sesion">
            <img src="../img/cerrarSesion.png" alt="Cerrar sesión">
        </button>

    </form>
    
</body>
</html>