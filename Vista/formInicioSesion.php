<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Inicio de Sesion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Inicio de Sesion</h2>
    <form action="../Controlador/controlaInicioSesion.php" method="post">
        <label for="codigoProveedor">Codigo Proveedor: </label>
        <input type="text" name="codigoProveedor" required>
        <br>
        <br>
        <label for="password">Contraseña: </label>
        <input type="password" name="pwd" required>
        <br>
        <br>
        <input type="submit"value="Iniciar Sesion">

    </form>
    
</body>
</html>