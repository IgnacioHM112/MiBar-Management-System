-- Configuración profesional de la Base de Datos para MiBar
CREATE DATABASE IF NOT EXISTS `restaurante` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `restaurante`;

-- Tabla de Usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL,
  `contraseña` varchar(50) NOT NULL,
  `Admin` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla de Menú (Unificada para Mañana y Tarde)
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `tipo` varchar(100) NOT NULL, -- Comida, Bebida, Postre
  `turno` enum('Mañana', 'Tarde') NOT NULL,
  `precio` decimal(10, 2) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Usuarios Iniciales
INSERT INTO `usuarios` (`usuario`, `contraseña`, `Admin`) VALUES
('admin', '12345', 1),
('visitante', '12345', 0);

-- Items de ejemplo: Mañana
INSERT INTO `menu` (`nombre`, `tipo`, `turno`, `precio`, `imagen`) VALUES
('Café Express', 'Bebida', 'Mañana', 250.00, 'cafe.jpeg'),
('Medialunas de Manteca', 'Comida', 'Mañana', 400.00, 'medialunas.jpeg'),
('Licuado de Banana', 'Bebida', 'Mañana', 550.00, 'licuado.jpeg'),
('Tostado Jamón y Queso', 'Comida', 'Mañana', 700.00, 'combo.jpeg');

-- Items de ejemplo: Tarde
INSERT INTO `menu` (`nombre`, `tipo`, `turno`, `precio`, `imagen`) VALUES
('Hamburguesa MiBar', 'Comida', 'Tarde', 1200.00, 'comida.jpeg'),
('Cerveza Artesanal', 'Bebida', 'Tarde', 600.00, 'bebida.jpeg'),
('Papas Fritas con Cheddar', 'Comida', 'Tarde', 850.00, 'combo 2.jpeg'),
('Flan Casero', 'Postre', 'Tarde', 500.00, 'postre.jpeg'),
('Pizza Especial', 'Comida', 'Tarde', 1500.00, 'combo 3.jpeg'),
('Gaseosa 500ml', 'Bebida', 'Tarde', 350.00, 'bebida.jpeg');
