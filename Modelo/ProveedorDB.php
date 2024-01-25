<?php
include_once 'Producto.php';
include_once 'Proveedor.php';
include_once 'ProveedorDB.php';

    class ProveedorDB{
        public static function InicioSesion($codigoProveedor){
            // Establecemos conexión con la BBDD
            include_once '../Conexion/conexion.php';
            $conexion = Conexion::obtenerConexion();
        
            $sql = "SELECT * FROM proveedor WHERE codigoProveedor = ?";
            $sentencia = $conexion->prepare($sql);
            $sentencia->execute([$codigoProveedor]);
        
            $ProveedorDB = $sentencia->fetch(); // Fila de la base de datos leída.
            
            return $ProveedorDB; // Devuelve la fila del usuario o false si no se encontró
        }

        //Funcion para comprabar que inicia sesion
        public static function get(string $codigoProveedor) :Proveedor {
            // Establecemos conexión con la BBDD
            include_once '../Conexion/conexion.php';
            $conexion = Conexion::obtenerConexion();
        
            $sql = "SELECT * FROM proveedor WHERE codigoProveedor = :codigoProveedor";
            $sentencia = $conexion->prepare($sql);
            $sentencia->execute(['codigoProveedor' => $codigoProveedor]);

            $proveedor = $sentencia->fetch(PDO::FETCH_ASSOC);

            // Montar el proveedor
            $proveedorDevolver = new Proveedor(
                $proveedor['codigoProveedor'], 
                $proveedor['nombre'], 
                $proveedor['apellidos'], 
                $proveedor['telefono'],
                $proveedor['pwd']);

            return $proveedorDevolver;
        }
        
        //Funcion para registar un nuevo proveedor
        public static function add($codigoProveedor, $nombre, $apellidos, $telefono, $pwd){
              if (self::InicioSesion($codigoProveedor)) {
                // El codigo de proveedor ya está en uso
                return false;
            }  

            // Establecemos conexión con la BBDD
            include_once '../Conexion/conexion.php';
            $conexion = Conexion::obtenerConexion();

            // Insertar nuevo proveedor si no existe
            $sql = "INSERT INTO proveedor(codigoProveedor,nombre, apellidos, telefono, pwd) VALUES(:codigoProveedor, :nombre, :apellidos,:telefono, :pwd)";
            $sentencia = $conexion->prepare($sql);
            $result = $sentencia->execute([
                "codigoProveedor" => $codigoProveedor,
                "nombre" => $nombre,
                "apellidos" => $apellidos,
                "telefono" => $telefono,
                "pwd" => password_hash($pwd, PASSWORD_DEFAULT),
            ]);

            return $result; // Devuelve true si la operación fue exitosa, false si falló
        }

        //Funcion para modificar un proveedor existente
        public static function update(Proveedor $proveedor){
                   
            // Establecemos conexión con la BBDD
            include_once '../Conexion/conexion.php';
            $conexion = Conexion::obtenerConexion();
        
            // Modificar proveedor existente
            $sql = "UPDATE proveedor SET pwd = :pwd, nombre = :nombre, apellidos = :apellidos, telefono = :telefono WHERE codigoProveedor = :codigoProveedor";            
            $sentencia = $conexion->prepare($sql);

            $sentencia->bindValue(":pwd", $proveedor->getPwd());
            $sentencia->bindValue(":nombre", $proveedor->getNombre());
            $sentencia->bindValue(":apellidos", $proveedor->getApellidos());
            $sentencia->bindValue(":telefono", $proveedor->getTelefono());
            $sentencia->bindValue(":codigoProveedor", $proveedor->getCodigoProveedor());

            $result = $sentencia->execute();

            return $result; // Devuelve true si la operación fue exitosa, false si falló
        }


        //Funcion para eliminar un proveedor
        public static function delete($codigoProveedor){
            // Verificar si el proveedor existe
            if (!self::get($codigoProveedor)) {
                // El proveedor no existe, no se puede eliminar
                return false;
            }
        
            // Establecemos conexión con la BBDD
            include_once '../Conexion/conexion.php';
            $conexion = Conexion::obtenerConexion();
        
            // Eliminar proveedor existente
            $sql = "DELETE FROM proveedor WHERE codigoProveedor = :codigoProveedor";
            $sentencia = $conexion->prepare($sql);
            $result = $sentencia->execute([
                "codigoProveedor" => $codigoProveedor,
            ]);
        
            return $result; // Devuelve true si la operación fue exitosa, false si falló
        }


        //Funcion para ver todos los datos de un proveedor
        public static function obtenerDatosProveedor($codigoProveedor){
            // Establecemos conexión con la BBDD
            include_once '../Conexion/conexion.php';
            $conexion = Conexion::obtenerConexion();
        
            // Obtener datos del proveedor
            $sql = "SELECT * FROM proveedor WHERE codigoProveedor = :codigoProveedor";
            $sentencia = $conexion->prepare($sql);
            $sentencia->execute([
                "codigoProveedor" => $codigoProveedor,
            ]);
        
            // Obtener el resultado como un array asociativo
            $datosProveedor = $sentencia->fetch(PDO::FETCH_ASSOC);
        
            return $datosProveedor; // Devuelve un array con los datos del proveedor o false si no se encontró el proveedor
        }


        //Funcion para obtener un proveedor con el array lleno de productos.
        public static function getAll(string $codigoProveedor): Proveedor {
            $productos = [];

            $proveedor = self::get($codigoProveedor);
            $productos = ProductoDB::get($proveedor);
            $proveedor->setProductos($productos);

            return $proveedor;
        }


        public static function cerrarSesion() {
            // Destruye todas las variables de sesión
            $_SESSION = array();
        
            // Si se desea destruir la sesión completamente, borra también la cookie de la sesión.
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );
            }
        
            // Finalmente, destruye la sesión
            session_destroy();
        
            // Redirige al usuario a index.php
            header("Location: ../Vista/formindex.php");
            exit(); // Asegura que el script se detenga después de la redirección
        }
        
        

    }

?>