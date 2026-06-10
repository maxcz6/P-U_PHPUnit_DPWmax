<?php

use PHPUnit\Framework\TestCase;
use App\Calculadora;

class CalculadoraFactorizadaTest extends TestCase
{
    private $calculadora;

    protected function setUp(): void
    {
        $this->calculadora = new Calculadora();
    }

    public function testSumar()
    {
        $resultado = $this->calculadora->sumar(5, 3);
        $this->assertEquals(8, $resultado);
    }

    public function testRestarNumerosPositivos()
    {
        $resultado = $this->calculadora->restar(10, 4);
        $this->assertEquals(6, $resultado);
    }

    public function testRestarConNumeroNegativo()
    {
        $resultado = $this->calculadora->restar(5, 10);
        $this->assertEquals(-5, $resultado);
    }

    public function testRestarConCero()
    {
        $resultado = $this->calculadora->restar(5, 0);
        $this->assertEquals(5, $resultado);
    }

    public function testMultiplicarNumerosPositivos()
    {
        $resultado = $this->calculadora->multiplicar(4, 5);
        $this->assertEquals(20, $resultado);
    }

    public function testMultiplicarPorCero()
    {
        $resultado = $this->calculadora->multiplicar(7, 0);
        $this->assertEquals(0, $resultado);
    }

    public function testMultiplicarNumerosNegativos()
    {
        $resultado = $this->calculadora->multiplicar(-3, 4);
        $this->assertEquals(-12, $resultado);
    }

    public function testDividirNumerosPositivos()
    {
        $resultado = $this->calculadora->dividir(10, 2);
        $this->assertEquals(5, $resultado);
    }

    public function testDividirConDecimal()
    {
        $resultado = $this->calculadora->dividir(7, 2);
        $this->assertEquals(3.5, $resultado);
    }

    public function testDividirEntreCero()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("División entre cero");
        $this->calculadora->dividir(10, 0);
    }

    public function testPotenciaBasePositivaExponentePositivo()
    {
        $resultado = $this->calculadora->potencia(2, 3);
        $this->assertEquals(8, $resultado);
    }

    public function testPotenciaExponenteCero()
    {
        $resultado = $this->calculadora->potencia(5, 0);
        $this->assertEquals(1, $resultado);
    }

    public function testPotenciaExponenteUno()
    {
        $resultado = $this->calculadora->potencia(7, 1);
        $this->assertEquals(7, $resultado);
    }

    public function testModuloDivisionExacta()
    {
        $resultado = $this->calculadora->modulo(10, 2);
        $this->assertEquals(0, $resultado);
    }

    public function testModuloConResto()
    {
        $resultado = $this->calculadora->modulo(10, 3);
        $this->assertEquals(1, $resultado);
    }

    public function testModuloDivisionEntreCero()
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage("Módulo entre cero");
        $this->calculadora->modulo(10, 0);
    }

    public function testEsParConNumeroPar()
    {
        $resultado = $this->calculadora->esPar(4);
        $this->assertTrue($resultado);
    }

    public function testEsParConCero()
    {
        $resultado = $this->calculadora->esPar(0);
        $this->assertTrue($resultado);
    }

    public function testEsParConNumeroImpar()
    {
        $resultado = $this->calculadora->esPar(3);
        $this->assertFalse($resultado);
    }
}