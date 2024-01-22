<?php
include_once 'Proveedor.php';
    class Producto{
        private string $codigoProducto;
        private string $descripcion;
        private float $precio;
        private int $stock;
        private Proveedor $proveedor;

        // Constructor
        public function __construct(string $codigoProducto, string $descripcion, float $precio, int $stock, Proveedor $proveedor) {
                $this->codigoProducto = $codigoProducto;
                $this->descripcion = $descripcion;
                $this->precio = $precio;
                $this->stock = $stock;
                $this->proveedor = $proveedor;
            }


            // Propiedades 

            public function getCodigoProducto(): string {
                return $this->codigoProducto;
            }
            public function setCodigoProducto(string $codigoProducto): void {
                $this->codigoProducto = $codigoProducto;
            }
    
            
            public function getDescripcion(): string {
                return $this->descripcion;
            }
            public function setDescripcion(string $descripcion): void {
                $this->descripcion = $descripcion;
            }
    
            public function getPrecio(): float {
                return $this->precio;
            }
            public function setPrecio(float $precio): void {
                $this->precio = $precio;
            }
    
            public function getStock(): int {
                return $this->stock;
            }
            public function setStock(int $stock): void {
                $this->stock = $stock;
            }
    
            public function getProveedor(): Proveedor {
                return $this->proveedor;
            }
            public function setProveedor(Proveedor $proveedor): void {
                $this->proveedor = $proveedor;
            }
    }


?>