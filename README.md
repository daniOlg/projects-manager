# Projects Manager

Sistema web para la gestión de proyectos y usuarios, desarrollado con Laravel 11 y SQLite.

## Tecnologías principales
- **Backend:** Laravel 11 (PHP)
- **Base de datos:** SQLite (configurable)
- **Frontend:** Vite + Tailwind CSS
- **Autenticación:** JWT
- **Testing:** PHPUnit
- **Documentación de API:** Scramble + Postman Collection

## Características
- Gestión de proyectos (CRUD)
- Autenticación JWT
- Tests automatizados con PHPUnit
- Autenticación y protección de rutas con JWT
- API RESTful documentada (Scramble + Postman collection incluida)

## Requisitos
- PHP >= 8.1
- Composer
- Node.js & NPM
- SQLite (por defecto, configurable en `.env`)

## Instalación

1. Clona el repositorio:
   ```bash
   git clone https://github.com/daniOlg/projects-manager.git
   cd projects-manager
   ```
2. Instala dependencias PHP:
   ```bash
   composer install
   ```
3. Instala dependencias frontend:
   ```bash
   npm install
   ```
4. Copia el archivo de entorno y configura tus variables:
   ```bash
   cp .env.example .env
   ```
5. Genera la clave de la aplicación:
   ```bash
   php artisan key:generate
   ```
6. Ejecuta las migraciones:
   ```bash
   php artisan migrate
   ```
7. Ejecuta los seeders (opcional, para datos de ejemplo):
   ```bash
   php artisan db:seed
   ```
8. Inicia el servidor:
   ```bash
   php artisan serve
   ```

## Uso
- Accede a la interfaz web en: `http://localhost:8000`
- API disponible en: `http://localhost:8000/api/v1`
- Documentación de la API: `http://localhost:8000/docs/api`
- Colección para Postman: `projects-manager.postman_collection.json`

## Por hacer

- [ ] Actualizar tests de proyectos (tras agregar autenticación)
- [ ] Agregar rutas para manejo de usuarios (`/users`, `/users/{id}`, etc.)
- [ ] Implementar roles y permisos
- [ ] Agregar paginación y filtros en la lista de proyectos

## Ejecutar tests
```bash
php artisan test
```

## Licencia
MIT
