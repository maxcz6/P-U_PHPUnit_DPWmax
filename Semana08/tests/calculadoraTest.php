<?php

use PHPUnit\Framework\TestCase;
use App\Calculadora;

class CalculadoraTest extends TestCase
{
    public function testSuma()    
    {
        $calculadora = new Calculadora();
        $this->assertEquals(4, $calculadora->sumar(2, 2));
    }

    public function testResta()    
    {
        $calculadora = new Calculadora();
        $this->assertEquals(0, $calculadora->restar(2, 2));
    }

    public function testMultiplicacion()    
    {
        $calculadora = new Calculadora();
        $this->assertEquals(4, $calculadora->multiplicar(2, 2));
    }

    public function testDivision()    
    {
        $calculadora = new Calculadora();
        $this->assertEquals(1, $calculadora->dividir(2, 2));
    }

    public function testEsPar()
    {
        $calculadora = new Calculadora();
        $this->assertTrue($calculadora->esPar(4));
        $this->assertFalse($calculadora->esPar(5));
        $this->assertTrue($calculadora->esPar(0));
    }

    public function testEsPositivo()
    {
        $calculadora = new Calculadora();
        $this->assertTrue($calculadora->esPositivo(10));
        $this->assertFalse($calculadora->esPositivo(-5));
        $this->assertFalse($calculadora->esPositivo(0));
    }

    public function testEsNegativo()
    {
        $calculadora = new Calculadora();
        $this->assertTrue($calculadora->esNegativo(-10));
        $this->assertFalse($calculadora->esNegativo(5));
        $this->assertFalse($calculadora->esNegativo(0));
    }

    public function testEsCero()
    {
        $calculadora = new Calculadora();
        $this->assertTrue($calculadora->esCero(0));
        $this->assertFalse($calculadora->esCero(5));
        $this->assertFalse($calculadora->esCero(-10));
    }
}
