DROP DATABASE IF EXISTS peliculas;
CREATE DATABASE peliculas;
USE peliculas;

create table pelicula (id_pelicula int primary key auto_increment, titulo varchar(30) not null, autor varchar(30), resumen varchar (100), precio int, color_de_cd varchar(50));
insert into pelicula (titulo, autor, resumen, precio, color_de_cd) values ("Harry potter","JJRowlin", "Un maguito que hace trucos de magia", 1500, "verde"),
																			("Narnia", "Juancito", "El leon la bruja y el ropero", 1000, "azul"),
                                                                            ("IT","stephen King", "Un payaso que se come a los nenes", 1200, "rojo");