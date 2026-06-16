<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use App\Calculadora;

class CalculadoraTest extends TestCase
{
    private $calculadora;
    
    //usar Setup
    protected function setUp(): void
    {
        $this->calculadora = new Calculadora();
    }
    public static function proveedorDivisionNormal():array
    {
        return [
            [10, 2, 5],
            [20, 4, 5],
            [15, 3, 5],
        ];
    }

    #[DataProvider('proveedorDivisionNormal')]
    public function testDividirNormal($dividendo, $divisor, $esperado)
    {
        $resultado = $this->calculadora->dividir($dividendo, $divisor);
        $this->assertEquals($esperado, $resultado);
    }
    
    public function testDividirEntreCero()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->calculadora->dividir(10, 0);
    }
    
    public function testRaizCuadradaNormal()
    {
        $resultado = $this->calculadora->raizCuadrada(16);
        $this->assertEquals(4, $resultado);
    }
    
    public function testRaizCuadradaNegativa()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->calculadora->raizCuadrada(-1);
    }
    
    //testFactorialNormal
    //testFactorialCero
    //testFactorialNegativo
    public function testFactorialNormal()
    {
        $resultado = $this->calculadora->factorial(5);
        $this->assertEquals(120, $resultado);
    }
    public function testFactorialCero()
        //testFactorialCero
    {
        $resultado = $this->calculadora->factorial(0);
        $this->assertEquals(1, $resultado);

    }
    //testFactorialNegativo  
    public function testFactorialNegativo()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->calculadora->factorial(-1);
    }  
}