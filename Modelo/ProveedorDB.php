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
        public static function update($codigoProveedor, $nombre, $apellidos, $telefono, $pwd){
            // Verificar si el proveedor existe
            if (!self::get($codigoProveedor)) {
                // El proveedor no existe, no se puede modificar
                return false;
            }
        
            // Establecemos conexión con la BBDD
            include_once '../Conexion/conexion.php';
            $conexion = Conexion::obtenerConexion();
        
            // Modificar proveedor existente
            $sql = "UPDATE proveedor SET nombre = :nombre, apellidos = :apellidos, telefono = :telefono WHERE codigoProveedor = :codigoProveedor";
            $sentencia = $conexion->prepare($sql);
            $result = $sentencia->execute([
                "nombre" => $nombre,
                "apellidos" => $apellidos,
                "telefono" => $telefono,
            ]);
        
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
        
        

    }

?>