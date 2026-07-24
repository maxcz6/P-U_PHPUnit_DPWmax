<?php

namespace App;

class BaseDatos
{
    private $conexion;
    
    public function __construct()
    {
        $this->conexion = new \PDO('sqlite::memory:');
        $this->conexion->exec("CREATE TABLE usuarios (id INTEGER PRIMARY KEY, nombre TEXT, email TEXT)");
    }
    
    public function guardarUsuario(string $nombre, string $email): bool
    {
        // Validación: email no puede estar vacío
        if (empty($email)) {
            return false;
        }
        
        // Validación: nombre no puede estar vacío
        if (empty($nombre)) {
            return false;
        }
        
        $stmt = $this->conexion->prepare("INSERT INTO usuarios (nombre, email) VALUES (?, ?)");
        return $stmt->execute([$nombre, $email]);
    }
    
    public function contarUsuarios(): int
    {
        $stmt = $this->conexion->query("SELECT COUNT(*) FROM usuarios");
        return (int) $stmt->fetchColumn();
    }
    
    public function limpiar(): void
    {
        $this->conexion->exec("DELETE FROM usuarios");
    }
}