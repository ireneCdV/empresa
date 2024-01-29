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

    <form action="../Controlador/controlaVerProv.php" method="post">

        <label for="codigoProveedor">Codigo Proveedor: </label>
        <input type="text" name="codigoProveedor" required>
        <br>
        <input type="submit" value="Mostrar Datos">
        <button type="submit" name="cerrar_sesion">
            <img src="../img/cerrarSesion.png" alt="Cerrar sesión">
        </button>
    </form>
    
</body>
</html>