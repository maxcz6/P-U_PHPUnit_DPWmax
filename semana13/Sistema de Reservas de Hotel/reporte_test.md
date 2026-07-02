# Informe de Pruebas Unitarias — Sistema de Reservas de Hotel

**Proyecto:** Sistema de Reservas de Hotel — Hotel Paraíso  
**Fecha de ejecución:** 02/07/2026  
**Responsable QA:** [Tu nombre]  
**Herramienta:** PHPUnit 11.5.55 | PHP 8.5.6  

---

## 1. Resumen Ejecutivo

| Métrica              | Valor         |
|----------------------|---------------|
| Total de pruebas     | **20**        |
| Pruebas pasadas ✅   | **20**        |
| Pruebas fallidas ❌  | **0**         |
| Afirmaciones totales | **36**        |
| Tiempo de ejecución  | 0.011 segundos|
| Memoria utilizada    | 8.00 MB       |

> **Resultado:** ✅ **APROBADO — Todas las pruebas pasan sin errores ni advertencias.**

---

## 2. Errores identificados y corregidos

| ID    | Clase      | Error identificado                                       | Corrección aplicada                                            |
|-------|------------|----------------------------------------------------------|----------------------------------------------------------------|
| CP-01 | Cliente    | No validaba que el nombre esté vacío                     | Se agregó validación con `trim()` + `InvalidArgumentException` |
| CP-02 | Cliente    | No validaba el formato del email                         | Se agregó `filter_var($email, FILTER_VALIDATE_EMAIL)`          |
| CP-03 | Habitacion | No validaba que el número de habitación fuera positivo   | Se validó `$numero > 0`, lanza `InvalidArgumentException`      |
| CP-04 | Habitacion | No validaba que el precio fuera positivo                 | Se validó `$precio > 0`, lanza `InvalidArgumentException`      |
| CP-05 | Habitacion | No verificaba si la habitación estaba disponible         | `reservar()` revisa `$this->disponible` antes de cambiar estado|
| CP-06 | Habitacion | No lanzaba excepción al reservar habitación no disponible| `reservar()` lanza `Exception` si `$disponible === false`      |
| CP-07 | Reserva    | No validaba el formato de la fecha de ingreso            | Se usa `DateTime::createFromFormat('Y-m-d', ...)` para validar |
| CP-08 | Reserva    | No validaba que la fecha no fuera en el pasado           | Se compara `$ingreso` con `new DateTime('today')`              |
| CP-09 | Reserva    | No validaba que la salida sea posterior al ingreso       | Se compara `$salida <= $ingreso`, lanza excepción si es cierto |
| CP-10 | Reserva    | `calcularTotal()` usaba `$dias = 1` fijo                 | Se usa `$ingreso->diff($salida)->days` para días reales        |

---

## 3. Resultados del `--testdox`

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

## 4. Detalle de casos de prueba ejecutados

### Clase `Cliente` — 5 pruebas

| ID    | Prueba                                      | Estado |
|-------|---------------------------------------------|--------|
| CP-01a| Nombre vacío `""` lanza excepción           | ✅     |
| CP-01b| Nombre solo espacios `"   "` lanza excepción| ✅     |
| CP-02a| Email sin `@` lanza excepción               | ✅     |
| CP-02b| Email con texto inválido lanza excepción     | ✅     |
| —     | Cliente válido se crea correctamente        | ✅     |

### Clase `Habitacion` — 7 pruebas

| ID    | Prueba                                              | Estado |
|-------|-----------------------------------------------------|--------|
| CP-03a| Número `0` lanza excepción                          | ✅     |
| CP-03b| Número negativo lanza excepción                     | ✅     |
| CP-04a| Precio `0` lanza excepción                          | ✅     |
| CP-04b| Precio negativo lanza excepción                     | ✅     |
| CP-05 | Reservar habitación disponible cambia estado        | ✅     |
| CP-06 | Reservar habitación no disponible lanza excepción   | ✅     |
| —     | Habitación válida se crea correctamente             | ✅     |

### Clase `Reserva` — 8 pruebas

| ID    | Prueba                                              | Estado |
|-------|-----------------------------------------------------|--------|
| CP-07a| Fecha ingreso formato `DD/MM/YYYY` lanza excepción  | ✅     |
| CP-07b| Fecha ingreso texto inválido lanza excepción        | ✅     |
| CP-08 | Fecha ingreso en el pasado lanza excepción          | ✅     |
| CP-09a| Fecha salida igual a ingreso lanza excepción        | ✅     |
| CP-09b| Fecha salida anterior a ingreso lanza excepción     | ✅     |
| CP-10a| Cálculo total: 3 noches × S/. 200 = S/. 600         | ✅     |
| CP-10b| Cálculo total: 1 noche × S/. 200 = S/. 200          | ✅     |
| —     | Reserva válida genera resumen correcto              | ✅     |

---

## 5. Conclusiones

**¿Qué importancia tiene el rol del QA en el proceso de desarrollo?**  
El QA garantiza que el código funcione correctamente no solo en casos normales, sino también en casos límite (valores vacíos, negativos, fechas inválidas). Sin pruebas, errores como `$dias = 1` fijo o la ausencia de validación de emails pasarían desapercibidos hasta producción, generando pérdidas económicas y mala experiencia al usuario.

**¿Cómo cambia tu enfoque al trabajar con un plan de pruebas ya elaborado?**  
Contar con un plan del Tech Lead permite enfocarse directamente en escribir y ejecutar las pruebas sin tener que diseñar los casos desde cero. El QA se convierte en ejecutor y documentador, lo que agiliza el proceso y garantiza cobertura completa de los puntos identificados.

**¿Qué ventaja tiene documentar las pruebas con `@covers` y `@group`?**  
- `#[CoversClass]` vincula cada test a la clase específica que prueba, facilitando reportes de cobertura de código con `--coverage-html`.  
- `#[Group]` permite ejecutar grupos específicos (`--group cliente`) durante el desarrollo, sin correr toda la suite, lo que ahorra tiempo en proyectos grandes.

---

*Informe generado automáticamente tras la ejecución exitosa de PHPUnit 11.5.55*
