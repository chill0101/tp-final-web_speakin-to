# PAM System: *Practical* *Appointment* *Management* System

## Descripción General

Este proyecto es un sistema de gestión de turnos cursos de idiomas en **Laravel 12**, utilizando **Laravel Breeze** para la autenticación y **Tailwind CSS** para el diseño. Permite la administración de alumnos, docentes, cursos e inscripciones, diferenciando funcionalidades según el rol del usuario (admin o coordinador). Además, permite administrar evaluaciones y archivos adjuntos.
// Los comentarios, entidades y el código están en inglés, pero la experiencia de usuario está en español.









## Diseño

Está diseñado con la arquitectura MVC (Modelo-Vista-Controlador) y sigue buenas prácticas de **[Laravel](https://laravel.com/docs/12.x/installation)**( o eso intenta ._. ). Utiliza componentes Blade por defecto y customizados. Breeze facilita el uso de componentes reutilizables como inputs, dropdowns y botones.

---

## Herramientas y Librerías Utilizadas

- **Laravel 12**: Framework principal
- **Laravel Breeze**: Autenticación simple y rápida
- **Tailwind CSS**: Framework de estilos CSS
- **Blade Components**: Inputs, botones, navegación, etc.
- **Blade Lucide Icons**: Íconos SVG para Blade
- **Blade UI Kit**: Componentes de íconos
- **MySQL**: Base de datos
- **Seeder y Factory**: Poblar la base de datos
- **Youtube**: El Rincón de Isma, Dani Krossing
- **Recursos web**: Stack Overflow, Medium, Kinsta, Solibeth.net, Flowbite, W3, Mozilla

---

## Estructura de Carpetas

- **app/Http/Controllers/**: Controladores de la lógica de negocio
- **app/Models/**: Modelos Eloquent para cada entidad
- **database/migrations/**: Migraciones para la estructura de la base de datos
- **database/seeders/**: Seeders para poblar la base de datos con datos de ejemplo
- **resources/views/**: Vistas Blade para la UI
- **resources/views/components/**: Componentes Blade reutilizables
- **routes/web.php**: Ruteo principal de la aplicación
- **routes/auth.php**: Rutas de autenticación Breeze

---

## Modelos y Entidades Principales

- **User**: Usuarios del sistema (admin/coordinador/Docente)
  - id, name, lastName, email, password, role, specialty, phone, address, active
- **Students**: Alumnos del sistema
  - id, name, lastName, dni, email, birthDate, phone, address, gender, active
- **Courses**: Cursos
  - id, title, description, startDate, endDate, status, modality, virtualLink, maxPlaces, teacher_id
- **Enrollment**: Inscripciones de alumnos a cursos
  - id, student_id, course_id, enrollment_date
- **Evaluation**: Evaluaciones de alumnos
  - id, student_id, course_id, score, comments
- **Attachment**: Archivos adjuntos a las evaluaciones
  - id, evaluation_id, file_path, file_name

---

## Variables de Entorno
- Configurar el archivo **.env** con las variables necesarias => .env.template
```plaintext
APP_NAME=SpeakIn
APP_DESCRIPTION="Sistema de gestión de cursos de idiomas en Laravel 12"
APP_ENV=local
APP_KEY=base64:XXXXXXXXXXXX
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=speakindb


```

## Comandos Artisan Útiles

### Levantar el proyecto

```bash

  # Levanta el servidor en http://localhost:8000
  php artisan serve 

  # Importante: Para compilar bien los assets como Tailwind ejecutar run dev
  npm run dev

```


### Crear modelos y recursos
```bash
php artisan make:model User -mcr
php artisan make:model Student -mcr
php artisan make:model Course -mcr
php artisan make:model Enrollment -mcr
php artisan make:model Evaluation -mcr
php artisan make:model Attachment -mcr

```

### Migraciones y Seeders
```bash
php artisan migrate
php artisan db:seed
php artisan migrate:fresh # Reinicia y repuebla la base de datos # Tuve una equivocación y este comando me ayudó a resetear luego de arreglarlo (entendiendo que estamos en el inicio del proyecto)
```

### Compilar assets (Vite)
```bash
npm run dev
npm run build # Para producción
```

---

## Instalación de Breeze

```bash
composer require laravel/breeze --dev
php artisan breeze:install
npm install && npm run dev
```

---

## Instalación de Íconos SVG

[Blade Icons](https://github.com/driesvints/blade-icons)
```bash
composer require blade-ui-kit/blade-icons
composer require mallardduck/blade-lucide-icons
```

---

## Instalación de idioma

```bash
composer require --dev laravel-lang/common
php artisan lang:add es en
```

---

## Roles y Permisos

- **Admin**: Puede gestionar alumnos, docentes, cursos, inscripciones y evaluaciones.
- **Coordinador**: Puede gestionar alumnos y cargar inscripciones, pero no docentes ni cursos.
- **Docente**: Puede ver sus cursos, inscripciones y evaluaciones, pero no puede gestionar alumnos ni docentes.

### Middleware
Para gestionar los roles y permisos, se creó un middleware personalizado que simplemente redirige a los usuarios que no tienen rol a un forbidden page.

```bash

php artisan make:middleware RoleMiddleware

```

## **IMPORTANTE ANTES DE COMENZAR!**
**- El Admin que gestiona todo es generado únicamente a través de seeder en el file database/seeders/AdminUserSeeder.php**
- Si quisieras cambiar los datos de ingreso, se debe modificar el AdminUserSeeder, si la base de datos se importadirectamente, las credenciales ya generadas son las que se encuentran allí. 

---


## Funcionalidades

- **Autenticación**: Login, registro, recuperación de contraseña (Breeze)
- **Gestión de alumnos**: CRUD completo
- **Gestión de docentes**: CRUD completo
- **Gestión de cursos**: CRUD completo
- **Gestión de inscripciones**: CRUD completo
- **Gestión de evaluaciones**: CRUD completo
- **Carga de archivos adjuntos**: Asociados a evaluaciones
- **Dashboard**: Estadísticas y accesos rápidos según el rol

---

## Filtros y Búsquedas
TBD

---

## Paginación

Se utiliza el método Eloquent `paginate()` en los controladores.  
Los enlaces de paginación se muestran con `{{ $modelo->links() }}` en las vistas.

---

## Personalización de Estilos

- **Tailwind CSS**: Configurado en `tailwind.config.js` con personalizaciones
- **Breakpoints**: El breakpoint `sm` está personalizado a 700px
- **Login**: Fondo personalizado con SVG en `resources/css/app.css` y aplicado en el layout `guest.blade.php`

---

---

## Modelos

### User

- **Campos:** id, name, email, password, role
- **Funcionalidades:**  
  - Autenticación y roles (`admin`, `coordinator`, `professor`)
  - Relación: Si el usuario es profesor, tiene muchos cursos (`courses()`)

### Student
- **Campos:** id, first_name, last_name, dni, email, birth_date, phone, address, gender, active
- **Funcionalidades:**  
  - Relación: Tiene muchas inscripciones (`enrollments()`)
  - Relación: Tiene muchas evaluaciones (`evaluations()`)

### Course
- **Campos:** id, title, description, start_date, end_date, status, modality, virtual_link, max_capacity, teacher_id
- **Funcionalidades:**  
  - Relación: Pertenece a un profesor (`teacher()`)
  - Relación: Tiene muchas inscripciones (`enrollments()`)
  - Relación: Tiene muchas evaluaciones (`evaluations()`)
  - Relación: Tiene muchos archivos adjuntos (`attachments()`)

### Enrollment
- **Campos:** id, student_id, course_id, enrollment_date, status, final_grade, attendance, notes, graded_by_teacher
- **Funcionalidades:**  
  - Relación: Pertenece a un estudiante (`student()`)
  - Relación: Pertenece a un curso (`course()`)

### Evaluation
- **Campos:** id, student_id, course_id, score, comments
- **Funcionalidades:**  
  - Relación: Pertenece a un estudiante (`student()`)
  - Relación: Pertenece a un curso (`course()`)

### Attachment
- **Campos:** id, course_id, title, file_url, type, uploaded_at
- **Funcionalidades:**  
  - Relación: Pertenece a un curso (`course()`)

---


## Configuración y Estructura de Modelos, Migraciones y Seeders

### Modelos Eloquent

Todos los modelos principales (`User`, `Student`, `Course`, `Enrollment`, `Evaluation`, `Attachment`) están definidos en `app/Models/` y cumplen con las siguientes buenas prácticas:

- Uso del trait `HasFactory` para compatibilidad con factories y seeders.
- Definición del array `$fillable` con los campos permitidos para asignación masiva.
- Relaciones Eloquent correctamente implementadas entre entidades (por ejemplo, `Student` tiene muchas `Enrollment` y `Evaluation`, `Course` pertenece a un `User` como profesor, etc.).

### Migraciones

Las migraciones definen la estructura de la base de datos alineada a la consigna:

- Campos y enums en inglés.
- Relaciones entre tablas mediante claves foráneas.
- Restricciones de unicidad y reglas de negocio reflejadas en los controladores.

### Seeders y Factories

- El seeder principal (`DatabaseSeeder.php`) crea usuarios con roles (`admin`, `coordinator`, `professor`), estudiantes, cursos, inscripciones, evaluaciones y archivos adjuntos de prueba.
- Las factories (`UserFactory.php`, `StudentFactory.php`) permiten poblar la base de datos con datos realistas y variados para pruebas y desarrollo.

### Middleware de Roles

- Se implementó un middleware personalizado (`RoleMiddleware.php`) para restringir el acceso a rutas según el rol del usuario.
- El middleware se registra en `routes/Middleware.php` y se utiliza en las rutas con la sintaxis `role:admin,coordinator,professor`.

### Proceso de Inicialización

1. Ejecuta las migraciones y seeders:
   ```bash
   php artisan migrate:fresh --seed
   ```
2. El sistema queda listo para pruebas y desarrollo, con datos de ejemplo y control de acceso por roles.

---

## Estado Actual

- **Migraciones, modelos y seeders listos y alineados a la consigna.**
- **Controladores CRUD implementados con validaciones y reglas de negocio.**
- **Middleware de roles funcionando en Laravel 12.**
- **Base de datos poblada y lista para desarrollo de vistas y lógica de negocio.**

---
---

## Referencias y Recursos

- Laravel Breeze
- Carbon Nesbot documentation
- Blade Lucide Icons
- Blade UI Kit
- Tailwind CSS
- Vite / Laravel Mix
- Laravel documentation
- Youtube: El Rincón de Isma, Dani Krossing
- Stack Overflow, Medium, Kinsta, Solibeth.net, Flowbite, Tailwind documentation 

---

## Notas

- Para cambiar el idioma de los componentes de Laravel (ej. paginate()) edita `resources/lang/es/pagination.php`.



php artisan route:clear
php artisan config:clear
php artisan cache:clear

## Check final
### Trabajo Fianal


### Review

- Requerimientos: 


# MUCHAS GRACIAS POR TODO! 🤓








1. Estructura y Arquitectura
- [X] Proyecto Laravel correctamente inicializado
- [X] Uso del patrón MVC (Model-View-Controller)
- [X] Modelos Eloquent con relaciones (hasMany, belongsTo, etc.)
- [X] Migraciones reversibles y completas para todas las entidades
- [X] Seeders con datos de prueba
2. Entidades y Migraciones
- [X] Alumnos: id, nombre, apellido, dni (único), email (único), fecha_nacimiento, teléfono, dirección, género (enum), activo (boolean)
- [X] Docentes: id, nombre, apellido, dni (único), email (único), especialidad, teléfono, dirección, activo (boolean)
- [X] Cursos: id, título, descripción, fecha_inicio, fecha_fin, estado (enum), modalidad (enum), aula_virtual (nullable), cupos_maximos, docente_id (FK)
- [X] Inscripciones: id, alumno_id (FK), curso_id (FK), fecha_inscripción, estado (enum), nota_final (nullable), asistencias, observaciones (nullable), evaluado_por_docente (boolean)
- [X] Usuarios: id, name, email (único), password, rol (enum: admin, coordinador)
- [X] Evaluaciones: id, alumno_id (FK), curso_id (FK), descripcion, nota, fecha
- [X] Archivos Adjuntos: id, curso_id (FK), titulo, archivo_url, tipo (enum), fecha_subida
3. Validaciones y Reglas de Negocio
- [X] Edad mínima de alumnos: 16 años
- [X] Email y DNI únicos y válidos
- [X] No puede duplicarse una inscripción (alumno_id + curso_id único)
- [X] Nota solo si fue evaluado y entre 1 y 10
- [X] Un docente no puede tener más de 3 cursos activos
- [X] Un alumno no puede tener más de 5 cursos activos
- [X] No se pueden asignar cursos nuevos a docentes inactivos
- [X] Curso no puede finalizar si no tiene alumnos
- [X] Curso no puede superar el cupo máximo
- [X] Solo cursos activos pueden aceptar inscripciones
- [X] Validar formato de archivos adjuntos (PDF, DOCX, PPT, JPG, PNG)
- [X] Solo administradores o docentes pueden cargar archivos
4. CRUDs y Funcionalidad
- [X] CRUD completo para Alumnos
- [X] CRUD completo para Docentes
- [X] CRUD completo para Cursos
- [X] CRUD completo para Inscripciones
- [X] CRUD completo para Evaluaciones
- [X] CRUD completo para Archivos Adjuntos
- [X] CRUD y gestión de Usuarios (registro, login, logout, roles)
5. Roles y Permisos
- [X] Solo admin y coordinador pueden crear, editar y eliminar usuarios, cursos y asignar docentes
- [X] Solo docentes pueden ser asignados como profesores de cursos
- [X] Coordinadores solo pueden registrar alumnos y cargar inscripciones
- [X] Restricción de acciones en controladores y vistas según rol
6. Vistas y UI
- [X] Vistas Blade diferenciadas por rol (admin, coordinador, docente, alumno)
- [X] Dashboard con métricas y accesos rápidos por rol
- [X] Navegación clara y mensajes de estado en español
- [X] Mensajes de error claros y en español
7. Documentación
- [X] README con descripción general del sistema
- [X] Instrucciones para instalar y ejecutar el proyecto
- [X] Roles y funcionalidades habilitadas por perfil
- [X] Diagrama Entidad-Relación (ER) adjunto o enlace
- [X] Capturas de pantalla funcionales
- [X] Datos de prueba cargados (seeders)
8. Extras y Buenas Prácticas
- [X] Código limpio y comentado
- [X] Uso de layouts y componentes Blade reutilizables
- [ ] Pruebas unitarias o de integración básicas (opcional pero recomendable)
- [X] Estructura de carpetas ordenada y siguiendo la convención Laravel

---
