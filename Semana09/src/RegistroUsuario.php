<?php

namespace App;

class RegistroUsuario
{
    private $repositorio;
    
    public function __construct($repositorio)
    {
        $this->repositorio = $repositorio;
    }
    
    public function registrar($email)
    {
        if ($this->repositorio->existe($email)) {
            return false;
        }
        return $this->repositorio->guardar($email);
    }
}