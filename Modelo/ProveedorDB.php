<?php
include_once 'Producto.php';
include_once 'Proveedor.php';
include_once 'ProveedorDB.php';

    class ProveedorDB{
        //Funcion para comprabar que inicia sesion
        public static function get($codigoProveedor, Producto $producto) {
            // Establecemos conexión con la BBDD
            include_once '../Conexion/conexion.php';
            $conexion = Conexion::obtenerConexion();
        
            $sql = "SELECT * FROM proveedor WHERE codigoProveedor = :codigoProveedor";
            $sentencia = $conexion->prepare($sql);
            $sentencia->execute([$codigoProveedor]);
        
            $proveedorBD = $sentencia->fetch(PDO::FETCH_ASSOC); // Obtener la fila como un array asociativo
    
            if (!$proveedorBD) {
                return false; // Devuelve false si no se encontró el proveedor
            }
    
            // Construir el objeto Proveedor a partir del array obtenido de la base de datos
            $proveedor = new Proveedor();
            $proveedor->setCodigoProveedor($proveedorBD['codigoProveedor'])
                      ->setDescripcion($proveedorBD['descripcion'])
                      ->setPrecio($proveedorBD['precio'])
                      ->setStock($proveedorBD['stock'])
                      ->setMisProductos(json_decode($proveedorBD['misProductos'], true));
    
            return $proveedor;
        }
        
        //Funcion para registar un nuevo proveedor
        public static function add($codigoProveedor, $nombre, $apellidos, $telefono, $pwd){
            if (self::get($codigoProveedor)) {
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