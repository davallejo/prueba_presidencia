# Sistema de Autenticación Web

Un sistema completo de autenticación desarrollado en PHP con PostgreSQL que incluye registro, login seguro y manejo de sesiones.

<img width="970" height="765" alt="image" src="https://github.com/user-attachments/assets/8455c692-0d23-43e4-8a45-172315aae347" />


## 📋 Descripción

Este proyecto implementa un sistema de autenticación robusto con las mejores prácticas de seguridad web. Incluye validación tanto en frontend como backend, contraseñas hasheadas con bcrypt y manejo seguro de sesiones.

## ✨ Características

- 🔐 **Login seguro** con contraseñas hasheadas usando bcrypt
- 📝 **Registro de usuarios** con validación completa
- 🛡️ **Manejo de sesiones** seguro con `$_SESSION`
- ✅ **Validación dual**: Frontend (JavaScript) y Backend (PHP)
- 🗄️ **Base de datos PostgreSQL** con PDO para prevenir inyección SQL
- 📱 **Diseño responsive** con CSS moderno
- 🔄 **Redirecciones inteligentes** basadas en el estado de autenticación
- ⚠️ **Manejo de errores** comprehensive
- 🧹 **Sanitización de inputs** para mayor seguridad

## 🛠️ Tecnologías

- **Backend**: PHP 7.4+
- **Base de Datos**: PostgreSQL 12+
- **Frontend**: HTML5, CSS3, JavaScript (Vanilla)
- **Servidor Web**: Apache (XAMPP)
- **Seguridad**: bcrypt, PDO, sesiones PHP

## 📁 Estructura del Proyecto

```
login_project/
├── config/
│   └── database.php          # Configuración de base de datos
├── includes/
│   └── functions.php         # Funciones auxiliares
├── css/
│   └── style.css            # Estilos del sistema
├── js/
│   └── validation.js        # Validación frontend
├── index.php                # Página de login
├── register.php             # Página de registro
├── dashboard.php            # Panel de usuario (protegido)
├── auth.php                 # Procesamiento de login
├── logout.php               # Cierre de sesión
└── README.md               # Este archivo

<img width="833" height="526" alt="image" src="https://github.com/user-attachments/assets/f8151237-37b4-4979-81e3-329795f70366" />

```

## ⚙️ Instalación

### Requisitos Previos

- XAMPP instalado con Apache y PHP 7.4+
- PostgreSQL instalado
- pgAdmin (opcional, para gestión de BD)
- Extensión `pdo_pgsql` habilitada en PHP

<img width="816" height="478" alt="image" src="https://github.com/user-attachments/assets/808eb2df-5495-4954-9ed0-2e629abd2acc" />


### Pasos de Instalación

1. **Clona el repositorio**
   ```bash
   git clone https://github.com/davallejo/prueba_presidencia
   cd sistema-autenticacion
   ```

2. **Copia el proyecto a XAMPP**
   ```bash
   cp -r . /path/to/xampp/htdocs/login_project/
   ```

3. **Configura la base de datos**
   - Abre pgAdmin
   - Crea una nueva base de datos llamada `login_system`
   - Ejecuta el siguiente SQL:

   ```sql
   -- Crear tabla de usuarios
   CREATE TABLE users (
       id SERIAL PRIMARY KEY,
       username VARCHAR(50) UNIQUE NOT NULL,
       email VARCHAR(100) UNIQUE NOT NULL,
       password VARCHAR(255) NOT NULL,
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );

   -- Insertar usuario de prueba (password: "123456")
   INSERT INTO users (username, email, password) VALUES 
   ('admin', 'admin@test.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');
   ```

4. **Configura la conexión**
   - Edita `config/database.php`
   - Actualiza las credenciales de PostgreSQL:
   ```php
   $host = 'localhost';
   $dbname = 'login_system';
   $username = 'postgres';        // Tu usuario de PostgreSQL
   $password = 'tu_password';     // Tu contraseña de PostgreSQL
   $port = '5432';
   ```

5. **Habilita la extensión PostgreSQL**
   - Edita `php.ini` en XAMPP
   - Descomenta: `extension=pdo_pgsql`
   - Reinicia Apache

