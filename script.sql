CREATE DATABASE unabdb;
GO
use unabdb;

-- Structure
GO
create table estudiantes(
	id bigint identity(1,1) PRIMARY KEY NOT NULL,
	nombre_completo [nvarchar](255) NOT NULL,
	carnet [nvarchar](255) NOT NULL,
	fecha_nacimiento datetime,
	created_at datetime NULL,
	updated_at datetime NULL,
);

create table materias(
	id bigint identity(1,1) PRIMARY KEY NOT NULL,
	nombre [nvarchar](255) NOT NULL,
	codigo [nvarchar](255) NOT NULL,
	created_at datetime NULL,
	updated_at datetime NULL,
);

create table matriculas(
	id bigint identity(1,1) NOT NULL,
	[id_estudiante] bigint NOT NULL,
	[id_materia] bigint NOT NULL,
	fecha datetime,
	created_at datetime NULL,
	updated_at datetime NULL,
	FOREIGN KEY([id_estudiante]) REFERENCES estudiantes([id]),
	FOREIGN KEY([id_materia]) REFERENCES materias ([id])
);

insert into estudiantes(nombre_completo,carnet, fecha_nacimiento) values('Raisa Ramírez','221413', GETDATE()),('Diana Ramírez','221513', GETDATE());
insert into materias(nombre, codigo) values('PHP', '123'),('Java','456');

-- VIEW
CREATE VIEW [student_card]
AS 
SELECT es.nombre_completo as 'Estudiante', es.carnet as 'Carnet', mat.nombre as 'Materia Inscrita', ma.fecha as 'Fecha de inscripción' FROM matriculas ma 
inner join estudiantes es on es.id = ma.id_estudiante 
inner join materias mat on mat.id=ma.id_materia;
