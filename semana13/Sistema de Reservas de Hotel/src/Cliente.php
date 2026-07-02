<?php

namespace App;

/**
 * Clase Cliente
 * Almacena información básica del cliente del hotel.
 */
class Cliente
{
    private string $nombre;
    private string $email;
    private string $telefono;

    /**
     * Constructor de Cliente.
     *
     * @param string $nombre   Nombre completo del cliente (no puede estar vacío)
     * @param string $email    Email del cliente (debe tener formato válido)
     * @param string $telefono Teléfono del cliente
     * @throws \InvalidArgumentException Si el nombre está vacío o el email es inválido
     *
     * Correcciones aplicadas:
     * - CP-01: Se valida que el nombre no esté vacío
     * - CP-02: Se valida el formato del email con filter_var()
     */
    public function __construct(string $nombre, string $email, string $telefono)
    {
        // CP-01: Validar que el nombre no esté vacío
        if (trim($nombre) === '') {
            throw new \InvalidArgumentException('El nombre del cliente no puede estar vacío.');
        }

        // CP-02: Validar el formato del email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('El email "' . $email . '" no tiene un formato válido.');
        }

        $this->nombre   = trim($nombre);
        $this->email    = $email;
        $this->telefono = $telefono;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getTelefono(): string
    {
        return $this->telefono;
    }
}
