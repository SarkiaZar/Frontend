-- Crear la base de datos si no existe
CREATE DATABASE IF NOT EXISTS programacion_front_back;
USE programacion_front_back;

-- Crear tabla de servicios
CREATE TABLE IF NOT EXISTS servicios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT NOT NULL,
    icono VARCHAR(50) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insertar datos iniciales
INSERT INTO servicios (nombre, descripcion, icono) VALUES
('Consultoría Digital', 'Asesoramiento especializado en transformación digital para empresas', 'fa-lightbulb'),
('Soluciones Multiexperiencia', 'Desarrollo de aplicaciones multiplataforma para una experiencia de usuario óptima', 'fa-mobile-alt'),
('Evolución de Ecosistemas', 'Modernización y optimización de sistemas empresariales existentes', 'fa-network-wired'),
('Soluciones Low-Code', 'Desarrollo rápido de aplicaciones con plataformas de bajo código', 'fa-code'); 