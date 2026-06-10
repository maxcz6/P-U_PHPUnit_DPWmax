<?php

use PHPUnit\Framework\TestCase;
use App\Calculadora;

class CalculadoraTest extends TestCase
{
    public function testSumar()
    {
        // ARRANGE
        $calculadora = new Calculadora();
        $numero1 = 5;
        $numero2 = 3;
        $esperado = 8;

        // ACT
        $resultado = $calculadora->sumar($numero1, $numero2);

        // ASSERT
        $this->assertEquals($esperado, $resultado);
    }

    public function testRestarNumerosPositivos()
    {
        $calculadora = new Calculadora();
        $resultado = $calculadora->restar(10, 4);
        $this->assertEquals(6, $resultado);
    }

    public function testRestarConNumeroNegativo()
    {
        $calculadora = new Calculadora();
        $resultado = $calculadora->restar(5, 10);
        $this->assertEquals(-5, $resultado);
    }

    public function testRestarConCero()
    {
        $calculadora = new Calculadora();
        $resultado = $calculadora->restar(5, 0);
        $this->assertEquals(5, $resultado);
    }

    public function testMultiplicarNumerosPositivos()
    {
        $calculadora = new Calculadora();
        $resultado = $calculadora->multiplicar(4, 5);
        $this->assertEquals(20, $resultado);
    }

    public function testMultiplicarPorCero()
    {
        $calculadora = new Calculadora();
        $resultado = $calculadora->multiplicar(7, 0);
        $this->assertEquals(0, $resultado);
    }

    public function testMultiplicarNumerosNegativos()
    {
        $calculadora = new Calculadora();
        $resultado = $calculadora->multiplicar(-3, 4);
        $this->assertEquals(-12, $resultado);
    }

    public function testDividirNumerosPositivos()
    {
        $calculadora = new Calculadora();
        $resultado = $calculadora->dividir(10, 2);
        $this->assertEquals(5, $resultado);
    }

    public function testDividirConDecimal()
    {
        $calculadora = new Calculadora();
        $resultado = $calculadora->dividir(7, 2);
        $this->assertEquals(3.5, $resultado);
    }

    public function testDividirEntreCero()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("División entre cero");
        $calculadora = new Calculadora();
        $calculadora->dividir(10, 0);
    }

    public function testPotenciaBasePositivaExponentePositivo()
    {
        $calculadora = new Calculadora();
        $resultado = $calculadora->potencia(2, 3);
        $this->assertEquals(8, $resultado);
    }

    public function testPotenciaExponenteCero()
    {
        $calculadora = new Calculadora();
        $resultado = $calculadora->potencia(5, 0);
        $this->assertEquals(1, $resultado);
    }

    public function testPotenciaExponenteUno()
    {
        $calculadora = new Calculadora();
        $resultado = $calculadora->potencia(7, 1);
        $this->assertEquals(7, $resultado);
    }

    public function testModuloDivisionExacta()
    {
        $calculadora = new Calculadora();
        $resultado = $calculadora->modulo(10, 2);
        $this->assertEquals(0, $resultado);
    }

    public function testModuloConResto()
    {
        $calculadora = new Calculadora();
        $resultado = $calculadora->modulo(10, 3);
        $this->assertEquals(1, $resultado);
    }

    public function testModuloDivisionEntreCero()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Módulo entre cero");
        $calculadora = new Calculadora();
        $calculadora->modulo(10, 0);
    }

    public function testEsParConNumeroPar()
    {
        $calculadora = new Calculadora();
        $resultado = $calculadora->esPar(4);
        $this->assertTrue($resultado);
    }

    public function testEsParConCero()
    {
        $calculadora = new Calculadora();
        $resultado = $calculadora->esPar(0);
        $this->assertTrue($resultado);
    }

    public function testEsParConNumeroImpar()
    {
        $calculadora = new Calculadora();
        $resultado = $calculadora->esPar(3);
        $this->assertFalse($resultado);
    }
}