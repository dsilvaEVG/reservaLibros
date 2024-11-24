CREATE TABLE Fechas (
    fechaInicio DATE NOT NULL,
    fechaFin DATE NOT NULL,
    
    CONSTRAINT PK_Fechas PRIMARY KEY (fechaInicio),
    CONSTRAINT CH_Fechas_fechaFin CHECK (fechaFin >= fechaInicio) 
);

CREATE TABLE UsuariosPermisos (
    idAdmin SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    nombreAdmin CHAR(20) NOT NULL,
    contrasenia CHAR(8) NOT NULL,
    tipo CHAR(5) NOT NULL DEFAULT 'SECRE', -- SECRE  ADMIN
    CONSTRAINT PK_UsuariosPermisos PRIMARY KEY (idAdmin)
);

CREATE TABLE Padres (
    idPadre SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    nomPadre VARCHAR(60) NOT NULL,
    DNI CHAR(9) NOT NULL,

    CONSTRAINT PK_Padres PRIMARY KEY (idPadre),
    CONSTRAINT UQ_Padres_DNI UNIQUE (DNI)
);

CREATE TABLE Tutores (
    idTutor TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(60) NOT NULL,
    correo VARCHAR(100) NOT NULL CHECK (correo LIKE '%@%'),

    CONSTRAINT PK_Tutores PRIMARY KEY (idTutor)
);

CREATE TABLE Editorial (
    idEditorial TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    nomEditorial VARCHAR(60) NOT NULL,

    CONSTRAINT PK_Editorial PRIMARY KEY (idEditorial)
);

CREATE TABLE Libros (
    ISBN CHAR(13) NOT NULL,
    titulo VARCHAR(50) NOT NULL,
    precio DECIMAL(4,2) NOT NULL,
    idEditorial TINYINT UNSIGNED NOT NULL,

    CONSTRAINT PK_Libros PRIMARY KEY (ISBN),
    CONSTRAINT FK_Libros_Editorial FOREIGN KEY (idEditorial) REFERENCES Editorial(idEditorial)
);

CREATE TABLE Cursos (
    idCurso TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    nombreCurso VARCHAR(60) NOT NULL,
    Tipo CHAR(1) NULL,
    idTutor TINYINT UNSIGNED NOT NULL,

    CONSTRAINT PK_Cursos PRIMARY KEY (idCurso),
    CONSTRAINT FK_Cursos_Tutores FOREIGN KEY (idTutor) REFERENCES Tutores(idTutor),
    CONSTRAINT UQ_Tutor UNIQUE (idTutor)
);

