CREATE TABLE Users (
	nombre VARCHAR(30) NOT NULL,
    apellido VARCHAR(30) NOT NULL,
    email VARCHAR(50) NOT NULL PRIMARY KEY,
    passwrd VARCHAR(50) NOT NULL
    
);

INSERT INTO Users(nombre, apellido, email, passwrd)
VALUES  ('Arturo', 'Lopez', 'arlopf95@gmail.com', 'dawver17'),
		('Chuck', 'Liddell', 'iceman@gmail.com', 'iceman123'),
		('Jacob', 'Ortiz', 'tito_ortiz@gmail.com', 'titoortiz');


CREATE TABLE Libros (
	idLibro INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	titulo VARCHAR (50) NOT NULL,
	autorNombre VARCHAR (50) NOT NULL, 
	autorApellido VARCHAR (50) NOT NULL,
	genero VARCHAR (50) NOT NULL, 
	anio VARCHAR (50) NOT NULL
);

INSERT INTO Libros(titulo, autorNombre, autorApellido, genero, anio)
VALUES 	('IT', 					'Stephhen', 'King', 		'Suspenso', 	'1986'), 
		('El Alquimista', 		'Paulo', 	'Coelho', 		'Aventuras', 	'1988'),
		('El Psicoanalista', 	'John', 	'Katzenbach', 	'Suspenso', 	'2002'),
		('La Cabaña', 			'William', 	'Young', 		'Ficcion', 		'2007'),
		('Luz', 				'Elisabet', 'Riera', 		'Aventuras', 	'2017');