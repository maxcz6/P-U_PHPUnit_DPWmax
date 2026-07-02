# Reporte - Semana 13: Pruebas desde la Línea de Comandos
# Sistema de Reservas de Hotel — PHPUnit CLI

**Fecha:** 02/07/2026  
**Alumno:** [Tu nombre]  
**PHPUnit:** 11.5.55 | **PHP:** 8.5.6 | **Xdebug:** 3.5.3

---

## PARTE A: Ejercicios con Opciones CLI

---

### Ejercicio 1: Ejecutar todas las pruebas

**Comando:**
```bash
vendor\bin\phpunit
```

**Salida:**
```
PHPUnit 11.5.55 by Sebastian Bergmann and contributors.

Runtime:       PHP 8.5.6
Configuration: phpunit.xml

....................                                              20 / 20 (100%)

Time: 00:00.012, Memory: 8.00 MB

OK (20 tests, 36 assertions)
```

---

### Ejercicio 2: Ejecutar con colores

**Comando:**
```bash
vendor\bin\phpunit --colors=always
```

**Salida:**
```
PHPUnit 11.5.55 by Sebastian Bergmann and contributors.

Runtime:       PHP 8.5.6
Configuration: phpunit.xml

....................                                              20 / 20 (100%)

Time: 00:00.010, Memory: 8.00 MB

OK (20 tests, 36 assertions)
```
> Los puntos `.` se muestran en **verde** en la terminal indicando pruebas exitosas.

---

### Ejercicio 3: Ejecutar solo las pruebas de ClienteTest

**Comando:**
```bash
vendor\bin\phpunit --filter ClienteTest
```

**Salida:**
```
PHPUnit 11.5.55 by Sebastian Bergmann and contributors.

Runtime:       PHP 8.5.6
Configuration: phpunit.xml

.....                                                               5 / 5 (100%)

Time: 00:00.007, Memory: 8.00 MB

OK (5 tests, 9 assertions)
```
> Solo se ejecutaron las 5 pruebas de la clase `ClienteTest`.

---

### Ejercicio 4: Ejecutar una prueba específica

**Comando:**
```bash
vendor\bin\phpunit --filter testNombreVacioLanzaExcepcion
```

**Salida:**
```
PHPUnit 11.5.55 by Sebastian Bergmann and contributors.

Runtime:       PHP 8.5.6
Configuration: phpunit.xml

.                                                                   1 / 1 (100%)

Time: 00:00.008, Memory: 8.00 MB

OK (1 test, 2 assertions)
```
> Solo se ejecutó 1 prueba específica del método `testNombreVacioLanzaExcepcion`.

---

### Ejercicio 5: Ejecutar con --testdox (resultados legibles)

**Comando:**
```bash
vendor\bin\phpunit --testdox
```

**Salida:**
```
PHPUnit 11.5.55 by Sebastian Bergmann and contributors.

Runtime:       PHP 8.5.6
Configuration: phpunit.xml

....................                                              20 / 20 (100%)

Time: 00:00.011, Memory: 8.00 MB

Cliente (Tests\Cliente)
 ✔ Nombre vacio lanza excepcion
 ✔ Nombre solo espacios lanza excepcion
 ✔ Email sin arroba lanza excepcion
 ✔ Email invalido lanza excepcion
 ✔ Cliente valido se crea correctamente

Habitacion (Tests\Habitacion)
 ✔ Numero habitacion cero lanza excepcion
 ✔ Numero habitacion negativo lanza excepcion
 ✔ Precio cero lanza excepcion
 ✔ Precio negativo lanza excepcion
 ✔ Reservar habitacion no disponible lanza excepcion
 ✔ Reservar habitacion disponible cambia estado
 ✔ Habitacion valida se crea correctamente

Reserva (Tests\Reserva)
 ✔ Fecha ingreso formato incorrecto lanza excepcion
 ✔ Fecha ingreso texto invalido lanza excepcion
 ✔ Fecha ingreso en pasado lanza excepcion
 ✔ Fecha salida igual a ingreso lanza excepcion
 ✔ Fecha salida anterior a ingreso lanza excepcion
 ✔ Calcular total con tres noches
 ✔ Calcular total con una noche
 ✔ Reserva valida se crea y genera resumen

OK (20 tests, 36 assertions)
```

---

### Ejercicio 6: Ejecutar por grupo

#### Grupo: `cliente`
**Comando:**
```bash
vendor\bin\phpunit --group cliente
```
**Salida:**
```
PHPUnit 11.5.55 by Sebastian Bergmann and contributors.

Runtime:       PHP 8.5.6
Configuration: phpunit.xml

.....                                                               5 / 5 (100%)

Time: 00:00.007, Memory: 8.00 MB

OK (5 tests, 9 assertions)
```

#### Grupo: `habitacion`
**Comando:**
```bash
vendor\bin\phpunit --group habitacion
```
**Salida:**
```
PHPUnit 11.5.55 by Sebastian Bergmann and contributors.

Runtime:       PHP 8.5.6
Configuration: phpunit.xml

.......                                                             7 / 7 (100%)

Time: 00:00.007, Memory: 8.00 MB

OK (7 tests, 14 assertions)
```