6. **Accede al sistema**
   - Ve a: `http://localhost/login_project/`
   - Usa las credenciales de prueba:
     - **Usuario**: `admin`
     - **Contraseña**: `123456`

## 🚀 Uso

### Login
1. Accede a la página principal
2. Ingresa usuario/email y contraseña
3. El sistema validará las credenciales
4. Si son correctas, serás redirigido al dashboard
<img width="969" height="684" alt="image" src="https://github.com/user-attachments/assets/5ac1d1e9-8000-41eb-b656-047f0ead2529" />


### Registro
1. Haz clic en "Regístrate aquí" desde el login
2. Completa el formulario de registro
3. El sistema validará los datos
4. Al registrarte exitosamente, podrás hacer login
<img width="968" height="848" alt="image" src="https://github.com/user-attachments/assets/f81793a1-1962-4fad-8af6-74e095629edd" />


### Dashboard
- Panel protegido solo para usuarios autenticados
- Muestra información del usuario actual
- Opción para cerrar sesión
<img width="969" height="757" alt="image" src="https://github.com/user-attachments/assets/dad81944-e70a-4e96-8f03-6af3214dc7b6" />


## 🔒 Características de Seguridad

- **Contraseñas hasheadas**: Uso de `password_hash()` con bcrypt
- **Prevención de inyección SQL**: Consultas preparadas con PDO
- **Validación de entrada**: Sanitización de todos los inputs
- **Manejo seguro de sesiones**: Configuración apropiada de cookies
- **Redirecciones seguras**: Prevención de accesos no autorizados
- **Validación dual**: Frontend y backend

## 📝 API/Endpoints

| Archivo | Método | Descripción |
|---------|--------|-------------|
| `index.php` | GET/POST | Página de login |
| `register.php` | GET/POST | Registro de usuarios |
| `auth.php` | POST | Procesamiento de autenticación |
| `dashboard.php` | GET | Panel de usuario (protegido) |
| `logout.php` | GET | Cierre de sesión |

## 🐛 Solución de Problemas

### Error de conexión a PostgreSQL
- Verifica que PostgreSQL esté ejecutándose
- Confirma las credenciales en `config/database.php`
- Asegúrate de que la extensión `pdo_pgsql` esté habilitada

### Login no funciona
- Verifica que el usuario existe en la base de datos
- Confirma que la contraseña sea correcta
- Revisa los logs de PHP para errores

### Páginas en blanco
- Activa la visualización de errores PHP
- Revisa los logs de Apache
- Verifica permisos de archivos

## 📊 Base de Datos

### Tabla `users`
| Campo | Tipo | Descripción |
|-------|------|-------------|
| `id` | SERIAL | Clave primaria autoincremental |
| `username` | VARCHAR(50) | Nombre de usuario único |
| `email` | VARCHAR(100) | Correo electrónico único |
| `password` | VARCHAR(255) | Contraseña hasheada con bcrypt |
| `created_at` | TIMESTAMP | Fecha de creación del registro |

## 🤝 Contribución

1. Haz fork del proyecto
2. Crea una rama para tu feature (`git checkout -b feature/nueva-caracteristica`)
3. Commit tus cambios (`git commit -am 'Agrega nueva característica'`)
4. Push a la rama (`git push origin feature/nueva-caracteristica`)
5. Abre un Pull Request

## 📄 Licencia

Este proyecto está bajo la Licencia MIT. Ver el archivo `LICENSE` para más detalles.

## 👨‍💻 Autor

**Diego Vallejo**
- GitHub: https://github.com/davallejo/prueba_presidencia/

## 🙏 Agradecimientos

- Inspirado en las mejores prácticas de seguridad web
- Desarrollado para fines educativos y de aprendizaje
- Contribuciones de la comunidad de desarrolladores PHP

---

⭐ Si este proyecto te fue útil, ¡dale una estrella en GitHub!

## 🔗 Enlaces Útiles

- [Documentación PHP](https://www.php.net/docs.php)
- [PostgreSQL Documentation](https://www.postgresql.org/docs/)
- [XAMPP Download](https://www.apachefriends.org/download.html)
- [Seguridad en PHP](https://www.php.net/manual/es/security.php)
