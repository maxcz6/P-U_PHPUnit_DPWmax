<?php

namespace Tests;

use App\Habitacion;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\CoversClass;

/**
 * Pruebas unitarias para la clase Habitacion.
 * Cubre CP-03, CP-04, CP-05, CP-06.
 */
#[CoversClass(Habitacion::class)]
#[Group('habitacion')]
class HabitacionTest extends TestCase
{
    // ─────────────────────────────────────────
    // CP-03: Número de habitación no positivo
    // ─────────────────────────────────────────

    /**
     * CP-03a: Número de habitación cero lanza excepción.
     */
    #[Group('habitacion')]
    public function testNumeroHabitacionCeroLanzaExcepcion(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('El número de habitación debe ser mayor a cero.');

        new Habitacion(0, 'simple', 150.00);
    }

    /**
     * CP-03b: Número de habitación negativo lanza excepción.
     */
    #[Group('habitacion')]
    public function testNumeroHabitacionNegativoLanzaExcepcion(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new Habitacion(-5, 'doble', 200.00);
    }

    // ─────────────────────────────────────────
    // CP-04: Precio no positivo
    // ─────────────────────────────────────────

    /**
     * CP-04a: Precio cero lanza excepción.
     */
    #[Group('habitacion')]
    public function testPrecioCeroLanzaExcepcion(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('El precio de la habitación debe ser mayor a cero.');

        new Habitacion(101, 'simple', 0);
    }

    /**
     * CP-04b: Precio negativo lanza excepción.
     */
    #[Group('habitacion')]
    public function testPrecioNegativoLanzaExcepcion(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new Habitacion(101, 'simple', -50.00);
    }

    // ─────────────────────────────────────────
    // CP-05 y CP-06: Disponibilidad y doble reserva
    // ─────────────────────────────────────────

    /**
     * CP-05 y CP-06: Reservar una habitación ya reservada lanza excepción.
     */
    #[Group('habitacion')]
    public function testReservarHabitacionNoDisponibleLanzaExcepcion(): void
    {
        $habitacion = new Habitacion(202, 'suite', 500.00);
        $habitacion->reservar(); // Primera reserva → OK

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('no está disponible');

        $habitacion->reservar(); // Segunda reserva → debe fallar
    }

    /**
     * CP-05: Habitación disponible puede ser reservada; estado cambia a false.
     */
    #[Group('habitacion')]
    public function testReservarHabitacionDisponibleCambiaEstado(): void
    {
        $habitacion = new Habitacion(101, 'simple', 150.00);

        $this->assertTrue($habitacion->isDisponible());

        $habitacion->reservar();

        $this->assertFalse($habitacion->isDisponible());
    }

    /**
     * Habitación con datos válidos se crea correctamente.
     */
    #[Group('habitacion')]
    public function testHabitacionValidaSeCreaCorrectamente(): void
    {
        $habitacion = new Habitacion(305, 'doble', 280.50);

        $this->assertSame(305, $habitacion->getNumero());
        $this->assertSame('doble', $habitacion->getTipo());
        $this->assertSame(280.50, $habitacion->getPrecio());
        $this->assertTrue($habitacion->isDisponible());
    }
}