---

### Ejercicio 7: Combinar opciones

**Comando:**
```bash
vendor\bin\phpunit --group reserva --testdox
```

**Salida:**
```
PHPUnit 11.5.55 by Sebastian Bergmann and contributors.

Runtime:       PHP 8.5.6
Configuration: phpunit.xml

........                                                            8 / 8 (100%)

Time: 00:00.010, Memory: 8.00 MB

Reserva (Tests\Reserva)
 ✔ Fecha ingreso formato incorrecto lanza excepcion
 ✔ Fecha ingreso texto invalido lanza excepcion
 ✔ Fecha ingreso en pasado lanza excepcion
 ✔ Fecha salida igual a ingreso lanza excepcion
 ✔ Fecha salida anterior a ingreso lanza excepcion
 ✔ Calcular total con tres noches
 ✔ Calcular total con una noche
 ✔ Reserva valida se crea y genera resumen

OK (8 tests, 13 assertions)
```
> Combinando `--group reserva` con `--testdox` se ejecutan solo las 8 pruebas del grupo `reserva` en formato legible.

---

### Bonus: --debug (equivalente a --verbose en PHPUnit 11)

**Comando:**
```bash
vendor\bin\phpunit --debug
```

**Salida parcial:**
```
PHPUnit Started (PHPUnit 11.5.55 using PHP 8.5.6 (cli) on WINNT)
Test Runner Configured
Bootstrap Finished (vendor/autoload.php)
Event Facade Sealed
Test Suite Loaded (20 tests)
Test Runner Started
Test Suite Started (Sistema de Reservas de Hotel, 20 tests)
Test Suite Started (Tests\ClienteTest, 5 tests)
Test Preparation Started (Tests\ClienteTest::testNombreVacioLanzaExcepcion)
Test Prepared (Tests\ClienteTest::testNombreVacioLanzaExcepcion)
Test Passed (Tests\ClienteTest::testNombreVacioLanzaExcepcion)
Test Finished (Tests\ClienteTest::testNombreVacioLanzaExcepcion)
...
PHPUnit Finished (Shell Exit Code: 0)
```
> `--debug` muestra el ciclo de vida completo de cada prueba: preparación, ejecución y resultado.

---

## PARTE B: Investigación — Herramientas de Cobertura de Código

---

### Xdebug

**¿Qué es Xdebug?**  
Xdebug es una extensión de PHP para depuración y análisis de código. Proporciona depuración paso a paso (breakpoints), perfiles de rendimiento, trazas de pila y **cobertura de código** para pruebas unitarias.

**¿Para qué sirve en PHPUnit?**  
Permite a PHPUnit medir qué líneas, métodos y clases del código fuente son ejecutadas durante las pruebas, generando reportes de cobertura en texto, HTML u otros formatos.

**¿Cómo se instala en Windows (PHP standalone)?**  
1. Ir a https://xdebug.org/download
2. Seleccionar el DLL correspondiente a tu versión de PHP (PHP 8.5 VS17 NTS x64)
3. Descargar y copiar a `C:\tools\php85\ext\php_xdebug.dll`
4. Editar `php.ini`

**Configuración en php.ini:**
```ini
[xdebug]
zend_extension=php_xdebug.dll
xdebug.mode=coverage
xdebug.start_with_request=yes
```

**¿Cómo verificar la instalación?**
```bash
php -m | findstr xdebug
# Salida esperada: xdebug
```
o:
```bash
php -v
# Muestra: PHP 8.5.6 with Xdebug v3.5.3
```

---

### PCOV

**¿Qué es PCOV?**  
PCOV (PHP Code Coverage) es una extensión PHP ligera y de alto rendimiento diseñada **exclusivamente** para cobertura de código. A diferencia de Xdebug, no incluye funciones de depuración, lo que la hace considerablemente más rápida.

**¿Para qué sirve?**  
Mide qué líneas de código fuente son ejecutadas durante las pruebas. Es la opción preferida en entornos de **Integración Continua (CI/CD)** por su velocidad.

**¿Cómo se instala en Windows con Laravel Herd?**  
Laravel Herd administra sus propias extensiones PHP. Para instalar PCOV:
1. Abrir **Laravel Herd** → Settings → PHP → Extensions
2. Buscar PCOV en la lista de extensiones disponibles
3. Activar la extensión desde la interfaz

> **Nota:** En PHP 8.5 con instalación standalone (`C:\tools\php85`), PCOV puede descargarse como DLL desde https://pecl.php.net/package/pcov o compilarse desde su [repositorio GitHub](https://github.com/krakjoe/pcov).

**Configuración en php.ini:**
```ini
[pcov]
extension=pcov.so   ; en Linux/macOS
extension=php_pcov.dll  ; en Windows
pcov.enabled=1
```

**¿Cómo verificar la instalación?**
```bash
php -m | findstr pcov
# Salida esperada: pcov
```

---

### Opciones CLI de Cobertura

#### `--coverage-text`
Genera un reporte de cobertura directamente en la consola en texto plano.

