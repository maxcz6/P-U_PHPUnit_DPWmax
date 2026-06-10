<?php
use PHPUnit\Framework\TestCase;
use App\Calculadora;

class CalculadoraTest extends TestCase {
    public function testSumaDebeDarCuatro() {
        $calc = new Calculadora();
        $resultado = $calc->sumar(2, 2);
        
        // El "Assert" es nuestra validación
        $this->assertEquals(4, $resultado);
    }
}