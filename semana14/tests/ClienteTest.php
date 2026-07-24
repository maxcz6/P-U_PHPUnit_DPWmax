<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Cliente;

/**
 * @group cliente
 * @covers \App\Cliente
 */
class ClienteTest extends TestCase
{
    public function testNombreVacio()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("El nombre no puede estar vacío");
        new Cliente('', 'juan@mail.com', '987654321');
    }

    public function testEmailInvalido()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Email inválido");
        new Cliente('Juan Perez', 'invalido', '987654321');
    }
}