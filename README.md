# MiBar - Sistema de Gestión de Restaurante 🍻☕

Este es un sistema de gestión web completo para un bar/restaurante, desarrollado con **PHP**, **MySQL** y **Bootstrap**. Permite la administración de productos divididos por turnos (Mañana y Tarde), gestión de usuarios y visualización dinámica del menú.

## 🚀 Características
- **Panel de Administración:** Gestión completa (CRUD) de productos (Agregar, Editar, Eliminar).
- **Seguridad:** Implementación de Sentencias Preparadas (Prepared Statements) para prevenir Inyección SQL.
- **Menú Dinámico:** Visualización de productos filtrados por horario (Mañana/Tarde) con sistema de búsqueda y paginación.
- **Autenticación:** Sistema de Login para administradores y registro para usuarios.
- **Diseño Responsivo:** Interfaz moderna adaptada a dispositivos móviles con Bootstrap 4.

## 🛠️ Tecnologías utilizadas
- **Servidor:** XAMPP (Apache + MySQL/MariaDB)
- **Backend:** PHP 8.x
- **Frontend:** HTML5, CSS3, JavaScript, Bootstrap 4
- **Base de Datos:** MySQL
- **Acceso Remoto:** Ngrok (Opcional)

---

## 📋 Guía de Instalación Paso a Paso

Sigue estos pasos para configurar el proyecto en tu computadora local:

### 1. Descargar e Instalar XAMPP
- Descarga XAMPP desde [apachefriends.org](https://www.apachefriends.org/).
- Durante la instalación, asegúrate de incluir **Apache** y **MySQL**.
- Una vez instalado, abre el **XAMPP Control Panel** e inicia (Start) los módulos de Apache y MySQL.

### 2. Ubicar el Proyecto
- Copia la carpeta `MiBar` completa.
- Pégala dentro de la carpeta `htdocs` de tu instalación de XAMPP (usualmente en `C:\xampp\htdocs\`).
- La ruta final debería ser: `C:\xampp\htdocs\MiBar\`.

### 3. Configurar la Base de Datos
- Abre tu navegador y ve a [http://localhost/phpmyadmin/](http://localhost/phpmyadmin/).
- Haz clic en **Nueva** en la barra lateral izquierda.
- Nombre de la base de datos: `restaurante`. Luego haz clic en **Crear**.
- Selecciona la base de datos `restaurante`, ve a la pestaña **Importar**.
- Haz clic en **Seleccionar archivo** y busca el archivo `restaurante.sql` que está dentro de la carpeta del proyecto.
- Baja hasta el final y haz clic en **Importar**.

### 4. Verificar Credenciales de Base de Datos
- Abre el archivo `Admin/basedatos/conexion.php` y asegúrate de que los datos coincidan con tu servidor local (por defecto en XAMPP son):
  - **Host:** `localhost`
  - **Usuario:** `root`
  - **Contraseña:** (Vacío)
  - **DB:** `restaurante`

---

## 🚀 Cómo Ejecutar el Proyecto

### Acceso Local
Una vez que Apache y MySQL estén corriendo en XAMPP:
- **Página Principal (Menú):** [http://localhost/MiBar/](http://localhost/MiBar/)
- **Panel de Administración:** [http://localhost/MiBar/Login/loginvista.php](http://localhost/MiBar/Login/loginvista.php)
  - **Usuario:** `admin`
  - **Contraseña:** `12345`

---

## 🌐 Cómo Abrir el Proyecto a Internet (Ngrok)

Si necesitas mostrar el proyecto a otra persona de forma remota sin subirlo a un hosting pago:

1. **Descargar Ngrok:** Descárgalo desde [ngrok.com](https://ngrok.com/) y descomprímelo.
2. **Autenticación:** Regístrate en su web y ejecuta el comando de tu token (solo la primera vez):
   ```bash
   ngrok config add-authtoken TU_TOKEN_AQUI
   ```
3. **Iniciar Túnel:** Con XAMPP encendido, abre una terminal y ejecuta:
   ```bash
   ngrok http 80
   ```
4. **Compartir URL:** Copia la URL que aparece en `Forwarding` (ej: `https://xxxx.ngrok-free.app`). 
   - **IMPORTANTE:** Para entrar al proyecto, debes añadir `/MiBar/` al final de esa URL.
   - Ejemplo: `https://xxxx.ngrok-free.app/MiBar/`

> **Nota:** La terminal de Ngrok debe permanecer abierta mientras quieras que el link funcione. En la cuenta gratuita, la URL cambiará cada vez que reinicies Ngrok.

### ⚠️ Solución de problemas comunes (Ngrok):

*   **Pantalla de Advertencia (Visit Site):** Al abrir el link, verás una pantalla de seguridad de Ngrok. Simplemente haz clic en el botón azul **"Visit Site"** para entrar. Es una protección de Ngrok para cuentas gratuitas.
*   **Error ERR_NGROK_3200 (Offline):** Significa que el túnel se cerró o internet se desconectó. Cierra la terminal de Ngrok, vuelve a ejecutar `ngrok http 80` y usa la **nueva URL** que te asigne.
*   **Error 404 Not Found:** Asegúrate de que la URL termina en `/MiBar/`. Si solo entras a la URL de Ngrok a secas, Apache no sabrá qué carpeta mostrar.
*   **Error 502 Bad Gateway:** Verifica que el módulo **Apache** en el XAMPP Control Panel esté en verde (Started).

---
Desarrollado por Ignacio - 2026.
