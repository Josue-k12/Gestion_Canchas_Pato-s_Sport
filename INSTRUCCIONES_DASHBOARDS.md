# 🏟️ Sistema de Gestión de Canchas - Pato's Sport

## ✅ Correcciones Realizadas

### 1. **Error de Clase Conexion Resuelto**
- ✔️ Se corrigió el archivo `app/models/Conexion.php` 
- ✔️ Ahora tiene la clase `Conexion` correctamente definida
- ✔️ El método `conectar()` devuelve una conexión PDO funcional

### 2. **Modelo Usuario Creado**
- ✔️ Se creó `app/models/Usuario.php` con todos los métodos necesarios
- ✔️ Incluye: obtenerTodos(), obtenerPorId(), crear(), actualizar(), eliminar()
- ✔️ Gestión completa de usuarios y roles

### 3. **Sistema de Dashboards por Rol**
Se implementaron **3 dashboards diferentes** según el rol del usuario:

#### 🔴 **Dashboard Admin** (rol: 'admin')
- Estadísticas generales del sistema
- Gestión de reservas, canchas, usuarios y pagos
- Tablas de reservas recientes
- Acciones rápidas para crear contenido

#### 🟢 **Dashboard Cliente** (rol: 'cliente')
- Vista de sus reservas activas y completadas
- Timeline de próximas reservas
- Acceso rápido para crear nuevas reservas
- Ver canchas disponibles
- Sección de promociones

#### 🟡 **Dashboard Encargado** (rol: 'encargado')
- Agenda del día con todas las reservas
- Estado de las canchas (activas/mantenimiento)
- Gestión de reservas y horarios
- Alertas y recordatorios
- Pendientes de pago

### 4. **Navegación Dinámica por Rol**
El header (`app/views/layout/header.php`) ahora muestra:
- **Menú para Admin**: Reservas, Canchas, Usuarios, Pagos
- **Menú para Cliente**: Ver Canchas, Mis Reservas, Torneos
- **Menú para Encargado**: Gestionar Reservas, Estado Canchas, Horarios
- **Menú Público**: Servicios, Noticias, Torneos, Contacto (cuando no está logueado)

### 5. **Diseño Mantenido**
- ✔️ Se mantiene el diseño moderno con Bootstrap 5
- ✔️ Integración con AdminLTE 3.2 para los dashboards
- ✔️ Font Awesome y Bootstrap Icons
- ✔️ Colores corporativos: Verde #0fb29a y Oscuro #121821

---

## 🔐 Usuarios de Prueba

Para probar el sistema con los 3 roles:

| Rol | Email | Contraseña |
|-----|-------|------------|
| **Admin** | admin@patos.com | admin123 |
| **Cliente** | cliente@patos.com | cliente123 |
| **Encargado** | encargado@patos.com | encargado123 |

---

## 📋 Instrucciones de Instalación

### Paso 1: Importar Base de Datos
```bash
# En phpMyAdmin o línea de comandos MySQL:
1. Importar: database/sistema_canchas.sql
2. Ejecutar: database/actualizar_usuarios.sql
```

### Paso 2: Configurar Conexión
Verificar que `app/models/Conexion.php` tenga las credenciales correctas:
```php
private $host = "localhost";
private $db_name = "gestion_canchas";
private $username = "root";
private $password = "";
```

### Paso 3: Generar Contraseñas (Opcional)
Si necesitas regenerar las contraseñas hash:
```
http://localhost/Gestion_Canchas_Pato-s_Sport/generar_passwords.php
```

### Paso 4: Iniciar XAMPP
```bash
# Iniciar Apache y MySQL
1. Abrir XAMPP Control Panel
2. Start Apache
3. Start MySQL
```

### Paso 5: Acceder al Sistema
```
http://localhost/Gestion_Canchas_Pato-s_Sport/
```

---

## 📁 Estructura de Archivos Modificados

```
Gestion_Canchas_Pato-s_Sport/
│
├── app/
│   ├── models/
│   │   ├── Conexion.php          ✅ CORREGIDO - Clase creada
│   │   └── Usuario.php            ✅ NUEVO - Modelo completo
│   │
│   ├── views/
│   │   ├── home/
│   │   │   └── index.php          ✅ MODIFICADO - 3 dashboards + página pública
│   │   └── layout/
│   │       ├── header.php         ✅ MODIFICADO - Menús por rol
│   │       └── footer.php         ✅ MODIFICADO - Scripts AdminLTE
│   │
│   └── controllers/
│       └── AuthController.php     ✅ FUNCIONAL - Ya no da error
│
├── database/
│   ├── sistema_canchas.sql        ⚠️ Original (sin cambios)
│   └── actualizar_usuarios.sql    ✅ NUEVO - Script de actualización
│
└── generar_passwords.php          ✅ NUEVO - Generador de hashes
```

---

## 🎨 Características del Diseño

### Dashboard Admin
- Small boxes con estadísticas (AdminLTE)
- Tabla de reservas recientes
- Panel de gestión rápida
- Colores: info, success, warning, danger

### Dashboard Cliente
- Timeline de reservas (AdminLTE)
- Tarjetas de acciones rápidas
- Alertas de promociones
- Enfoque en usabilidad

### Dashboard Encargado
- Tabla de agenda del día
- Estado de canchas en tiempo real
- Alertas y recordatorios (callouts)
- Gestión operativa

---

## 🔧 Tecnologías Utilizadas

- **Backend**: PHP 8+
- **Base de Datos**: MySQL
- **Frontend**: 
  - Bootstrap 5.3
  - AdminLTE 3.2
  - Bootstrap Icons 1.11
  - Font Awesome 6
- **Servidor**: Apache (XAMPP)

---

## 📌 Notas Importantes

1. **Contraseñas**: Todas están hasheadas con `password_hash()` y `password_verify()`
2. **Sesiones**: El sistema usa `$_SESSION` para mantener el login
3. **Roles**: Se definen en la tabla `roles` de la BD
4. **Seguridad**: Validación de email y estado activo en login

---

## 🚀 Próximos Pasos Sugeridos

- [ ] Implementar los controladores completos (CanchaController, ReservaController, UsuarioController)
- [ ] Agregar validación de formularios con JavaScript
- [ ] Implementar sistema de pagos
- [ ] Crear vistas CRUD para canchas y reservas
- [ ] Añadir gráficos con Chart.js
- [ ] Sistema de notificaciones en tiempo real

---

## 📞 Soporte

Si encuentras algún error:
1. Verificar que XAMPP esté ejecutándose
2. Revisar que la base de datos esté importada
3. Verificar las credenciales en Conexion.php
4. Limpiar caché del navegador (Ctrl + F5)

---

**Desarrollado con ❤️ para Pato's Sport**
