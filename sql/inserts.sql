-- Inserts editoriales
INSERT INTO Editorial (nomEditorial) 
VALUES 
    ('Anaya'),
    ('Oxford'),
    ('Santillana');

-- Insertar libros para la editorial Anaya (idEditorial = 1)
INSERT INTO Libros (ISBN, titulo, precio, idEditorial) VALUES
('9788441522221', 'Ciencias Naturales', 25.50, 1),
('9788441522332', 'Matemáticas 1º Bachillerato', 20.00, 1),
('9788441522443', 'Historia de España', 22.00, 1);

-- Insertar libros para la editorial Oxford (idEditorial = 2)
INSERT INTO Libros (ISBN, titulo, precio, idEditorial) VALUES
('9788420656789', 'Inglés 1º Bachillerato', 18.50, 2),
('9788420656890', 'Física y Química', 19.75, 2),
('9788420656901', 'Lengua Castellana y Literatura', 21.00, 2);

-- Insertar libros para la editorial Santillana (idEditorial = 3)
INSERT INTO Libros (ISBN, titulo, precio, idEditorial) VALUES
('9788498765234', 'Geografía 2º Bachillerato', 23.00, 3),
('9788498765345', 'Ciencias Sociales', 20.50, 3),
('9788498765456', 'Filosofía 1º Bachillerato', 19.00, 3);

-- Insertar tutores
INSERT INTO Tutores (nombre, correo) VALUES
('Juan Pérez', 'juan.perez@ejemplo.com'),
('Ana Gómez', 'ana.gomez@ejemplo.com');

-- Insertar cursos (relacionados con tutores)
INSERT INTO Cursos (nombreCurso, idTutor) VALUES
('1º Bachillerato', 1),  -- 1º Bachillerato, tutor Juan Pérez
('2º Bachillerato', 2);  -- 2º Bachillerato, tutor Ana Gómez

-- Insertar relación entre libros y cursos
-- Relacionamos los libros con los cursos
INSERT INTO LibrosCursos (idCurso, ISBN) VALUES
(1, '9788441522221'),  -- Ciencias Naturales para 1º Bachillerato
(1, '9788441522332'),  -- Matemáticas 1º Bachillerato
(1, '9788441522443'),  -- Historia de España para 1º Bachillerato
(2, '9788420656789'),  -- Inglés 1º Bachillerato para 2º Bachillerato
(2, '9788420656890'),  -- Física y Química para 2º Bachillerato
(2, '9788420656901');  -- Lengua Castellana y Literatura para 2º Bachillerato

-- Insertar alumnos
INSERT INTO Alumnos (nombreAlumno, DNIalumno, correo, idCurso) VALUES
('Carlos López', '12345678A', 'carlos@ejemplo.com', 1),  -- 1º Bachillerato
('María Fernández', '87654321B', 'maria@ejemplo.com', 2);  -- 2º Bachillerato

-- Insertar reservas
INSERT INTO Reservas (Fecha, Confirmacion, RutaJustificante, idAlumno) VALUES
('2024-11-01', FALSE, 'ruta/justificante1.pdf', 1),  -- Reserva de Carlos López
('2024-11-02', FALSE, 'ruta/justificante2.pdf', 2);  -- Reserva de María Fernández

-- Insertar relación entre reservas y libros
INSERT INTO ReservasLibros (idReserva, ISBN, pedido, recibido) VALUES
(1, '9788441522221', FALSE, FALSE),  -- Carlos López reservó Ciencias Naturales
(1, '9788441522332', FALSE, FALSE),  -- Carlos López reservó Matemáticas 1º Bachillerato
(2, '9788420656789', FALSE, FALSE),  -- María Fernández reservó Inglés 1º Bachillerato
(2, '9788420656890', FALSE, FALSE);  -- María Fernández reservó Física y Química
