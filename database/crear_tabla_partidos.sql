-- Tabla de partidos/torneos
CREATE TABLE IF NOT EXISTS partidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cancha_id INT NOT NULL,
    equipo1_id INT NULL,
    equipo2_id INT NULL,
    fecha DATE NOT NULL,
    hora_inicio TIME NOT NULL,
    hora_fin TIME NOT NULL,
    tipo ENUM('amistoso', 'torneo', 'liga', 'campeonato') DEFAULT 'amistoso',
    estado ENUM('programado', 'en_curso', 'finalizado', 'cancelado') DEFAULT 'programado',
    resultado VARCHAR(50) NULL,
    observaciones TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (cancha_id) REFERENCES canchas(id) ON DELETE CASCADE,
    FOREIGN KEY (equipo1_id) REFERENCES usuarios(id) ON DELETE SET NULL,
    FOREIGN KEY (equipo2_id) REFERENCES usuarios(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insertar algunos partidos de ejemplo
INSERT INTO partidos (cancha_id, equipo1_id, equipo2_id, fecha, hora_inicio, hora_fin, tipo, estado, resultado) VALUES
(1, 1, 2, '2026-01-20', '18:00:00', '19:30:00', 'amistoso', 'programado', NULL),
(2, 1, 2, '2026-01-22', '20:00:00', '21:30:00', 'torneo', 'programado', NULL),
(1, 1, 2, '2026-01-15', '17:00:00', '18:30:00', 'amistoso', 'finalizado', '3 - 2'),
(3, 1, 2, '2026-01-25', '19:00:00', '20:30:00', 'liga', 'programado', NULL);
