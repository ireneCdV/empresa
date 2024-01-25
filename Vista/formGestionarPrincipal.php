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

    <form action="../Controlador/controlaPrincipal.php" method="post">
        <input type="submit" name="opciones_proveedor" value="Gestionar Proveedor">
        <input type="submit" name="opciones_productos" value="Gestionar Productos">
    </form>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <button type="submit" name="cerrar_sesion">
            <img src="../img/cerrarSesion.png" alt="Cerrar sesión">
        </button>

    </form>
    
</body>
</html>