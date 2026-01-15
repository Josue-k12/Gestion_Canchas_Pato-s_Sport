/* =====================================================
   BASE DE DATOS: Sistema de Gestión de Canchas Deportivas
   Rol: Arquitecto de BD y Backend
   ===================================================== */

-- 1. Crear base de datos
CREATE DATABASE IF NOT EXISTS gestion_canchas
CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci;



-- 2. Tabla de roles (Permisos del sistema)
CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE,
    descripcion VARCHAR(100)
);

-- 3. Tabla de usuarios (Login seguro)
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    rol_id INT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL, -- Longitud para encriptación Bcrypt
    estado ENUM('activo','inactivo') DEFAULT 'activo',
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (rol_id) REFERENCES roles(id)
);

-- 4. Tabla de canchas
CREATE TABLE canchas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    tipo VARCHAR(50), -- fútbol, básquet, tenis, etc.
    precio_hora DECIMAL(8,2) NOT NULL,
    estado ENUM('disponible','mantenimiento') DEFAULT 'disponible'
);

-- 5. Tabla de horarios
CREATE TABLE horarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    hora_inicio TIME NOT NULL,
    hora_fin TIME NOT NULL
);

-- 6. Tabla de reservas
CREATE TABLE reservas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    cancha_id INT NOT NULL,
    horario_id INT NOT NULL,
    fecha DATE NOT NULL,
    estado ENUM('reservada','cancelada','completada') DEFAULT 'reservada',
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (cancha_id) REFERENCES canchas(id),
    FOREIGN KEY (horario_id) REFERENCES horarios(id)
);

-- 7. Tabla de pagos
CREATE TABLE pagos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    reserva_id INT NOT NULL,
    monto DECIMAL(8,2) NOT NULL,
    metodo_pago VARCHAR(50),
    estado ENUM('pendiente','pagado') DEFAULT 'pendiente',
    fecha_pago TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (reserva_id) REFERENCES reservas(id)
);

-- 8. DATOS INICIALES (Semillas)
-- Roles base
INSERT INTO roles (nombre, descripcion) VALUES
('admin', 'Administrador del sistema'),
('cliente', 'Usuario que reserva canchas'),
('encargado', 'Encargado de las canchas');

-- Horarios base
INSERT INTO horarios (hora_inicio, hora_fin) VALUES
('08:00:00', '09:00:00'), ('09:00:00', '10:00:00'),
('10:00:00', '11:00:00'), ('11:00:00', '12:00:00'),
('12:00:00', '13:00:00'), ('13:00:00', '14:00:00'),
('14:00:00', '15:00:00'), ('15:00:00', '16:00:00'),
('16:00:00', '17:00:00'), ('17:00:00', '18:00:00');

-- 9. USUARIO ADMINISTRADOR POR DEFECTO
-- Email: admin@patos.com | Clave: admin123
INSERT INTO usuarios (rol_id, nombre, email, password) VALUES
(1, 'Admin Principal', 'admin@patos.com', '$2y$10$8WkK8n6K9kX5.bV9jF.eO.e3Q.Z6A6H/uA6m8yE2K5Y6p5Z6j5Z6y');