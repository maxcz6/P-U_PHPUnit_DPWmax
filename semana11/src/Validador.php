<?php

namespace App;

class Validador
{

    public function validarEdad($edad)
    {
        // Si la edad es negativa, lanzar InvalidArgumentException.
        if ($edad < 0) {
            throw new \InvalidArgumentException("La edad no puede ser un numero negativo");
        }
        // Si la edad es menor de 18 años, considerarla inválida para este contexto
        // y lanzar InvalidArgumentException (coincide con las expectativas de los tests).
        if ($edad < 18) {
            throw new \InvalidArgumentException("Es menor de edad");
        }
        return true;
    }
    // EMAIL
    public function validarEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("El email ingresado no es válido");
        }
        return true;
    }
    public function validarPassword($password)
    {
        if (strlen($password) < 8) {
            throw new \InvalidArgumentException("Contraseña demasiado corta");
        }
        if (!preg_match('/\d/', $password)) {
            throw new \InvalidArgumentException("Debe contener al menos un número");
        }
        return true;
    }
}