
<?php

use PHPUnit\Framework\TestCase;
use App\RegistroUsuario;
use App\RepositorioUsuario;

class RegistroUsuarioTest extends TestCase
{
    // Ejercicio 1: Mock básico
    public function testRegistrarRetornaTrue()
    {
        $mock = $this->createMock(RepositorioUsuario::class);
        $mock->method('guardar')->willReturn(true);
        $mock->method('existe')->willReturn(false);
        
        $registro = new RegistroUsuario($mock);
        $resultado = $registro->registrar('test@mail.com');
        
        $this->assertTrue($resultado);
    }
    
    // Ejercicio 2: Verificar que se llamó a guardar
    public function testRegistrarLlamaAGuardar()
    {
        $mock = $this->createMock(RepositorioUsuario::class);
        $mock->method('existe')->willReturn(false);
        
        $mock->expects($this->once())->method('guardar');
        
        $registro = new RegistroUsuario($mock);
        $registro->registrar('test@mail.com');
    }
    
    // Ejercicio 3: Email ya existe
    public function testRegistrarRetornaFalseSiExiste()
    {
        $mock = $this->createMock(RepositorioUsuario::class);
        $mock->method('existe')->willReturn(true);
        
        $registro = new RegistroUsuario($mock);
        $resultado = $registro->registrar('test@mail.com');
        
        $this->assertFalse($resultado);
    }
    
    // Ejercicio 4: Verificar argumento
    public function testRegistrarRecibeEmailCorrecto()
    {
        $mock = $this->createMock(RepositorioUsuario::class);
        $mock->method('existe')->willReturn(false);
        
        $mock->expects($this->once())
             ->method('guardar')
             ->with('cliente@empresa.com');
        
        $registro = new RegistroUsuario($mock);
        $registro->registrar('cliente@empresa.com');
    }
    
    // Ejercicio 5: No llamar a guardar si existe
    public function testNoLlamaAGuardarSiEmailExiste()
    {
        $mock = $this->createMock(RepositorioUsuario::class);
        $mock->method('existe')->willReturn(true);
        
        $mock->expects($this->never())->method('guardar');
        
        $registro = new RegistroUsuario($mock);
        $registro->registrar('test@mail.com');
    }
}