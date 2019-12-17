DROP DATABASE IF EXISTS persona;
CREATE DATABASE persona;
USE persona;

create table persona (id int auto_increment primary key, nombre varchar(50), apellido varchar(50), direccion varchar(100), mail varchar(50), edad int, fecha_nacimiento datetime, img varchar(500));

select * from persona