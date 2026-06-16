## Propósito de la Práctica

Implementar pruebas unitarias que verifiquen que las funciones lanzan las excepciones esperadas cuando reciben entradas inválidas.

## Fundamento Teórico

**¿Qué es `expectException`?**

Es un método de PHPUnit que le dice a la prueba: _"Espero que durante la ejecución se lance una excepción de este tipo"_. Si la excepción no se lanza, la prueba falla.

**Métodos disponibles:**

| **Método** | **Verifica** |
| --- | --- |
| `expectException(Clase::class)` | El tipo de excepción |
| `expectExceptionMessage(string $message)` | El mensaje exacto |
| `expectExceptionCode(int $code)` | El código de error |

**Regla de oro:** Colocar `expectException` **ANTES** de ejecutar el código que lanza la excepción.

## Parte práctica

Paso 1: Crear la carpeta de la semana 11 e instalar `PHPUnit`

```bash
composer require --dev phpunit/phpunit
```

Paso 2: Crear las carpetas de  `src` y `tests`

Paso 3: Configurar `composer.json`

```json
{
    "autoload": {
        "psr-4": {
            "App\\": "src/"
        }
    },
    "require-dev": {
        "phpunit/phpunit": "^11"
    }
}
```
aplicar el `composer.json`

```bash
composer dump-autoload
```
Paso 4: Crear `phpunit.xml`

```xml
<?xml version="1.0" encoding="UTF-8"?>
<phpunit bootstrap="vendor/autoload.php"
         colors="true">
    <testsuites>
        <testsuite name="Tests">
            <directory>tests</directory>
        </testsuite>
    </testsuites>
</phpunit>
```

Paso 5: Crear la clase `calculadora` en `src/calculadora.php`


```php
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
}
```

Paso 6: Crear la clase `validador` en `src/validador.php`


```php
<?php

namespace App;

class Validador
{
    public function validarEdad($edad)
    {
        if ($edad < 0) {
            throw new \InvalidArgumentException("La edad no puede ser un numero negativo");
        }
        if ($edad < 18) {
            throw new \Exception("Es menor de edad");
        }
        return true;
    }

    public function validarEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("El email ingresado no es válido");
        }
        return true;
    }
}
```

Paso 7: crear las pruebas, crea un archivo en `tests/calculadoraTest.php`

```php
<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use App\Calculadora;

class CalculadoraTest extends TestCase
{
    private $calculadora;
    
    //usar Setup
    
    public static function proveedorDivisionNormal():array
    {
        //usar provider
    }

    #[DataProvider('proveedorDivisionNormal')]
    public function testDividirNormal($dividendo, $divisor, $esperado)
    {
        //usar assert
    }
    
    public function testDividirEntreCero()
    {
        //usar expectException
    }
    
    public function testRaizCuadradaNormal()
    {
        //usar assert
    }
    
    public function testRaizCuadradaNegativa()
    {
        //usar expectException
    }
}
```

paso 8: crear un archivo en `tests/validadorTest.php`

```php
<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Validador;

class ValidadorTest extends TestCase
{
    private $validador;
    
    protected function setUp(): void
    {
        //usa setup
    }
    
    public function testValidarEdadNormal()
    {
        //usa assert
    }
    
    public function testValidarEdadNegativa()
    {
        //usa expectException y expectExceptionMessage
        
    }
    
    public function testValidarEdadMenor()
    {
        //usa expectException y expectExceptionMessage
    }
    
    public function testValidarEmailNormal()
    {
        //usa assert
    }
    
    public function testValidarEmailInvalido()
    {
        //usa expectException y expectExceptionMessage
        
    }
}
```

paso 9: ejecutar las pruebas

```bash
php vendor/bin/phpunit
```

paso 10: ver los resultados en formato legible
```bash
php vendor/bin/phpunit tests --testdox
```

paso 11: agregar ejercicios adicionales de: Calcular factorial y validar contraseña

**calcular factorial**

Agrega a Calculadora el método factorial($n) que:

* Si $n es negativo, lanza InvalidArgumentException

* Si $n == 0, retorna 1

* Si $n > 0, retorna el factorial

```php
public function factorial($n)
{
    // implementación
}
```
Escribe 3 pruebas para el método factorial de:
* testFactorialNormal
* testFactorialCero
* testFactorialNegativo

**validar contraseña**

Agrega a Validador el método validarPassword($password) que:

* Si $password tiene menos de 8 caracteres, lanza Exception con mensaje "Contraseña demasiado corta"

* Si $password no tiene un número, lanza Exception con mensaje "Debe contener al menos un número"

* Si cumple todo, retorna true

```php
public function validarPassword($password)
{
    // implementación
}
```

Escribe 4 pruebas para el método factorial de:

* testValidarEmailInvalido
* testValidarPasswordNormal
* testValidarPasswordCorta
* testValidarPasswordSinNumero
