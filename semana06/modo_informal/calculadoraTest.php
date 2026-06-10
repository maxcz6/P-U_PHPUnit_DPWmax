<?php

use PHPUnit\Framework\TestCase;
// Paso 1: Importar el archivo con la lógica
require 'Calculadora.php'; 
class CalculadoraTest extends TestCase {
    public function test_suma_correcta() {
        // Paso 2: Instanciar la clase
        $calc = new Calculadora();
        // Paso 3: Ejecutar y comparar
        $resultado = $calc->sumar(5, 5);
        $this->assertEquals(10, $resultado);
    }
}