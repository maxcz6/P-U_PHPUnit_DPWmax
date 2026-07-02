# Plan de Pruebas Unitarias - Sistema de Reservas de Hotel

**Elaborado por:** Tech Lead  
**Fecha:** 22/06/2026  
**Responsable de ejecución:** QA

---

## 1. Alcance de las pruebas

### Se prueba:
- Creación de clientes (nombre, email, teléfono)
- Creación de habitaciones (número, tipo, precio)
- Reserva de habitaciones (disponibilidad)
- Cálculo de totales (días de estadía)
- Validaciones de fechas (ingreso, salida)

### No se prueba:
- Interfaz de usuario (frontend)
- Conexión a base de datos

---

## 2. Objetivos de las pruebas

- Verificar que los clientes no se creen con datos inválidos
- Verificar que las habitaciones no se reserven si no están disponibles
- Verificar que las fechas sean válidas
- Verificar que el total se calcule correctamente

---

## 3. Estrategia de pruebas

- **Tipo:** Pruebas unitarias
- **Herramientas:** PHPUnit 11+
- **Enfoque:** Casos límite y validación de excepciones

---

## 4. Casos de prueba

| ID    | Clase      | Descripción del caso de prueba                                  | Resultado esperado                         |
|-------|------------|-----------------------------------------------------------------|--------------------------------------------|
| CP-01 | Cliente    | Crear cliente con nombre vacío (`""`)                           | Lanza `InvalidArgumentException`           |
| CP-02 | Cliente    | Crear cliente con email sin formato válido (`"no-es-email"`)    | Lanza `InvalidArgumentException`           |
| CP-03 | Habitacion | Crear habitación con número `0` o negativo                      | Lanza `InvalidArgumentException`           |
| CP-04 | Habitacion | Crear habitación con precio `0` o negativo                      | Lanza `InvalidArgumentException`           |
| CP-05 | Habitacion | Reservar habitación disponible → estado cambia a no disponible  | `isDisponible()` retorna `false`           |
| CP-06 | Habitacion | Reservar habitación ya reservada (no disponible)                | Lanza `Exception`                          |
| CP-07 | Reserva    | Crear reserva con fecha ingreso en formato incorrecto (`DD/MM`) | Lanza `InvalidArgumentException`           |
| CP-08 | Reserva    | Crear reserva con fecha ingreso en el pasado                    | Lanza `InvalidArgumentException`           |
| CP-09 | Reserva    | Crear reserva con fecha salida anterior o igual a ingreso       | Lanza `InvalidArgumentException`           |
| CP-10 | Reserva    | Calcular total con estadía de 3 noches a S/. 200 c/u            | Retorna `600.00`                           |

---

## 5. Cronograma

| Actividad                         | Fecha      |
|-----------------------------------|------------|
| Análisis del código               | 22/06/2026 |
| Escritura de pruebas unitarias    | 22/06/2026 |
| Ejecución y documentación         | 25/06/2026 |
| Generación de reporte gerencial   | 25/06/2026 |

---

## 6. Recursos

- PHP 8.0+
- PHPUnit 11+
- Composer
- VS Code / Terminal
