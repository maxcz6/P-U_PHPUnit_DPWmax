<?php

namespace App;

class Calculadora
{
    public function sumar($a, $b)
    {
        return $a + $b;
    }

    public function restar($a, $b)
    {
        return $a - $b;
    }

    public function multiplicar($a, $b)
    {
        return $a * $b;
    }

    public function dividir($a, $b)
    {
        if ($b == 0) {
            throw new \Exception("División entre cero");
        }
        return $a / $b;
    }

    public function potencia($base, $exponente)
    {
        return pow($base, $exponente);
    }

    public function modulo($a, $b)
    {
        if ($b == 0) {
            throw new \Exception("Módulo entre cero");
        }
        return $a % $b;
    }

    public function esPar($numero)
    {
        return $numero % 2 == 0;
    }
}