<?php
include_once 'Producto.php';
include_once 'Proveedor.php';
include_once 'ProveedorDB.php';

    class ProductorDB{

        //Añadir producto
        public static function add(Producto $producto, Producto $miProveedor):bool{
            //Establecemos conexion con la BBDD
            include_once '../Conexion/conexion.php';
            $conexion = Conexion::obtenerConexion();

            //Preparar la consultaSQL
            $sql = "INSERT INTO productos (codigoPoducto,descripcion,precio,stock) VALUES (:codigoPoducto, :descripcion, :precio, :stock)";
            $sentencia = $conexion ->prepare($sql);

            $sentencia ->bindValue(":codigoPoducto",$producto->getCodigoProducto());
            $sentencia ->bindValue(":descripcion",$producto->getDescripcion());
            $sentencia ->bindValue(":precio",$producto->getPrecio());
            $sentencia ->bindValue(":stock",$producto->getStock());
            $sentencia ->bindValue(":codigoProveedor",$proveedor->getCodigoProveedor());

            $result = $sentencia->execute();

            return $result;

        
        }

        //Consultar producto por descripcion se le pasa el proveedor
        public static function getByDescripcion($descripcion, Proveedor $proveedor): array {
            // Establecemos conexión con la BBDD
            include_once '../Conexion/conexion.php';
            $conexion = Conexion::obtenerConexion();
        
            // Preparamos la consulta SQL
            $sql = "SELECT * FROM productos WHERE descripcion = :descripcion AND codigoProveedor = :codigoProveedor";
            $sentencia = $conexion->prepare($sql);

            $productos = [];

            $codigoProveedor = $proveedor->getCodigoProveedor();

            // Ejecutar la consulta
            $sentencia->setFetchMode(PDO::FETCH_ASSOC);
            $sentencia->bindParam(":descripcion", $descripcion);
            $sentencia->bindParam(":codigoProveedor", $codigoProveedor); 
            $sentencia->execute();

            while ($productoDB = $sentencia->fetch()){
                $proveedor = ProveedorDB::getProveedor($productoDB['codigoProveedor']);
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
        public static function delete($idProducto){
            // Establecemos conexión con la BBDD
            include_once '../Conexion/conexion.php';
            $conexion = Conexion::obtenerConexion();
        
            // Eliminar producto
            $sql = "DELETE FROM productos WHERE idProducto = :idProducto";
            $sentencia = $conexion->prepare($sql);

            $result = $sentencia->execute([
                "idProducto" => $idProducto,
            ]);
        
            return $result; // Devuelve true si la operación fue exitosa, false si falló
        }

        //Modificar Producto.
        public static function update(Producto $producto): bool {
            // Establecemos conexión con la BBDD
            include_once '../Conexion/conexion.php';
            $conexion = Conexion::obtenerConexion();
        
            // Modificar producto existente
            $sql = "UPDATE productos SET descripcion = :descripcion, precio = :precio, stock = :stock WHERE idProducto = :idProducto";
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
            $sql = "SELECT * FROM productos WHERE stock < :stockMinimo";
            $sentencia = $conexion->prepare($sql);
            
            $codigoProveedor = $proveedor->getCodigoProveedor();

            // Ejecutar la consulta
            $sentencia->setFetchMode(PDO::FETCH_ASSOC);
            $sentencia->bindParam(":stock", $stock);
            $sentencia->bindParam(":codigoProveedor", $codigoProveedor); 
            $sentencia->execute();

            $productos = [];

            while ($productoDB = $sentencia->fetch()){
                $proveedor = ProveedorDB::getProveedor($productoDB['codigoProveedor']);
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
        public static function get($codigoProducto): Producto {
            //Establecemos conexion
            include_once '../Conexion/conexion.php';
            $conexion = Conexion::obtenerConexion();

            //Preparamos la consulta
            $sql = "SELECT * FROM producto WHERE codigoProducto = :codigoProducto";
            $sentencia = $conexion->prepare($sql);
            
            // Ejecutar la consulta
            $sentencia->setFetchMode(PDO::FETCH_ASSOC);
            $sentencia->bindValue(':codigoProveedor', $proveedor->getCodigoProveedor());
            $sentencia->execute();

            while ($productoDB = $sentencia->fetch()){
                $proveedor = ProveedorDB::getProveedor($productoDB['codigoProveedor']);
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
            $sql = "SELECT * FROM productos WHERE codigoProveedor = :codigoProveedor";
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