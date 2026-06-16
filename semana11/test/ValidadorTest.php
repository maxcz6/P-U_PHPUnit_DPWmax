<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Validador;

class ValidadorTest extends TestCase
{
    private $validador;
    
    protected function setUp(): void
    {
        $this->validador = new Validador();
    }
    
    //dataProvider para validarEdadNormal
    public static function proveedorEdadNormal():array
    {
        return [
            [18, 5, 4],
            [25, 30, 25],
            [30, 35, 30],
        ];
    }
    public function testValidarEdadNormal()
    {
        //usa assert
        $this->validador = new Validador();
        $resultado = $this->validador->validarEdad(25);
        $this->assertTrue($resultado);
    }
    
    public function testValidarEdadNegativa()
    {
        //usa expectException y expectExceptionMessage
        $this->validador = new Validador();
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("La edad no puede ser un numero negativo");
        $this->validador->validarEdad(-5);
    }
    
    public function testValidarEdadMenor()
    {
        //usa expectException y expectExceptionMessage
        $this->validador = new Validador();
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Es menor de edad");
        $this->validador->validarEdad(17);
    }
    //EMAIL
    public function testValidarEmailNormal()
    {
        //usa assert
        $this->validador = new Validador();
        $resultado = $this->validador->validarEmail("test@example.com");
        $this->assertTrue($resultado);
    }
    
    public function testValidarEmailInvalido()
    {
        //usa expectException y expectExceptionMessage
        $this->validador = new Validador();
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("El email ingresado no es válido");
        $this->validador->validarEmail("invalid-email");
    }
    //Si $password tiene menos de 8 caracteres, lanza Exception con mensaje "Contraseña demasiado corta"
    //Si $password no tiene un número, lanza Exception con mensaje "Debe contener al menos un número"
    //Si cumple todo, retorna true

    public function testValidarPasswordNormal()
    {
        //usa assert
        $this->validador = new Validador();
        $resultado = $this->validador->validarPassword("password1");
        $this->assertTrue($resultado);
    }

    public function testValidarPasswordCorta()
    {
        //usa expectException y expectExceptionMessage
        $this->validador = new Validador();
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Contraseña demasiado corta");
        $this->validador->validarPassword("pass1");
    }

    public function testValidarPasswordSinNumero()
    {
        //usa expectException y expectExceptionMessage
        $this->validador = new Validador();
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Debe contener al menos un número");
        $this->validador->validarPassword("password");
    }
}