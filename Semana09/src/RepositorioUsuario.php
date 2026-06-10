<?php

namespace App;

class RepositorioUsuario

{
    public function guardar($email)
    {
        return true;
    }
    
    public function existe($email)
    {
        return false;
    }
}