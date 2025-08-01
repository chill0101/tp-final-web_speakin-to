# Trabajo Final: Sistema de Gestión de Cursos y Alumnos

## Consigna

Desarrollar una aplicación web en **Laravel** para gestionar alumnos, docentes, cursos e inscripciones, aplicando correctamente el patrón **MVC**, **Eloquent ORM** y buenas prácticas de desarrollo.

---

## Objetivos

- Implementar un sistema completo utilizando Laravel.
- Aplicar correctamente el patrón MVC.
- Crear migraciones complejas y reversibles.
- Definir relaciones entre modelos mediante Eloquent.
- Aplicar validaciones del lado del servidor.
- Utilizar directivas de Blade y layouts para estructurar vistas.
- Registrar roles de usuario, evaluaciones y archivos adjuntos.

---

## Requerimientos Técnicos

### Entidades a implementar (con migraciones):

---

#### 1) **Alumnos**

**Campos:**
- id
- nombre
- apellido
- dni (único)
- email (único)
- fecha_nacimiento
- teléfono
- dirección
- género (enum: masculino, femenino, otro)
- activo (boolean, default: true)

**Reglas:**
- Mayor de 16 años
- Email válido y único
- No puede inscribirse si está inactivo
- No puede tener más de 5 cursos activos simultáneamente

---

#### 2) **Docente**

**Campos:**
- id
- nombre
- apellido
- dni (único)
- email (único)
- especialidad
- teléfono
- dirección
- activo (boolean, default: true)

**Reglas:**
- No pueden asignarse cursos nuevos a docentes inactivos
- Email válido y único
- Un docente no puede tener más de 3 cursos activos


// Para este trabajo usaremos el docente como un usuario del sistema, por lo que no es necesario crear un modelo User para el docente, sino que se utilizará el modelo User para representar tanto a los administradores/coordinadores como a los docentes. Se debe tener cuidado de no asignar a un coordinador/admin como docente de un curso.
---

#### 3) **Cursos**

**Campos:**
- id
- titulo
- descripción
- fecha_inicio
- fecha_fin
- estado (enum: activo, finalizado, cancelado)
- modalidad (enum: presencial, virtual, hibrido)
- aula_virtual (nullable, obligatorio si es virtual/hibrido)
- cupos_maximos (int, default: 30)
- docente_id (FK)

**Reglas:**
- fecha_fin debe ser posterior a fecha_inicio
- No puede finalizar si no tiene alumnos
- No puede superar el cupo máximo
- Solo cursos activos pueden aceptar nuevas inscripciones

**Relaciones:**
- Pertenece a un docente

---

#### 4) **Inscripciones**

**Campos:**
- id
- alumno_id (FK)
- curso_id (FK)
- fecha_inscripción
- estado (enum: activo, aprobado, desaprobado)
- nota_final (nullable)
- asistencias (entero)
- observaciones (nullable)
- evaluado_por_docente (boolean, default: false)

**Restricciones:**
- No puede duplicarse una inscripción (alumno_id + curso_id único)
- Nota solo si fue evaluado
- Nota entre 1 y 10
- Alumnos con menos del 75% de asistencia no pueden ser aprobados

**Relaciones:**
- Un alumno puede inscribirse a muchos cursos
- Un curso puede tener muchos alumnos

---

#### 5) **Usuarios del sistema**

**Campos:**
- id
- name
- email (único)
- password
- rol (enum: admin, coordinador)

**Reglas:**
- Solo los usuarios con rol admin pueden crear/modificar docentes y cursos
- Los coordinadores solo pueden registrar alumnos y cargar inscripciones

---

#### 6) **Evaluaciones**

**Campos:**
- id
- alumno_id (FK)
- curso_id (FK)
- descripcion
- nota
- fecha

**Relaciones:**
- Una evaluación pertenece a un curso y un alumno

**Reglas:**
- Un alumno puede tener varias evaluaciones por curso
- Nota entre 1 y 10
- Solo para alumnos inscriptos al curso correspondiente

---

#### 7) **Archivos Adjuntos**

**Campos:**
- id
- curso_id (FK)
- titulo
- archivo_url
- tipo (enum: tarea, material, guía)
- fecha_subida

**Relaciones:**
- Los archivos pertenecen a un curso

**Reglas:**
- Solo administradores o docentes pueden cargar archivos
- Validar formato (PDF, DOCX, PPT, JPG, PNG)

---

## CRUDs Requeridos

- **Alumnos:** alta, edición, listado, eliminación
- **Docentes:** alta, edición, listado, eliminación
- **Cursos:** alta, edición, listado, eliminación
- **Inscripciones:** registrar, listar, eliminar (lógico o físico)
- **Evaluaciones:** agregar, modificar, listar, eliminar
- **Archivos:** subir, listar, eliminar
- **Usuarios:** registrar, login, logout, gestión por rol

---

## Validaciones Principales

- DNI único
- Email único y válido
- Validar edad mínima (16)
- Curso no puede terminar antes de empezar
- Un alumno no puede estar más de una vez en el mismo curso
- Límite de inscriptos por curso (según cupos_maximos)
- Validación de nota y asistencia en inscripciones

> Estas son las validaciones principales, aparte de las mismas deben agregar a criterio las que consideren pertinentes para la funcionalidad del sistema.

---

## Documentación

- Descripción general del sistema
- Diagrama Entidad-Relación (ER)
- Capturas de pantalla funcionales
- Instrucciones para instalar y ejecutar el proyecto
- Datos de prueba cargados
- Roles y funcionalidades habilitadas por perfil

> La estructura del proyecto debe seguir las mismas reglas que el Trabajo Parcial N°2.