<?php
include_once '../Controlador/controlaProveedor.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Gestion Proveedor</h2>
    

    <form action="../Controlador/controlaProveedor.php" method="post">
        <label for="codigoProveedor">Código de Proveedor:</label>
        <input type="text" id="codigoProveedor" name="codigoProveedor" value="<?php echo $proveedor->getCodigoProveedor(); ?>" readonly>

        <label for="pwd">Contraseña:</label>
        <input type="text" id="pwd" name="pwd" value="<?php echo $proveedor->getPwd(); ?>" required>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $proveedor->getNombre(); ?>" required>

        <label for="apellidos">Apellidos:</label>
        <input type="text" id="apellidos" name="apellidos" value="<?php echo $proveedor->getApellidos(); ?>" required>

        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono" value="<?php echo $proveedor->getTelefono(); ?>" required>

        <input type="submit" name="update" value="Actualizar">
        <br>
        <?php
            // Verificar si hay un mensaje de éxito en la sesión
            if (isset($_SESSION['mensaje_exito'])) {
                echo '<div class="mensaje-exito">' . $_SESSION['mensaje_exito'] . '</div>';

                // Limpiar la variable de sesión después de mostrar el mensaje
                unset($_SESSION['mensaje_exito']);
            }
        ?>
        <br>
        
        <button type="submit" name="cerrar_sesion">
            <img src="../img/cerrarSesion.png" alt="Cerrar sesión">
        </button>
        
    </form>
</body>
</html>