# Administrador Tienda

Sistema de administración de productos desarrollado con :contentReference[oaicite:0]{index=0} 12 y PHP 8.5.

Permite gestionar productos mediante operaciones CRUD, incluyendo carga y eliminación de imágenes asociadas.

---

## Características

- CRUD completo de productos
- Gestión de imágenes por producto
- Arquitectura basada en DTOs
- Separación por capas (Service / Repository)
- Uso de interfaces para desacoplamiento
- Validaciones centralizadas
- Integración con Sanctum
- Respuestas estandarizadas mediante `cmonttf/response`
- TailwindCSS v4
- Bootstrap Icons

---

## Requisitos

- PHP ^8.5
- Composer
- Node.js + NPM
- MySQL o MariaDB

---

## Dependencias principales

| Paquete | Descripción |
|---|---|
| `laravel/framework` | Framework principal |
| `laravel/sanctum` | Autenticación API |
| `laravel/tinker` | Consola interactiva |
| `cmonttf/response` | Respuestas HTTP estandarizadas |

---

## Instalación

Clonar repositorio:

```bash
git clone <repositorio>
