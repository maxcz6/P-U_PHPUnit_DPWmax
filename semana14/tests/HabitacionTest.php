<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Habitacion;

/**
 * @group habitacion
 * @covers \App\Habitacion
 */
class HabitacionTest extends TestCase
{
    public function testNumeroCero()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("El número debe ser positivo");
        new Habitacion(0, 'Simple', 100);
    }

    public function testNumeroNegativo()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("El número debe ser positivo");
        new Habitacion(-5, 'Simple', 100);
    }

    public function testPrecioCero()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("El precio debe ser positivo");
        new Habitacion(101, 'Simple', 0);
    }

    public function testPrecioNegativo()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("El precio debe ser positivo");
        new Habitacion(101, 'Simple', -100);
    }

    public function testReservarHabitacionDisponible()
    {
        $habitacion = new Habitacion(101, 'Simple', 100);
        $habitacion->reservar();
        $this->assertFalse($habitacion->isDisponible());
    }

    public function testReservarHabitacionNoDisponible()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("La habitación no está disponible");
        
        $habitacion = new Habitacion(101, 'Simple', 100);
        $habitacion->reservar();
        $habitacion->reservar();
    }
}