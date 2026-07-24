<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Cliente;
use App\Habitacion;
use App\Reserva;

/**
 * @group reserva
 * @covers \App\Reserva
 */
class ReservaTest extends TestCase
{
    private Cliente $cliente;
    private Habitacion $habitacion;

    protected function setUp(): void
    {
        $this->cliente = new Cliente('Juan Perez', 'juan@mail.com', '987654321');
        $this->habitacion = new Habitacion(101, 'Simple', 100);
    }

    public function testFechaIngresoInvalida()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Fecha de ingreso inválida (formato dd/mm/aaaa)");
        new Reserva($this->cliente, $this->habitacion, 'fecha-invalida', '03/01/2027');
    }

    public function testFechaIngresoPasado()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("La fecha de ingreso no puede ser en el pasado");
        new Reserva($this->cliente, $this->habitacion, '01/01/2020', '03/01/2027');
    }

    public function testFechaSalidaAnterior()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("La fecha de salida debe ser posterior al ingreso");
        new Reserva($this->cliente, $this->habitacion, '03/01/2027', '01/01/2027');
    }

    public function testCalcularTotal()
    {
        $reserva = new Reserva($this->cliente, $this->habitacion, '01/01/2027', '04/01/2027');
        $this->assertEquals(300, $reserva->calcularTotal());
    }
}