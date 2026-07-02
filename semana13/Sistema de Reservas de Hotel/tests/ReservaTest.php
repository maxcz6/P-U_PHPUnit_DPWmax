<?php

namespace Tests;

use App\Cliente;
use App\Habitacion;
use App\Reserva;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\CoversClass;

/**
 * Pruebas unitarias para la clase Reserva.
 * Cubre CP-07, CP-08, CP-09, CP-10.
 */
#[CoversClass(Reserva::class)]
#[Group('reserva')]
class ReservaTest extends TestCase
{
    private Cliente    $cliente;
    private Habitacion $habitacion;

    /**
     * Configuración inicial: crea objetos reutilizables para las pruebas.
     */
    protected function setUp(): void
    {
        $this->cliente    = new Cliente('Juan Pérez', 'juan@hotel.com', '991234567');
        $this->habitacion = new Habitacion(101, 'simple', 200.00);
    }

    // ─────────────────────────────────────────
    // CP-07: Formato de fecha de ingreso inválido
    // ─────────────────────────────────────────

    /**
     * CP-07a: Fecha de ingreso con formato DD/MM/YYYY lanza excepción.
     */
    #[Group('reserva')]
    public function testFechaIngresoFormatoIncorrectoLanzaExcepcion(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('no tiene el formato válido YYYY-MM-DD');

        new Reserva($this->cliente, $this->habitacion, '25/12/2026', '2026-12-30');
    }

    /**
     * CP-07b: Fecha de ingreso con texto inválido lanza excepción.
     */
    #[Group('reserva')]
    public function testFechaIngresoTextoInvalidoLanzaExcepcion(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new Reserva($this->cliente, $this->habitacion, 'no-es-fecha', '2026-12-30');
    }

    // ─────────────────────────────────────────
    // CP-08: Fecha de ingreso en el pasado
    // ─────────────────────────────────────────

    /**
     * CP-08: Fecha de ingreso en el pasado lanza excepción.
     */
    #[Group('reserva')]
    public function testFechaIngresoEnPasadoLanzaExcepcion(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('no puede ser en el pasado');

        new Reserva($this->cliente, $this->habitacion, '2020-01-01', '2020-01-05');
    }

    // ─────────────────────────────────────────
    // CP-09: Fecha de salida no posterior al ingreso
    // ─────────────────────────────────────────

    /**
     * CP-09a: Fecha de salida igual a fecha de ingreso lanza excepción.
     */
    #[Group('reserva')]
    public function testFechaSalidaIgualAIngresoLanzaExcepcion(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('La fecha de salida debe ser posterior a la fecha de ingreso.');

        $fechaFutura = (new \DateTime('today'))->modify('+10 days')->format('Y-m-d');
        new Reserva($this->cliente, $this->habitacion, $fechaFutura, $fechaFutura);
    }

    /**
     * CP-09b: Fecha de salida anterior a fecha de ingreso lanza excepción.
     */
    #[Group('reserva')]
    public function testFechaSalidaAnteriorAIngresoLanzaExcepcion(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $ingreso = (new \DateTime('today'))->modify('+10 days')->format('Y-m-d');
        $salida  = (new \DateTime('today'))->modify('+5 days')->format('Y-m-d');
        new Reserva($this->cliente, $this->habitacion, $ingreso, $salida);
    }

    // ─────────────────────────────────────────
    // CP-10: Cálculo correcto de días de estadía
    // ─────────────────────────────────────────

    /**
     * CP-10a: Estadía de 3 noches × S/. 200 = S/. 600.
     */
    #[Group('reserva')]
    public function testCalcularTotalConTresNoches(): void
    {
        $ingreso = (new \DateTime('today'))->modify('+1 day')->format('Y-m-d');
        $salida  = (new \DateTime('today'))->modify('+4 days')->format('Y-m-d');

        $reserva = new Reserva($this->cliente, $this->habitacion, $ingreso, $salida);

        $this->assertSame(600.00, $reserva->calcularTotal()); // 3 noches × S/. 200
    }

    /**
     * CP-10b: Estadía de 1 noche × S/. 200 = S/. 200.
     */
    #[Group('reserva')]
    public function testCalcularTotalConUnaNoche(): void
    {
        $ingreso = (new \DateTime('today'))->modify('+1 day')->format('Y-m-d');
        $salida  = (new \DateTime('today'))->modify('+2 days')->format('Y-m-d');

        $reserva = new Reserva($this->cliente, $this->habitacion, $ingreso, $salida);

        $this->assertSame(200.00, $reserva->calcularTotal()); // 1 noche × S/. 200
    }

    /**
     * Reserva válida se crea correctamente y el resumen es legible.
     */
    #[Group('reserva')]
    public function testReservaValidaSeCreaYGeneraResumen(): void
    {
        $ingreso = (new \DateTime('today'))->modify('+5 days')->format('Y-m-d');
        $salida  = (new \DateTime('today'))->modify('+8 days')->format('Y-m-d');

        $reserva = new Reserva($this->cliente, $this->habitacion, $ingreso, $salida);

        $this->assertStringContainsString('Juan Pérez', $reserva->getResumen());
        $this->assertStringContainsString('101', $reserva->getResumen());
        $this->assertStringContainsString('600', $reserva->getResumen()); // 3 noches × 200
    }
}