**Comando:**
```bash
vendor\bin\phpunit --coverage-text
```

**Salida obtenida:**
```
PHPUnit 11.5.55 by Sebastian Bergmann and contributors.

Runtime:       PHP 8.5.6 with Xdebug 3.5.3
Configuration: phpunit.xml

....................                                              20 / 20 (100%)

Time: 00:00.126, Memory: 12.00 MB

OK (20 tests, 36 assertions)

Code Coverage Report:
  2026-07-02 21:20:52

 Summary:
  Classes: 33.33% (1/3)
  Methods: 66.67% (12/18)
  Lines:   88.06% (59/67)

App\Cliente
  Methods: 100.00% ( 4/ 4)   Lines: 100.00% ( 10/ 10)
App\Habitacion
  Methods:  85.71% ( 6/ 7)   Lines:  93.75% ( 15/ 16)
App\Reserva
  Methods:  28.57% ( 2/ 7)   Lines:  82.93% ( 34/ 41)
```

#### `--coverage-html`
Genera un reporte interactivo en formato HTML con navegación por clases y líneas.

**Comando:**
```bash
vendor\bin\phpunit --coverage-html coverage-report
```

**Salida:**
```
PHPUnit 11.5.55 by Sebastian Bergmann and contributors.

Runtime:       PHP 8.5.6 with Xdebug 3.5.3
Configuration: phpunit.xml

....................                                              20 / 20 (100%)

Time: 00:00.126, Memory: 12.00 MB

OK (20 tests, 36 assertions)

Generating code coverage report in HTML format ... done [00:00.041]
```
> El reporte HTML se genera en la carpeta `coverage-report/`. Se puede abrir con cualquier navegador: `coverage-report/index.html`

**Diferencia clave:**

| Aspecto              | `--coverage-text`             | `--coverage-html`                    |
|----------------------|-------------------------------|--------------------------------------|
| Formato              | Texto en consola              | Página web interactiva               |
| Detalle              | Resumen por clase             | Línea por línea con colores          |
| Persistencia         | Solo visible en terminal      | Guardado en carpeta                  |
| Uso recomendado      | CI/CD, scripts automáticos    | Revisión visual del equipo           |

**Configuración en phpunit.xml:**
```xml
<coverage>
    <report>
        <html outputDirectory="coverage-report" lowUpperBound="50" highLowerBound="90"/>
        <text outputFile="php://stdout" showUncoveredFiles="false" showOnlySummary="true"/>
    </report>
</coverage>
```

---

## Resumen de Cobertura Obtenida

| Clase           | Métodos cubiertos | Líneas cubiertas |
|-----------------|-------------------|------------------|
| `App\Cliente`   | 100% (4/4)        | 100% (10/10)     |
| `App\Habitacion`| 85.71% (6/7)      | 93.75% (15/16)   |
| `App\Reserva`   | 28.57% (2/7)      | 82.93% (34/41)   |
| **Total**       | **66.67%**        | **88.06%**       |

---

## V. Conclusiones

**¿Qué opción CLI usarías para ejecutar solo una prueba específica?**  
Usaría `--filter testNombreDelMetodo` para ejecutar exactamente una prueba, o `--filter ClassName` para una clase completa. Esto es muy útil durante el desarrollo cuando solo quieres verificar el método que acabas de escribir sin esperar toda la suite.

**¿Qué diferencia hay entre `--coverage-text` y `--coverage-html`?**  
`--coverage-text` muestra un resumen en la consola (ideal para CI/CD), mientras que `--coverage-html` genera un reporte web navegable con colores línea por línea (ideal para análisis visual). El HTML permite ver exactamente qué líneas no están cubiertas, haciendo más fácil mejorar las pruebas.

**¿Qué información adicional muestra `--debug`?**  
En PHPUnit 11, `--debug` (equivalente al antiguo `--verbose`) muestra el ciclo de vida completo de cada prueba: `Test Preparation Started`, `Before Test Method Called` (setUp), `Test Prepared`, `Test Passed/Failed` y `Test Finished`. También muestra información del suite y del runner completo.

**¿Por qué es importante la cobertura de código en un proyecto profesional?**  
La cobertura de código permite identificar qué partes del sistema no han sido probadas, reduciendo el riesgo de errores en producción. En proyectos profesionales, se suele exigir un mínimo del 80% de cobertura de líneas como estándar de calidad. Además, ayuda a justificar ante gerencia que el software ha sido validado sistemáticamente.

**¿Qué herramienta elegirías para tu proyecto: Xdebug o PCOV? ¿Por qué?**  
Elegiría **Xdebug** para el entorno de desarrollo local porque, además de cobertura, ofrece depuración interactiva con breakpoints, que es invaluable al desarrollar nuevas funcionalidades. Para un pipeline de **CI/CD** (GitHub Actions, etc.) elegiría **PCOV** porque es 3-4 veces más rápido y consume menos memoria, lo que acelera el proceso de integración continua.

---

*Reporte generado tras la instalación exitosa de Xdebug 3.5.3 y ejecución de PHPUnit 11.5.55 — 02/07/2026*
