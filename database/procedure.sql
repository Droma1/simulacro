CREATE DATABASE simulacro
    CHARACTER SET utf8
    COLLATE utf8_spanish_ci;
use simulacro;

create table postulante(
id int primary key auto_increment,
nombre varchar(100) not null,
apellido_p varchar(100) not null,
apellido_m varchar(100) not null,
documento int(9) not null,
phone int not null
);

create table nivel(
id int primary key auto_increment,
nivel varchar(100) not null,
id_postulante int not null,
foreign key(id_postulante) references postulante(id)
);
create table carrera(
id int primary key auto_increment,
codigo varchar(2) not null,
n_carrera varchar(300) not null,
id_postulante int not null,
foreign key(id_postulante) references postulante(id)
);
alter table carrera add tema varchar(1);
create table grado(
id int primary key auto_increment,
n_grado varchar(100) not null,
id_postulante int not null,
foreign key(id_postulante) references postulante(id)
);

create table region_registro(
id int primary key auto_increment,
n_region varchar(100),
id_postulante int not null,
foreign key(id_postulante) references postulante(id)
);

drop table region_registro;
drop table region;
alter table postulante add cod_postulante bigint;
alter table postulante add f_registro timestamp;

alter table carrera drop column codigo;
/*create table provincia(
id int primary key auto_increment,
n_provincia varchar(100) not null
);*/
create table provincia_registro(
id int primary key auto_increment,
n_provincia varchar(100) not null,
id_postulante int not null,
foreign key(id_postulante) references postulante(id)
);
create table ie(
id int primary key auto_increment,
n_ie varchar(300) not null,
id_postulante int not null,
foreign key(id_postulante) references postulante(id)
);

drop table provincia;

select * from carrera;
select * from postulante;















create view listar_registro as
select nombre, apellido_p, apellido_m, documento, phone, cod_postulante, f_registro, n_carrera, tema, nivel, n_grado, n_region, n_provincia, n_ie
from postulante, carrera, nivel, grado, region_registro, provincia_registro, ie
where carrera.id_postulante = postulante.id and nivel.id_postulante = postulante.id and grado.id_postulante = postulante.id and region_registro.id_postulante = postulante.id and provincia_registro.id_postulante = postulante.id and ie.id_postulante = postulante.id;


select * from listar_registro;

/***************************/
CREATE DEFINER=`root`@`localhost` PROCEDURE `inscripcion`(
in nombre_ varchar(200),
in apellido_p_ varchar(200),
in apellido_m_ varchar(200),
in documento_ int(9),
in carrera_ varchar(100),
in cel_ int(9),
in nivel_ varchar(100),
in grado_ varchar(100),
in region_ varchar(100),
in provincia_ varchar(100),
in ie_select varchar(200),
in f_registro_ timestamp,
in flag_ int(1)
)
BEGIN

insert into postulante(nombre, apellido_p, apellido_m, documento, phone, cod_postulante, f_registro)
values(upper(nombre_), upper(apellido_p_), upper(apellido_m_), documento_, cel_, "", f_registro_);


SET @id_ = LAST_INSERT_ID();

update postulante set cod_postulante = (8000000 + @id_) where id = @id_;
insert into carrera(n_carrera, id_postulante) values(upper(carrera_), @id_);
insert into nivel(nivel, id_postulante) values(upper(nivel_), @id_);
insert into grado(n_grado, id_postulante) values(upper(grado_), @id_);
insert into region_registro(n_region, id_postulante) values(upper(region_), @id_);
insert into provincia_registro(n_provincia, id_postulante) values(upper(provincia_), @id_);
insert into ie (n_ie, id_postulante) values(upper(ie_select), @id_);

select "exito";
END