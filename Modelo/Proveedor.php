<?php
    class Proveedor{
        private string $codigoProveedor;
        private string $nombre;
        private string $apellidos;
        private int $telefono;
        private string $pwd;
        private array $misProductos;

        // Constructor
        public function __construct(string $codigoProveedor, string $pwd, string $nombre, string $apellidos, string $telefono) {
                $this->codigoProveedor = $codigoProveedor;
                $this->pwd = $pwd;
                $this->nombre = $nombre;
                $this->apellidos = $apellidos;
                $this->telefono = $telefono;
                $this->misProductos = [];
        }
        
        
        // Propiedades

            public function getCodigoProveedor(): string {
                return $this->codigoProveedor;
            }
            public function setCodigoProveedor(string $codigoProveedor): void {
                $this->codigoProveedor = $codigoProveedor;
            }
    
            public function getPwd(): string {
                return $this->pwd;
            }
            public function setPwd(string $pwd): void {
                $this->pwd = $pwd;
            }
    
            public function getNombre(): string {
                return $this->nombre;
            }
            public function setNombre(string $nombre): void {
                $this->nombre = $nombre;
            }
    
            public function getApellidos(): string {
                return $this->apellidos;
            }
            public function setApellidos(string $apellidos): void {
                $this->apellidos = $apellidos;
            }
    
            public function getTelefono(): string {
                return $this->telefono;
            }
            public function setTelefono(string $telefono): void {
                $this->telefono = $telefono;
            }
    
            public function getMisProductos(): array {
                    return $this->misProductos;
            }
            public function setMisProductos(array $misProductos): void {
                $this->misProductos = $misProductos;
            }
    }


?>