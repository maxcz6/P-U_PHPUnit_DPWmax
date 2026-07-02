<?php

namespace Tests;

use App\Cliente;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\CoversMethod;

/**
 * Pruebas unitarias para la clase Cliente.
 * Cubre los casos CP-01 (nombre vacío) y CP-02 (email inválido).
 */
#[CoversClass(Cliente::class)]
#[Group('cliente')]
class ClienteTest extends TestCase
{
    // ─────────────────────────────────────────
    // CP-01: Nombre vacío → debe lanzar excepción
    // ─────────────────────────────────────────

    /**
     * CP-01a: Nombre con cadena vacía lanza excepción.
     */
    #[Group('cliente')]
    public function testNombreVacioLanzaExcepcion(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('El nombre del cliente no puede estar vacío.');

        new Cliente('', 'maria@email.com', '987654321');
    }

    /**
     * CP-01b: Nombre con solo espacios en blanco lanza excepción.
     */
    #[Group('cliente')]
    public function testNombreSoloEspaciosLanzaExcepcion(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new Cliente('   ', 'maria@email.com', '987654321');
    }

    // ─────────────────────────────────────────
    // CP-02: Email inválido → debe lanzar excepción
    // ─────────────────────────────────────────

    /**
     * CP-02a: Email sin @ lanza excepción.
     */
    #[Group('cliente')]
    public function testEmailSinArrobaLanzaExcepcion(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('no tiene un formato válido');

        new Cliente('María García', 'mariaemail.com', '987654321');
    }

    /**
     * CP-02b: Email con formato inválido (solo texto) lanza excepción.
     */
    #[Group('cliente')]
    public function testEmailInvalidoLanzaExcepcion(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new Cliente('Carlos Ruiz', 'no-es-un-email', '987654321');
    }

    /**
     * Cliente con datos válidos se crea correctamente.
     */
    #[Group('cliente')]
    public function testClienteValidoSeCreaCorrectamente(): void
    {
        $cliente = new Cliente('Ana López', 'ana@hotel.com', '999888777');

        $this->assertSame('Ana López', $cliente->getNombre());
        $this->assertSame('ana@hotel.com', $cliente->getEmail());
        $this->assertSame('999888777', $cliente->getTelefono());
    }
}
