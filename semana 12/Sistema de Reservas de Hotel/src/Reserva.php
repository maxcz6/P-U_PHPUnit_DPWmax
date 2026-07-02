<?php

namespace App;

/**
 * Clase Reserva
 * Vincula un cliente con una habitación en un período de tiempo determinado.
 */
class Reserva
{
    private Cliente    $cliente;
    private Habitacion $habitacion;
    private \DateTime  $fechaIngreso;
    private \DateTime  $fechaSalida;

    /**
     * Constructor de Reserva.
     *
     * @param Cliente    $cliente      El cliente que realiza la reserva
     * @param Habitacion $habitacion   La habitación reservada
     * @param string     $fechaIngreso Fecha de ingreso en formato YYYY-MM-DD
     * @param string     $fechaSalida  Fecha de salida en formato YYYY-MM-DD
     * @throws \InvalidArgumentException Si las fechas son inválidas o inconsistentes
     *
     * Correcciones aplicadas:
     * - CP-07: Se valida el formato de la fecha de ingreso (YYYY-MM-DD)
     * - CP-08: Se valida que la fecha de ingreso no sea en el pasado
     * - CP-09: Se valida que la fecha de salida sea posterior al ingreso
     */
    public function __construct(
        Cliente    $cliente,
        Habitacion $habitacion,
        string     $fechaIngreso,
        string     $fechaSalida
    ) {
        // CP-07: Validar el formato de la fecha de ingreso (YYYY-MM-DD)
        $ingreso = \DateTime::createFromFormat('Y-m-d', $fechaIngreso);
        if (!$ingreso || $ingreso->format('Y-m-d') !== $fechaIngreso) {
            throw new \InvalidArgumentException(
                'La fecha de ingreso "' . $fechaIngreso . '" no tiene el formato válido YYYY-MM-DD.'
            );
        }

        // CP-07: Validar el formato de la fecha de salida (YYYY-MM-DD)
        $salida = \DateTime::createFromFormat('Y-m-d', $fechaSalida);
        if (!$salida || $salida->format('Y-m-d') !== $fechaSalida) {
            throw new \InvalidArgumentException(
                'La fecha de salida "' . $fechaSalida . '" no tiene el formato válido YYYY-MM-DD.'
            );
        }

        // CP-08: Validar que la fecha de ingreso no sea en el pasado
        $hoy = new \DateTime('today');
        if ($ingreso < $hoy) {
            throw new \InvalidArgumentException(
                'La fecha de ingreso no puede ser en el pasado. Fecha recibida: ' . $fechaIngreso
            );
        }

        // CP-09: Validar que la fecha de salida sea posterior a la de ingreso
        if ($salida <= $ingreso) {
            throw new \InvalidArgumentException(
                'La fecha de salida debe ser posterior a la fecha de ingreso.'
            );
        }

        $this->cliente      = $cliente;
        $this->habitacion   = $habitacion;
        $this->fechaIngreso = $ingreso;
        $this->fechaSalida  = $salida;
    }

    /**
     * Calcula el costo total de la reserva según los días de estadía y el precio por noche.
     *
     * Corrección aplicada:
     * - CP-10: El cálculo usa diff()->days para obtener los días reales de estadía
     *          (antes el código usaba $dias = 1 fijo, lo cual era incorrecto)
     *
     * @return float Total a pagar
     */
    public function calcularTotal(): float
    {
        // CP-10: Calcular los días reales de estadía
        $dias = $this->fechaIngreso->diff($this->fechaSalida)->days;
        return $dias * $this->habitacion->getPrecio();
    }

    public function getCliente(): Cliente
    {
        return $this->cliente;
    }

    public function getHabitacion(): Habitacion
    {
        return $this->habitacion;
    }

    public function getFechaIngreso(): \DateTime
    {
        return $this->fechaIngreso;
    }

    public function getFechaSalida(): \DateTime
    {
        return $this->fechaSalida;
    }

    /**
     * Retorna un resumen legible de la reserva.
     */
    public function getResumen(): string
    {
        $dias  = $this->fechaIngreso->diff($this->fechaSalida)->days;
        $total = $this->calcularTotal();

        return sprintf(
            "Reserva: %s | Habitación %d (%s) | %s → %s | %d noche(s) | Total: S/. %.2f",
            $this->cliente->getNombre(),
            $this->habitacion->getNumero(),
            $this->habitacion->getTipo(),
            $this->fechaIngreso->format('Y-m-d'),
            $this->fechaSalida->format('Y-m-d'),
            $dias,
            $total
        );
    }
}
