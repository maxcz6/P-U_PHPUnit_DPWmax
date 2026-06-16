<?php

namespace App;

class Calculadora
{
    public function dividir($a, $b)
    {
        if ($b == 0) {
            throw new \InvalidArgumentException("No se puede dividir por cero");
        }
        return $a / $b;
    }

    public function raizCuadrada($numero)
    {
        if ($numero < 0) {
            throw new \InvalidArgumentException("No se puede calcular la raíz cuadrada de un número negativo");
        }
        return sqrt($numero);
    }

    //factorial

    //testFactorialNormal
    //testFactorialCero
    //testFactorialNegativo
    public function factorial($n)
    {
        if ($n == 0) {
            return 1;
        }
        if ($n < 0) {
        throw new \InvalidArgumentException("No se puede calcular el factorial de un número negativo");
        }
        return $n * $this->factorial($n - 1);
    }
}