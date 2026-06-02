# Calculadora de Precios de Póliza

## Tabla de Precios

El sistema calcula automáticamente el precio de la póliza según el monto de renta mensual:

| Rango de Renta Mensual | Precio de la Póliza |
|------------------------|---------------------|
| $1.00 – $10,000 | $4,680.00 |
| $10,001 – $19,000 | $4,800.00 |
| $19,001 – $30,000 | $5,800.00 |
| $30,001 en adelante | 30% del costo anual de la renta |

## Ejemplos de Cálculo

### Ejemplo 1: Renta de $3,444.00
- Rango: $1.00 – $10,000
- Precio sin IVA: **$4,680.00**
- IVA (16%): $748.80
- **Total: $5,428.80**

### Ejemplo 2: Renta de $15,000.00
- Rango: $10,001 – $19,000
- Precio sin IVA: **$4,800.00**
- IVA (16%): $768.00
- **Total: $5,568.00**

### Ejemplo 3: Renta de $25,000.00
- Rango: $19,001 – $30,000
- Precio sin IVA: **$5,800.00**
- IVA (16%): $928.00
- **Total: $6,728.00**

### Ejemplo 4: Renta de $35,000.00
- Rango: $30,001 en adelante
- Costo anual: $35,000 × 12 = $420,000
- 30% del costo anual: $420,000 × 0.30 = **$126,000.00**
- IVA (16%): $20,160.00
- **Total: $146,160.00**

## Uso en el Sistema

### En el Wizard de Contratos

Cuando se crea un contrato en el paso 3 (Datos de Renta), el sistema automáticamente:
1. Toma el monto de renta mensual ingresado
2. Calcula el precio de la póliza según la tabla
3. Aplica el IVA del 16%
4. Guarda el `monto_total` con IVA incluido

### En la Póliza PDF

El PDF de la póliza muestra:
- **PRECIO DEL SERVICIO (SIN IVA)**: El precio base según la tabla
- **IVA (16%)**: El impuesto calculado
- **TOTAL DEL SERVICIO (IVA INCLUIDO)**: El monto total a pagar
- **LÍMITE DE RENTA PUNTUAL**: El monto de renta mensual
- **VIGENCIA DEL SERVICIO**: 12 meses

## Archivos Modificados

### Servicio Principal
- `app/Services/CalculadoraPrecioPoliza.php`: Contiene la lógica de cálculo

### Integración
- `app/Livewire/ContratoWizard.php`: Usa el servicio al crear contratos
- `app/Services/GeneradorPolizaPdf.php`: Usa el servicio para el PDF de la póliza

### Plantilla
- `database/seeders/PlantillaPolizaSeeder.php`: Plantilla actualizada con variables dinámicas

## Mantenimiento

Para actualizar la tabla de precios, editar el método `calcularPrecioPoliza()` en:
```
app/Services/CalculadoraPrecioPoliza.php
```
