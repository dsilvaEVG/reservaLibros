-- Insertar nuevos alumnos
INSERT INTO Alumnos (nombreAlumno, DNIalumno, correo, idCurso) VALUES
('Laura Gómez', '55667788G', 'laura.gomez@ejemplo.com', 1),  -- 1º Bachillerato
('Javier Ruiz', '66778899H', 'javier.ruiz@ejemplo.com', 2),  -- 2º Bachillerato
('Marta Pérez', '77889900I', 'marta.perez@ejemplo.com', 1),  -- 1º Bachillerato
('Roberto Sánchez', '88990011J', 'roberto.sanchez@ejemplo.com', 2);  -- 2º Bachillerato

-- Insertar reservas para los nuevos alumnos (con más de un libro)
INSERT INTO Reservas (Fecha, Confirmacion, RutaJustificante, idAlumno) VALUES
('2024-11-07', FALSE, 'ruta/justificante7.pdf', 3),  -- Reserva de Laura Gómez
('2024-11-08', FALSE, 'ruta/justificante8.pdf', 4),  -- Reserva de Javier Ruiz
('2024-11-09', FALSE, 'ruta/justificante9.pdf', 5),  -- Reserva de Marta Pérez
('2024-11-10', FALSE, 'ruta/justificante10.pdf', 6);  -- Reserva de Roberto Sánchez

-- Insertar relación entre reservas y libros para los nuevos alumnos

-- Reserva de Laura Gómez (idReserva = 10, 1º Bachillerato)
INSERT INTO ReservasLibros (idReserva, ISBN, pedido, recibido) VALUES
(3, '9788441522221', FALSE, FALSE),  -- Laura Gómez reservó Ciencias Naturales
(3, '9788441522332', FALSE, FALSE),  -- Laura Gómez reservó Matemáticas 1º Bachillerato
(3, '9788441522443', FALSE, FALSE);  -- Laura Gómez reservó Historia de España

-- Reserva de Javier Ruiz (idReserva = 11, 2º Bachillerato)
INSERT INTO ReservasLibros (idReserva, ISBN, pedido, recibido) VALUES
(4, '9788420656789', FALSE, FALSE),  -- Javier Ruiz reservó Inglés 1º Bachillerato
(4, '9788420656890', FALSE, FALSE),  -- Javier Ruiz reservó Física y Química
(4, '9788420656901', FALSE, FALSE);  -- Javier Ruiz reservó Lengua Castellana y Literatura

-- Reserva de Marta Pérez (idReserva = 12, 1º Bachillerato)
INSERT INTO ReservasLibros (idReserva, ISBN, pedido, recibido) VALUES
(5, '9788441522221', FALSE, FALSE),  -- Marta Pérez reservó Ciencias Naturales
(5, '9788441522332', FALSE, FALSE);  -- Marta Pérez reservó Matemáticas 1º Bachillerato

-- Reserva de Pedro Sánchez (idReserva = 13, 2º Bachillerato)
INSERT INTO ReservasLibros (idReserva, ISBN, pedido, recibido) VALUES
(6, '9788420656789', FALSE, FALSE),  -- Roberto Sánchez reservó Inglés 1º Bachillerato
(6, '9788420656890', FALSE, FALSE);  -- Roberto Sánchez reservó Física y Química