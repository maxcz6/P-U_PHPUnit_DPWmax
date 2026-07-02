<?php

namespace App;

/**
 * Clase Habitacion
 * Gestiona la información de las habitaciones del hotel.
 */
class Habitacion
{
    private int    $numero;
    private string $tipo;
    private float  $precio;
    private bool   $disponible;

    /**
     * Constructor de Habitacion.
     *
     * @param int    $numero     Número de habitación (debe ser positivo)
     * @param string $tipo       Tipo de habitación (simple, doble, suite, etc.)
     * @param float  $precio     Precio por noche (debe ser mayor a cero)
     * @param bool   $disponible Indica si la habitación está disponible
     * @throws \InvalidArgumentException Si el número o el precio no son válidos
     *
     * Correcciones aplicadas:
     * - CP-03: Se valida que el número de habitación sea positivo (> 0)
     * - CP-04: Se valida que el precio sea positivo (> 0)
     */
    public function __construct(int $numero, string $tipo, float $precio, bool $disponible = true)
    {
        // CP-03: Validar que el número de habitación sea mayor a cero
        if ($numero <= 0) {
            throw new \InvalidArgumentException('El número de habitación debe ser mayor a cero.');
        }

        // CP-04: Validar que el precio sea mayor a cero
        if ($precio <= 0) {
            throw new \InvalidArgumentException('El precio de la habitación debe ser mayor a cero.');
        }

        $this->numero     = $numero;
        $this->tipo       = $tipo;
        $this->precio     = $precio;
        $this->disponible = $disponible;
    }

    /**
     * Reserva la habitación marcándola como no disponible.
     *
     * @throws \Exception Si la habitación ya no está disponible
     *
     * Correcciones aplicadas:
     * - CP-05: Se verifica si la habitación está disponible antes de reservar
     * - CP-06: Se lanza excepción si la habitación ya está ocupada
     */
    public function reservar(): void
    {
        // CP-05 y CP-06: Verificar disponibilidad y lanzar excepción si ya está reservada
        if (!$this->disponible) {
            throw new \Exception('La habitación ' . $this->numero . ' no está disponible.');
        }

        $this->disponible = false;
    }

    /**
     * Libera la habitación, marcándola como disponible nuevamente.
     */
    public function liberar(): void
    {
        $this->disponible = true;
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

    public function isDisponible(): bool
    {
        return $this->disponible;
    }
}
