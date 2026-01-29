# ✅ Gestor de Tareas con Laravel Breeze

Aplicación web completa desarrollada con **Laravel 12** y **Breeze** (Blade + Tailwind). Permite a los usuarios registrarse y gestionar su propia lista de tareas privada.

Incluye funcionalidades avanzadas como marcar tareas como completadas mediante AJAX (sin recarga completa), ordenación por prioridad y seguridad por usuario.

## Características
* **Autenticación:** Login, Registro y Reset de contraseña (Breeze).
* **CRUD Completo:** Crear, Leer, Actualizar (Toggle) y Borrar tareas.
* **Seguridad:** Policy para que cada usuario vea solo *sus* tareas.
* **UX:** Interfaz limpia con Tailwind CSS y feedback visual (tareas tachadas).
* **Tipos de Datos:** Uso de Strings, Fechas, Booleanos y Enteros.

## Requisitos e Instalación

1.  **Instalar dependencias de PHP y Node.js:**
    ```bash
    composer install
    npm install
    ```

2.  **Configurar Base de Datos:**
    * Crea una base de datos MySQL.
    * Configura el archivo `.env`.
    * Ejecuta las migraciones:
    ```bash
    php artisan migrate
    ```

3.  **Compilar estilos (Tailwind):**
    ```bash
    npm run build
    ```

4.  **Ejecutar servidor:**
    ```bash
    php artisan serve
    ```

## Guía de Uso

### 1. Registro y Login
El usuario debe crearse una cuenta para acceder a su panel personal.

![Pantalla Login](ruta/a/tu/captura_login_web.png)

### 2. Panel de Tareas
Aquí se visualizan las tareas pendientes y completadas. Las tareas de prioridad "Alta" se destacan visualmente.

![Lista de Tareas](ruta/a/tu/captura_lista_tareas.png)

### 3. Crear y Completar
* Usa el formulario superior para añadir tareas rápidamente.
* Pulsa el **recuadro ()** para marcar una tarea como completada al instante.

![Tarea Completada](ruta/a/tu/captura_tarea_completada.png)

##  Bonus: Blueprint
Este proyecto incluye configuración compatible con **Laravel Blueprint** mediante el archivo `draft.yaml` para generación rápida de código.