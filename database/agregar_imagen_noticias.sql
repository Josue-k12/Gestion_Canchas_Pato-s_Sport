-- =====================================================
-- Agregar campo de imagen a la tabla noticias
-- Fecha: 4 de febrero de 2026
-- =====================================================

-- Agregar columna de imagen a la tabla noticias
ALTER TABLE `noticias` 
ADD COLUMN `imagen` VARCHAR(255) NULL DEFAULT NULL AFTER `contenido`,
ADD COLUMN `descripcion` VARCHAR(500) NULL DEFAULT NULL AFTER `titulo`;

-- Insertar noticias de ejemplo
INSERT INTO `noticias` (`titulo`, `descripcion`, `contenido`, `imagen`, `autor`, `fecha_creacion`, `estado`) VALUES
('Sistema de Gestión en Línea', 'Ahora puedes reservar tus canchas desde cualquier dispositivo las 24 horas.', 'Implementamos un sistema de gestión en línea donde podrás reservar, pagar y administrar tus reservas de forma automática con confirmación inmediata.', 'noticia_sistema.jpg', 1, '2026-01-28 10:00:00', 'activa'),
('Mantenimiento de Césped Sintético', 'Estamos renovando la cancha principal para brindarte el mejor nivel de juego.', 'Durante los próximos días estaremos realizando mantenimiento especializado al césped sintético de nuestra cancha principal, garantizando la mejor experiencia deportiva.', 'noticia1.jpeg', 1, '2026-01-07 08:30:00', 'activa'),
('Nueva Iluminación LED Profesional', 'Iluminación de última generación para partidos nocturnos de alta calidad.', 'Instalamos iluminación LED profesional que cumple con estándares internacionales, permitiendo partidos nocturnos con excelente visibilidad y ahorro energético.', 'noticia2.jpeg', 1, '2026-01-05 14:20:00', 'activa'),
('Horarios Extendidos Fines de Semana', 'Ahora abrimos desde las 6:00 AM hasta las 11:00 PM los sábados y domingos.', 'Por alta demanda, extendemos nuestros horarios los fines de semana para que disfrutes más tiempo con tu equipo. ¡Aprovecha y reserva tu horario favorito!', 'noticia_horarios.jpg', 1, '2026-01-15 09:00:00', 'activa');
