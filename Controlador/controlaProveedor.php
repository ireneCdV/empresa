<?php
include_once '../Modelo/ProveedorDB.php';

// Verificar si el proveedor ha iniciado sesión
session_start();

// Verificar si se ha enviado la solicitud POST para cerrar la sesión
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cerrar_sesion"])) {
    ProveedorDB::cerrarSesion();
}

if (!isset($_SESSION['codigoProveedor'])) {
    // Redirigir a la página de inicio de sesión si no hay sesión activa
    header("Location: ../Vista/formIniciarSesion.php");
    exit();
}

// Obtener el proveedor por su código de la sesión
$codigoProveedor = $_SESSION['codigoProveedor'];
$proveedor = ProveedorDB::get($codigoProveedor);

if (!$proveedor) {
    echo "Proveedor no encontrado.";
    exit();
}

// Verificar si se ha enviado la solicitud POST para actualizar los datos del proveedor
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    // Obtener los datos actualizados del formulario
    $newPwd = $_POST["pwd"];
    $newNombre = $_POST["nombre"];
    $newApellidos = $_POST["apellidos"];
    $newTelefono = $_POST["telefono"];

    // Verificar si la contraseña ha cambiado
    if ($newPwd !== $proveedor->getPwd()) {
        // Actualizar la contraseña solo si ha cambiado
        $proveedor->setPwd(password_hash($newPwd, PASSWORD_BCRYPT));
    }

    // Actualizar el resto de la información del proveedor
    $proveedor->setNombre($newNombre);
    $proveedor->setApellidos($newApellidos);
    $proveedor->setTelefono($newTelefono);

    // Guardar los cambios en la base de datos
    ProveedorDB::update($proveedor);

    // Establecer una variable de sesión con el mensaje de éxito
    $_SESSION['mensaje_exito'] = "Proveedor modificado correctamente";

    // Redirigir a la página que muestra el formulario (usando GET)
    header("Location: ../Vista/formGestionarProveedor.php");
    exit();
}
?>
