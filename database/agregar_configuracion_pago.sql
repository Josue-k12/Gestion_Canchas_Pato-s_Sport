-- =====================================================
-- Agregar campos de configuración de pago
-- Fecha: 4 de febrero de 2026
-- =====================================================

-- Agregar columnas a la tabla configuracion
ALTER TABLE `configuracion` 
ADD COLUMN `numero_cuenta` VARCHAR(50) NULL DEFAULT NULL AFTER `valor_hora`,
ADD COLUMN `banco` VARCHAR(100) NULL DEFAULT NULL AFTER `numero_cuenta`,
ADD COLUMN `titular_cuenta` VARCHAR(150) NULL DEFAULT NULL AFTER `banco`,
ADD COLUMN `tipo_cuenta` VARCHAR(50) NULL DEFAULT NULL AFTER `titular_cuenta`,
ADD COLUMN `instrucciones_pago` TEXT NULL DEFAULT NULL AFTER `tipo_cuenta`,
ADD COLUMN `tiempo_validacion_horas` INT(11) DEFAULT 24 AFTER `instrucciones_pago`;

-- Actualizar la fila existente con los datos de configuración
UPDATE `configuracion` 
SET 
    `numero_cuenta` = '2009232010',
    `banco` = 'Banco del Pichincha',
    `titular_cuenta` = 'Pato\'s Sport',
    `tipo_cuenta` = 'Ahorros',
    `instrucciones_pago` = 'Realiza el pago al valor total mostrado. Adjunta la foto o PDF del comprobante de pago (obligatorio). Tu reserva quedará en estado "Pendiente de Validación".',
    `tiempo_validacion_horas` = 24
WHERE `id_confi` = 1;
