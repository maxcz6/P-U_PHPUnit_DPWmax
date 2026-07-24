<?php

namespace App;

class Habitacion
{
    private int $numero;
    private string $tipo;
    private float $precio;
    private bool $disponible;
    
    public function __construct(int $numero, string $tipo, float $precio)
    {
        if ($numero <= 0) {
            throw new \InvalidArgumentException("El número debe ser positivo");
        }

        if ($precio <= 0) {
            throw new \InvalidArgumentException("El precio debe ser positivo");
        }
    
        $this->numero = $numero;
        $this->tipo = $tipo;
        $this->precio = $precio;
        $this->disponible = true;
    }
    
    public function reservar(): void
    {
        if (!$this->disponible) {
            throw new \Exception("La habitación no está disponible");
        }
    
        $this->disponible = false;
    }
    
    public function isDisponible(): bool
    {
        return $this->disponible;
    }
    
    public function getNumero(): int
    {
        return $this->numero;
    }

    public function getTipo(): string
    {
        return $this->tipo;
    }

    public function getPrecio(): float
    {
        return $this->precio;
    }
}