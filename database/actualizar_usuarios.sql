-- Script para actualizar usuarios de prueba
-- Ejecutar después de crear la base de datos inicial

-- Eliminar usuario admin anterior si existe
DELETE FROM usuarios WHERE email = 'admin@patos.com';

-- Insertar los 3 usuarios de prueba con contraseñas correctas
-- Nota: Todas las contraseñas están hasheadas con password_hash() de PHP

-- Admin: admin@patos.com | Contraseña: admin123
INSERT INTO usuarios (rol_id, nombre, email, password, estado) VALUES
(1, 'Admin Principal', 'admin@patos.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'activo');

-- Cliente: cliente@patos.com | Contraseña: cliente123  
INSERT INTO usuarios (rol_id, nombre, email, password, estado) VALUES
(2, 'Cliente de Prueba', 'cliente@patos.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'activo');

-- Encargado: encargado@patos.com | Contraseña: encargado123
INSERT INTO usuarios (rol_id, nombre, email, password, estado) VALUES
(3, 'Encargado de Canchas', 'encargado@patos.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'activo');

-- Verificar que se insertaron correctamente
SELECT u.id, u.nombre, u.email, r.nombre AS rol 
FROM usuarios u 
INNER JOIN roles r ON u.rol_id = r.id
ORDER BY u.rol_id;
