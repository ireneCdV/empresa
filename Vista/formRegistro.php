<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Registro de Proveedor</h2>
    <form action="../Controlador/controlaRegistro.php" method="post">
        <label for="codigo">Codigo Proveedor: </label>
        <input type="text" name="codigo" required>
        <br>
        <br>    
        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre" required>
        <br>
        <br>
        <label for="apellidos">Apellidos: </label>
        <input type="text" name="apellidos" required>
        <br>
        <br>
        <label for="telefono">Telefono: </label>
        <input type="number" name="telefono" required>
        <br>
        <br>    
        <label for="">Contraseña: </label>
        <input type="password" name="pwd" required>
        <br>
        <br>
        <input type="submit"value="Registrar">

    </form>
    
</body>
</html>