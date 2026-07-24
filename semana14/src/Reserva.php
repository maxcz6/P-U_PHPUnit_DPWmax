<?php

namespace App;

class Reserva
{
    private Cliente $cliente;
    private Habitacion $habitacion;
    private string $fechaIngreso;
    private string $fechaSalida;
    
    public function __construct(Cliente $cliente, Habitacion $habitacion, string $fechaIngreso, string $fechaSalida)
    {
        $this->validarFechas($fechaIngreso, $fechaSalida);
        $this->cliente = $cliente;
        $this->habitacion = $habitacion;
        $this->fechaIngreso = $fechaIngreso;
        $this->fechaSalida = $fechaSalida;
    }
    
    private function validarFechas(string $ingreso, string $salida): void
    {
        // Validar formato de fecha en español (d/m/Y)
        $fechaIngreso = \DateTime::createFromFormat('d/m/Y', $ingreso);
        $fechaSalida = \DateTime::createFromFormat('d/m/Y', $salida);
        
        if (!$fechaIngreso || $fechaIngreso->format('d/m/Y') !== $ingreso) {
            throw new \InvalidArgumentException("Fecha de ingreso inválida (formato dd/mm/aaaa)");
        }
        if (!$fechaSalida || $fechaSalida->format('d/m/Y') !== $salida) {
            throw new \InvalidArgumentException("Fecha de salida inválida (formato dd/mm/aaaa)");
        }
        
        // Validar que no sea en el pasado
        $hoy = new \DateTime();
        $hoy->setTime(0, 0);
        if ($fechaIngreso < $hoy) {
            throw new \InvalidArgumentException("La fecha de ingreso no puede ser en el pasado");
        }
        
        // Validar que salida sea posterior al ingreso
        if ($fechaSalida <= $fechaIngreso) {
            throw new \InvalidArgumentException("La fecha de salida debe ser posterior al ingreso");
        }
    }
    
    public function calcularTotal(): float
    {
        $ingreso = \DateTime::createFromFormat('d/m/Y', $this->fechaIngreso);
        $salida = \DateTime::createFromFormat('d/m/Y', $this->fechaSalida);
        $dias = $ingreso->diff($salida)->days;
        return $dias * $this->habitacion->getPrecio();
    }
}