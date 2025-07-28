
# Sistema de Gestión de Proyectos - Tech Solutions

## Asignatura: Desarrollo Web  
**Estudiantes:**  
- Amanecer Cabrera  
- Emerson Ramirez  
- Carlos Gonzalez

---

## 📌 Descripción General

Este sistema es una aplicación web desarrollada con **Laravel** (framework PHP) que permite gestionar proyectos internos para la empresa **Tech Solutions**. La aplicación implementa tanto funcionalidades **API REST** como vistas HTML con integración de **SweetAlert2** para feedback visual, y el consumo de la **UF del día** desde un servicio externo (mindicador.cl).

---

## 📁 Estructura del Proyecto

- **Modelo:** `Proyecto.php` (con campos: id, nombre, estado, fecha_inicio, responsable, monto).
- **Controlador:** `ProyectoController.php` maneja toda la lógica CRUD y servicios.
- **Servicio externo:** `ProyectoService.php` que desacopla la lógica de negocio del controlador.
- **Vistas:** Blade templates con estilo Bootstrap.
- **API:** Responde en JSON si el request lo solicita (`$request->wantsJson()`).
- **Alerta interactiva:** SweetAlert2 se utiliza para mostrar mensajes de éxito o error.

---

## ⚙️ Arquitectura y Patrones Usados

| Elemento                   | Descripción                                                                 |
|----------------------------|-----------------------------------------------------------------------------|
| MVC (Modelo-Vista-Controlador) | Laravel estructura el código en capas separadas para mejorar mantenibilidad. |
| Inyección de dependencias | Se inyecta `ProyectoService` dentro del `ProyectoController`.              |
| Reutilización de componentes | Se consume la UF en un servicio y se muestra en varias vistas.         |
| Diseño RESTful            | Las rutas siguen los principios de la arquitectura REST.                     |
| Validaciones del lado del servidor | Se utiliza `$request->validate()` para proteger entradas.        |
| Flash messages y redirecciones | Laravel maneja sesiones para mostrar errores o mensajes.           |

---

## 🔧 Funcionalidades y Rutas

### 🟢 API (en `routes/api.php`)

| Ruta                   | Método | Funcionalidad                         |
|------------------------|--------|--------------------------------------|
| `/api/proyecto`        | GET    | Listar todos los proyectos            |
| `/api/proyecto/{id}`   | GET    | Obtener proyecto por ID               |
| `/api/proyecto`        | POST   | Crear nuevo proyecto                  |
| `/api/proyecto/{id}`   | PUT    | Actualizar proyecto por ID            |
| `/api/proyecto/{id}`   | DELETE | Eliminar proyecto por ID              |

### 🟦 Web (en `routes/web.php`)

| Ruta                      | Método | Funcionalidad                        |
|---------------------------|--------|-------------------------------------|
| `/panel`                  | GET    | Panel principal con lista y UF      |
| `/proyectos/create`       | GET    | Formulario de creación de proyecto  |
| `/proyectos`              | POST   | Guardar nuevo proyecto              |
| `/proyectos/{id}`         | GET    | Ver detalle de proyecto             |
| `/proyectos/{id}/edit`    | GET    | Formulario para editar proyecto     |
| `/proyectos/{id}`         | PUT    | Actualizar proyecto                 |
| `/proyectos/{id}`         | DELETE | Eliminar proyecto                   |
| `/proyectos/buscar`       | GET    | Buscar proyecto por ID              |

---

## 🖥️ Vistas Implementadas

| Vista                    | Archivo Blade                         | Descripción                                 |
|--------------------------|----------------------------------------|---------------------------------------------|
| Crear Proyecto           | `proyectos/create.blade.php`          | Formulario con validaciones                 |
| Listado de Proyectos     | `proyectos/panel.blade.php`           | Lista todos los proyectos + UF del día      |
| Ver Proyecto             | `proyectos/show.blade.php`            | Detalle de un solo proyecto                 |
| Editar Proyecto          | `proyectos/edit.blade.php`            | Formulario editable                         |
| Eliminar Proyecto        | (modal en `panel`)                    | Confirmación modal con Bootstrap            |

---

## 🌐 Consumo Externo - Valor UF

Se integró una llamada al endpoint:

```
GET https://mindicador.cl/api/uf
```

Mediante el servicio `ProyectoService.php` para obtener el valor actualizado de la UF del día. Se muestra en la parte inferior del panel principal con fallback si la API falla.

---

## 💡 Características destacadas

- Componentes desacoplados mediante servicios.
- Rutas RESTful disponibles para frontend y backend.
- Validaciones robustas y mensajes interactivos con SweetAlert2.
- Código claro y documentado.

---

## 📄 Instrucciones de ejecución

1. Clonar el repositorio
2. Ejecutar `composer install`
3. Configurar archivo `.env` con base de datos
4. Ejecutar migraciones:
   ```bash
   php artisan migrate
   ```
5. Levantar servidor:
   ```bash
   php artisan serve
   ```

---

## 📚 Resultados de Aprendizaje Evidenciados

| Resultado | Evidencia                                                                       |
|----------|----------------------------------------------------------------------------------|
| 1.1      | Uso correcto del framework Laravel, estructura MVC, rutas y controladores.       |
| 1.2      | Componentes creados: vistas, controladores, servicios y validaciones.            |
| 1        | Identificación de rutas, modelos, vistas y servicios.                            |
| 2        | Descripción de la arquitectura y separación de responsabilidades.                |
| 3        | Uso de patrones como MVC, REST, validación y desacoplamiento de servicios.       |
| 4        | Servicios reutilizables como el consumo de la UF para múltiples vistas.          |
| 5        | Interacción fluida con el usuario usando SweetAlert2 y Bootstrap.                |
| 6        | Conexión entre vistas, controladores y servicios externos vía HTTP.              |

---