CREATE TABLE Alumnos (
    idAlumno SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    nombreAlumno VARCHAR(60) NOT NULL,
    DNIalumno CHAR(9) NULL,
    correo VARCHAR(100) NOT NULL CHECK (correo LIKE '%@%'),
    idCurso TINYINT UNSIGNED NOT NULL,

    CONSTRAINT PK_Alumnos PRIMARY KEY (idAlumno),
    CONSTRAINT FK_Alumnos_Cursos FOREIGN KEY (idCurso) REFERENCES Cursos(idCurso) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE PadresAlumnos (
    idAlumno SMALLINT UNSIGNED NOT NULL,
    idPadre SMALLINT UNSIGNED NOT NULL,

    CONSTRAINT PK_PadresAlumnos PRIMARY KEY (idAlumno, idPadre),
    CONSTRAINT FK_PadresAlumnos_Alumnos FOREIGN KEY (idAlumno) REFERENCES Alumnos(idAlumno),
    CONSTRAINT FK_PadresAlumnos_Padres FOREIGN KEY (idPadre) REFERENCES Padres(idPadre)
);

CREATE TABLE LibrosCursos (
    idCurso TINYINT UNSIGNED NOT NULL,
    ISBN CHAR(13) NOT NULL,

    CONSTRAINT PK_LibrosCursos PRIMARY KEY (idCurso, ISBN),
    CONSTRAINT FK_LibrosCursos_Cursos FOREIGN KEY (idCurso) REFERENCES Cursos(idCurso),
    CONSTRAINT FK_LibrosCursos_Libros FOREIGN KEY (ISBN) REFERENCES Libros(ISBN) ON UPDATE CASCADE
);

CREATE TABLE Reservas (
    idReserva SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    Fecha DATE NOT NULL,
    Confirmacion BOOLEAN NOT NULL DEFAULT false,
    RutaJustificante VARCHAR(250) NOT NULL,
    idAlumno SMALLINT UNSIGNED NOT NULL,

    CONSTRAINT PK_Reservas PRIMARY KEY (idReserva),
    CONSTRAINT FK_Reservas_Alumnos FOREIGN KEY (idAlumno) REFERENCES Alumnos(idAlumno) ON DELETE CASCADE
);

CREATE TABLE ReservasLibros (
    idReserva SMALLINT UNSIGNED NOT NULL,
    ISBN CHAR(13) NOT NULL,
    pedido BOOLEAN NOT NULL DEFAULT false,
    recibido BOOLEAN NOT NULL DEFAULT false,
    fechaEntrega DATE NULL,

    CONSTRAINT PK_ReservasLibros PRIMARY KEY (idReserva, ISBN),
    CONSTRAINT FK_ReservasLibros_Reservas FOREIGN KEY (idReserva) REFERENCES Reservas(idReserva) ON DELETE CASCADE,
    CONSTRAINT FK_ReservasLibros_Libros FOREIGN KEY (ISBN) REFERENCES Libros(ISBN)
);

CREATE TABLE Pedidos (
    idPedido SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,  
    idEditorial TINYINT UNSIGNED NOT NULL,               
    fechaPedido DATE NOT NULL,                           
    PRIMARY KEY (idPedido),                              
    FOREIGN KEY (idEditorial) REFERENCES Editorial(idEditorial)  
);

CREATE TABLE LibrosPedidos (
    idPedido SMALLINT UNSIGNED NOT NULL,   
    ISBN CHAR(13) NOT NULL,                
    cantidadLibros SMALLINT UNSIGNED NOT NULL,  
    PRIMARY KEY (idPedido, ISBN),               
    FOREIGN KEY (idPedido) REFERENCES Pedidos(idPedido),  
    FOREIGN KEY (ISBN) REFERENCES Libros(ISBN)  
);

INSERT INTO Fechas (fechaInicio, fechaFin) VALUES ('2023-01-01', '2023-12-31');

INSERT INTO UsuariosPermisos (nombreAdmin, contrasenia, tipo) VALUES
('administracion', '1234', 'ADMIN'),
('secretaria', '1234', 'SECRE');

INSERT INTO Padres (nomPadre, DNI) VALUES
('Juan Perez', '12345678A'),
('Maria Lopez', '23456789B');

INSERT INTO Tutores (nombre, correo) VALUES
('Isabel', 'imunoz@example.com'),
('Ernesto', 'egonzalez@example.com'),
('Alberto', 'albertodominguez@example.com'),
('Paco', 'fgarcia@example.com'),
('Santiago', 'svazquez@example.com');

INSERT INTO Editorial (nomEditorial) VALUES
('Santillana'),
('Anaya'),
('Oxford'),
('Edelvives'),
('Bruño');

INSERT INTO Libros (ISBN, titulo, precio, idEditorial) VALUES
('9781234567890', 'Libro1', 19.99, 1),
('9781234567891', 'Libro2', 29.99, 2),
('9781234567892', 'Libro3', 39.99, 3),
('9781234567893', 'Libro4', 19.99, 4),
('9781234567894', 'Libro5', 29.99, 5),
('9781234567895', 'Libro6', 24.99, 1),
('9781234567896', 'Libro7', 34.99, 1),
('9781234567897', 'Libro8', 44.99, 1),
('9781234567898', 'Libro9', 24.99, 1),
('9781234567899', 'Libro10', 14.99, 1);

INSERT INTO Cursos (nombreCurso, Tipo, idTutor) VALUES
('1º Bachillerato', 'A', 1),
('1º Bachillerato', 'B', 2),
('2º Bachillerato', 'A', 3);
INSERT INTO Cursos (nombreCurso, idTutor) VALUES
('1º Desarrollo de Aplicaciones Web', 4),
('2º Desarrollo de Aplicaciones Web', 5);

INSERT INTO Alumnos (nombreAlumno, DNIalumno, correo, idCurso) VALUES
('Pablo Caldito', '33333333C', 'pcaldito@example.com', 5),
('Jose Luis del Valle', '44444444D', 'jldvalle@example.com', 5);

INSERT INTO Alumnos (nombreAlumno, correo, idCurso) VALUES
('David Silva', 'papadsilva@example.com', 4),
('Ismael Paz', 'papaipaz@example.com', 4);

INSERT INTO PadresAlumnos (idAlumno, idPadre) VALUES
(3, 1),
(4, 2),
(3, 3),
(4, 4),
(5, 5);

INSERT INTO LibrosCursos (idCurso, ISBN) VALUES
(1, '9781234567890'),
(2, '9781234567891'),
(3, '9781234567892'),
(4, '9781234567893'),
(5, '9781234567894');

INSERT INTO Reservas (Fecha, RutaJustificante, idAlumno) VALUES
('2023-06-01', 'ruta1.pdf', 1),
('2023-06-02', 'ruta2.pdf', 2),
('2023-06-03', 'ruta3.pdf', 3),
('2023-06-04', 'ruta4.pdf', 4),
('2023-06-05', 'ruta5.pdf', 5);

INSERT INTO ReservasLibros (idReserva, ISBN) VALUES
(1, '9781234567890'),
(1, '9781234567891'),
(2, '9781234567892'),
(2, '9781234567893'),
(3, '9781234567894'),
(3, '9781234567890'),
(4, '9781234567891'),
(4, '9781234567892'),
(5, '9781234567893'),
(5, '9781234567894');