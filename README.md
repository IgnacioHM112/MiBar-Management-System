# MiBar - Sistema de Gestión de Restaurante 🍻☕

Este es un sistema de gestión web completo para un bar/restaurante, desarrollado con **PHP**, **MySQL** y **Bootstrap**. Permite la administración de productos divididos por turnos (Mañana y Tarde), gestión de usuarios y visualización dinámica del menú.

## 🚀 Características
- **Panel de Administración:** Gestión completa (CRUD) de productos (Agregar, Editar, Eliminar).
- **Seguridad:** Implementación de Sentencias Preparadas (Prepared Statements) para prevenir Inyección SQL.
- **Menú Dinámico:** Visualización de productos filtrados por horario (Mañana/Tarde) con sistema de búsqueda y paginación.
- **Autenticación:** Sistema de Login para administradores y registro para usuarios.
- **Diseño Responsivo:** Interfaz moderna adaptada a dispositivos móviles con Bootstrap 4.

## 🛠️ Tecnologías utilizadas
- **Backend:** PHP 8.x
- **Frontend:** HTML5, CSS3, JavaScript, Bootstrap 4
- **Base de Datos:** MySQL / MariaDB
- **Herramientas:** FontAwesome para iconos.

## 📋 Requisitos previos
- Servidor local (XAMPP, WAMP o Laragon).
- PHP >= 7.4.
- MySQL >= 5.7.

## 🔧 Instalación y Configuración

1. **Clonar el repositorio:**
   ```bash
   git clone https://github.com/tu-usuario/MiBar-Management-System.git
   ```

2. **Configurar la Base de Datos:**
   - Abre **phpMyAdmin**.
   - Crea una nueva base de datos llamada `restaurante`.
   - Importa el archivo `restaurante.sql` que se encuentra en la raíz del proyecto.

3. **Ajustar conexión:**
   - Si el proyecto no está en la carpeta `/MiBar/` de tu servidor local, edita el archivo `Admin/basedatos/conexion.php` y ajusta la función `getBaseUrl()`.

4. **Acceso al sistema:**
   - **Página principal:** `http://localhost/MiBar/`
   - **Admin Login:** `http://localhost/MiBar/Login/loginvista.php`
   - **Credenciales Admin:** Usuario: `admin` | Contraseña: `12345`

## 📸 Capturas de pantalla
*(Próximamente)*

---
Desarrollado por [Tu Nombre] - 2026.
