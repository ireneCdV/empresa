<?php
include_once 'Producto.php';
include_once 'Proveedor.php';
include_once 'ProveedorDB.php';

    class ProductoDB{

        public static function add(Producto $producto, Proveedor $miProveedor): bool {
            // Establecemos conexión con la BBDD
            include_once '../Conexion/conexion.php';
            $conexion = Conexion::obtenerConexion();
        
            // Preparar la consulta SQL
            $sql = "INSERT INTO producto (codigoProducto, descripcion, precio, stock, codigoProveedor) VALUES (:codigoProducto, :descripcion, :precio, :stock, :codigoProveedor)";
            $sentencia = $conexion->prepare($sql);
        
            $sentencia->bindValue(":codigoProducto", $producto->getCodigoProducto()); // Corregir el nombre de la columna
            $sentencia->bindValue(":descripcion", $producto->getDescripcion());
            $sentencia->bindValue(":precio", $producto->getPrecio());
            $sentencia->bindValue(":stock", $producto->getStock());
            $sentencia->bindValue(":codigoProveedor", $miProveedor->getCodigoProveedor()); // Usar $miProveedor en lugar de $proveedor
        
            $result = $sentencia->execute();
        
            return $result;
        }

        //Consultar producto por descripcion se le pasa el proveedor
        public static function getByDescripcion($descripcion, Proveedor $proveedor): array {
            // Establecemos conexión con la BBDD
            include_once '../Conexion/conexion.php';
            $conexion = Conexion::obtenerConexion();
        
            // Preparamos la consulta SQL
            $sql = "SELECT * FROM producto WHERE descripcion = :descripcion AND codigoProveedor = :codigoProveedor";
            $sentencia = $conexion->prepare($sql);

            $productos = [];

            $codigoProveedor = $proveedor->getCodigoProveedor();

            // Ejecutar la consulta
            $sentencia->setFetchMode(PDO::FETCH_ASSOC);
            $sentencia->bindParam(":descripcion", $descripcion);
            $sentencia->bindParam(":codigoProveedor", $codigoProveedor); 
            $sentencia->execute();

            while ($productoDB = $sentencia->fetch()){
                $proveedor = ProveedorDB::get($productoDB['codigoProveedor']);
                $producto = new Producto(
                    $productoDB['codigoProducto'],
                    $productoDB['descripcion'],
                    $productoDB['precio'],
                    $productoDB['stock'], 
                    $proveedor);

                $productos[] = $producto;
            }

            return $productos;
        }

        //Eliminar producto
        public static function delete($codigoProducto){
            // Establecemos conexión con la BBDD
            include_once '../Conexion/conexion.php';
            $conexion = Conexion::obtenerConexion();
        
            // Eliminar producto
            $sql = "DELETE FROM producto WHERE codigoProducto = :codigoProducto";
            $sentencia = $conexion->prepare($sql);

            $result = $sentencia->execute([
                "codigoProducto" => $codigoProducto,
            ]);
        
            return $result; // Devuelve true si la operación fue exitosa, false si falló
        }

        //Modificar Producto.
        public static function update(Producto $producto): bool {
            // Establecemos conexión con la BBDD
            include_once '../Conexion/conexion.php';
            $conexion = Conexion::obtenerConexion();
        
            // Modificar producto existente
            $sql = "UPDATE producto SET descripcion = :descripcion, precio = :precio, stock = :stock WHERE codigoProducto = :codigoProducto";
            $sentencia = $conexion->prepare($sql);

            $result = $sentencia->execute([
                "idProducto" => $producto->getIdProducto(),
                "descripcion" => $producto->getDescripcion(),
                "precio" => $producto->getPrecio(),
                "stock" => $producto->getStock(),
            ]);
        
            return $result; // Devuelve true si la operación fue exitosa, false si falló
        }


        //Función para consultar un producto por debajo de un stock.
        public static function obtenerPorDebajoStock($stock,  Proveedor $proveedor ): array {
            // Establecemos conexión con la BBDD
            include_once '../Conexion/conexion.php';
            $conexion = Conexion::obtenerConexion();
        
            // Consulta para obtener productos por debajo del stock mínimo
            $sql = "SELECT * FROM producto WHERE stock < :stockMinimo AND codigoProveedor = :codigoProveedor"; 
            $sentencia = $conexion->prepare($sql);

            $codigoProveedor = $proveedor->getCodigoProveedor();

            // Ejecutar la consulta
            $sentencia->setFetchMode(PDO::FETCH_ASSOC);
            $sentencia->bindParam(":stockMinimo", $stock); // Cambiado a :stockMinimo
            $sentencia->bindParam(":codigoProveedor", $codigoProveedor); 
            $sentencia->execute();

            $productos = [];

            while ($productoDB = $sentencia->fetch()){
                $proveedor = ProveedorDB::get($productoDB['codigoProveedor']);
                $producto = new Producto(
                    $productoDB['codigoProducto'],
                    $productoDB['descripcion'],
                    $productoDB['precio'],
                    $productoDB['stock'], 
                    $proveedor);
                $productos[] = $producto;
            }

            return $productos;
        }

        //Función para devolver productos de un proveedor.
        public static function get(Proveedor $proveedor): array {
            $productos = [];

            //Establecemos conexion
            include_once '../Conexion/conexion.php';
            $conexion = Conexion::obtenerConexion();

            //Preparamos la consulta
            $sql = "SELECT * FROM producto WHERE codigoProveedor = :codigoProveedor";
            $sentencia = $conexion->prepare($sql);
            
            // Ejecutar la consulta
            $sentencia->setFetchMode(PDO::FETCH_ASSOC);
            $sentencia->bindValue(':codigoProveedor', $proveedor->getCodigoProveedor());
            $sentencia->execute();

            while ($productoDB = $sentencia->fetch()){
                $proveedor = ProveedorDB::get($productoDB['codigoProveedor']);
                $producto = new Producto(
                    $productoDB['codigoProducto'],
                    $productoDB['descripcion'],
                    $productoDB['precio'],
                    $productoDB['stock'], 
                    $proveedor);

                $productos[] = $producto;
            }

            return $productos;
        }


        //Funcion para obtener toda la información del producto.
        public static function getAll(Proveedor $proveedor): array {
            //Establecemos conexion
            include_once '../Conexion/conexion.php';
            $conexion = Conexion::obtenerConexion();
        
            //Preparamos la consulta
            $sql = "SELECT * FROM producto WHERE codigoProveedor = :codigoProveedor";
            $sentencia = $conexion->prepare($sql);
            $sentencia->bindValue(":codigoProveedor", $proveedor->getCodigoProveedor()); // Asegúrate de tener un método getCodProv() en la clase Proveedor
        
            $sentencia->execute();
        
            $productos = [];

            while ($resultado = $sentencia->fetch(PDO::FETCH_ASSOC)) {
                $producto = new Producto();
                $producto->setCodigoProducto($resultado['codigoProducto']);
                $producto->setDescripcion($resultado['descripcion']);
                $producto->setPrecio($resultado['precio']);
                $producto->setStock($resultado['stock']);

                $productos[] = $producto;
            }

            return $productos;
        }

        

        
        

    }

?>