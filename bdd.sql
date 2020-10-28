create database MP;

use MP;

drop database MP;

-- #######################################  PERFILUSERS  ##############################################

create table perfilUsers(
    id_perfil integer auto_increment primary key,
    user_name varchar(20) unique not null,
    firstName varchar(30) not null,
    lastName varchar(30) not null,
    dni integer unique not null
);

-- drop table perfilUsers;
select * from perfilusers;

-- #######################################  ROL  ##############################################

create table rol(
    id_rol int primary key,
    name_description varchar(20) unique not null
);

/*drop table rol;*/
select * from rol;

-- #######################################  USERS  ##############################################

create table users(
id_user integer auto_increment primary key,
email varchar(30) not null,
password varchar (20) not null,
id_perfilUser integer not null,
id_rol integer not null,
constraint fk_id_perfilUser foreign key(id_perfilUser) references perfilUsers(id_perfil),
constraint fk_id_rol foreign key(id_rol) references rol(id_rol));

/*drop table users;*/
select * from users;

insert into rol(id_rol,name_description) values(1,'CLIENTE'),(2,'ADMINISTRADOR');
select * from rol;
insert into perfilusers(user_name,firstName,lastName,dni) value('Rodri_07','Rodrigo','Villarroel',39809917);
insert into users(email,password,id_perfilUser,id_rol) value('rodrigo_villarroel@outlook.com',123456,1,2);

select * from perfilusers;
select * from users;

delete from perfilusers;

-- #######################################  Movies  ##############################################

create table Movies(
    id_Movie integer primary key,
    title_Movie varchar(100),
    image blob,
    lenght int,
    lenguage varchar(20)
);

/*drop table Movies;*/
select * from movies;
truncate table movies;

-- #######################################  Genders  ##############################################

create table Genders(
    id_Gender integer primary key,
    name_Gender varchar(20)
);

/*drop table Genders;*/
select * from Genders;
truncate table genders;

-- #######################################  GendersXMovies  ##############################################

create table GendersXMovies(
    id_Gender integer,
    id_Movie integer,
    constraint pk_GendersXMovies primary key(id_Movie,id_Gender),
    constraint fk_id_Gender foreign key(id_Gender) references Genders(id_Gender),
    constraint fk_id_Movie foreign key(id_Movie) references Movies(id_Movie)
);

/*drop table GendersXMovies;*/
select * from GendersXMovies;
truncate table gendersxmovies;

-- #######################################  Cinemas  ##############################################

Create table Cinemas(
    id_cinema integer auto_increment primary key,
    adress varchar(30) not null,
    name varchar(40) not null,
    price_ticket integer not null
);

/*drop table Cinemas;*/
select * from Cinemas;

truncate table cinemas;

select count(id_cinema) from Cinemas;


/*SELECT c.capacity from cinemas c - count(t.nro_entrada) FROM Ticket t JOIN Showings s ON s.id_Showing = t.id_Showing WHERE (s.id_Showing = :id_Showing);*/

-- #######################################  Room  ##############################################

create table Room(
idRoom integer auto_increment primary key,
nombre varchar(20) not null,
capacidad integer not null,
id_Cine integer not null,
constraint foreign key fk_id_Cine(id_Cine) references Cinemas(id_cinema)
);

-- drop table room;
select * from Room;


-- #######################################  Turns  ##############################################

create table Turns(
id_turno integer auto_increment primary key,
hr_start time not null,
hr_finish time not null);

select * from turns;
-- drop table turns;

insert into turns(hr_start,hr_finish) values ('14:00','16:30'),('16:45','19:15'),('19:30','22:00'),('22:15','00:45');


-- #######################################  Showings  ##############################################

create table Showings(
    id_Showing integer auto_increment primary key,
    day date not null,
    id_turno integer,
    idMovie integer,
	idRoom integer,
    constraint fk_id_turno foreign key(id_turno) references turns(id_turno),
    constraint fk_id_Room foreign key(idRoom) references Room(idRoom),
    constraint fk_id_Movie foreign key(idMovie) references Movies(id_Movie)
);

-- drop table Showings;
select * from showings;

-- #######################################  Ticket  ##############################################

create table Ticket(
nro_entrada integer auto_increment primary key,
qr varchar(30) not null,
id_Showing integer not null,
id_Buy integer not null,
constraint fk_id_Showing foreign key(id_Showing) references showings(id_Showing),
constraint fk_id_Buy foreign key(id_Buy) references Buy(id_Buy)
);

-- drop table ticket;
select * from ticket;
select count(nro_entrada) from ticket where ticket.id_Showing =1;

-- #######################################  Buy  ##############################################


create table Buy(
id_Buy integer auto_increment primary key,
quantity_ticket int not null,
discount float not null,
days date,
total integer,
id_Pay integer,
id_User integer not null,
constraint fk_id_Pay foreign key(id_Pay) references PayTC(id_Pay),
constraint fk_id_User foreign key(id_User) references users(id_user)
);

-- drop table buy;

select *from buy b;

select sum(select b.total from buy b
inner join ticket t
on b.id_Buy = t.id_Buy
where t.id_Showing = 1
group by b.id_Buy) as suma from t; 

select * from Buy b
 inner join ticket t
 on b.id_Buy = t.id_Buy
 inner join showings s
 on s.id_Showing = t.id_Showing
where s.id_Showing = 1;

-- #######################################  CreditAccount  ##############################################

create table CreditAccount(
id_CreditAccount integer primary key,
company varchar(50));

drop table CreditAccount;
-- #######################################  PayTC  ##############################################


create table PayTC(
id_Pay integer auto_increment primary key,
cod_aut integer not null,
days date not null,
total float not null,
id_CreditAccount integer not null,
constraint fk_id_CreditAccount foreign key(id_CreditAccount) references CreditAccount(id_CreditAccount)
);

select * from paytc;

drop table paytc;



drop procedure `CountQuantityForMovieXTurnXCinema`;
DELIMITER //
CREATE PROCEDURE `CountQuantityForMovieXTurnXCinema` (in movie int,in turn int,in roomm int)
BEGIN
    select r.capacidad - count(t.nro_entrada) as cant from Showings s
	inner join Ticket t
	on s.id_Showing = t.id_Showing
    inner join room r
    on r.idRoom = s.idRoom
	where s.idMovie = movie and s.id_turno = turn and s.idRoom = roomm;
END //

call CountQuantityForMovieXTurnXCinema(475557,1,1);


DELIMITER //
CREATE PROCEDURE `CountQuantity` (in idShowing int)
BEGIN
    select r.capacidad - count(t.nro_entrada) as cant from Showings s
	inner join Ticket t
	on s.id_Showing = t.id_Showing
    inner join room r
    on r.idRoom = s.idRoom
	where s.id_Showing = 1;
END //


DELIMITER //
CREATE PROCEDURE `Total` (in idShowing int)
BEGIN
    select sum(b.total) as total from buy b
	inner join Ticket t
	on b.id_Buy = t.id_Buy
	where t.id_Showing = 1;
END //



call CountQuantity(2);


select ifnull(m.id_Movie,'a') as id from Movies m
where m.id_Movie = 475557;

select r.capacidad - count(t.nro_entrada) as cant from Showings s
	inner join Ticket t
	on s.id_Showing = t.id_Showing
    inner join room r
    on r.idRoom = s.idRoom
	where s.idMovie = 475557 and s.id_turno = 1 and s.idRoom = 1;

call CountQuantityForMovieXTurnXCinema(475557,1,1);

select * from Showings;

insert into rol(id_rol,name_description) values (1,'CLIENT'),(2,'ADMINISTRATOR');

insert into perfilusers(user_name,firstName,lastName,dni) value('ADMIN','Rodrigo','Villarroel',39809917);
insert into users(email,password,id_rol,id_perfilUser) value('rodrigo_villarroel@outlook.com',123456,2,2);

select * from users;
select * from perfilUsers;
select * from rol;

select * from movies;
select * from genders;
select * from gendersxmovies;
select * from cinemas;
select * from Showings;



select * from Cine;
select * from Salas;



/*drop table movies;*/
/*drop table genders;*/
/*drop table gendersxmovies;*/

select * from Movies;
select * from Genders;
select * from GendersXMovies;

select c.capacity from cinemas c;

select count(t.nro_entrada) 
from ticket t
inner join showings s
on s.id_Showing = t.id_Showing
where s.id_Showing =2;

drop procedure `CountQuantityForMovie`;

DELIMITER //
CREATE PROCEDURE `CountQuantityForMovie` (in Valuee int)
BEGIN
	select count(t.nro_entrada) from Ticket t
	inner join Showings s
	on s.id_Showing = t.id_Showing 
	where s.idMovie = Valuee;
END //

DELIMITER //
CREATE PROCEDURE `CountQuantityForCinema` (in Valuee int)
BEGIN
	select count(t.nro_entrada) from Ticket t
	inner join Showings s
	on s.id_Showing = t.id_Showing 
	where s.idCine = Valuee;
END //

DELIMITER //
CREATE PROCEDURE `CountQuantityForTurn` (in Valuee int)
BEGIN
	select count(t.nro_entrada) from Ticket t
	inner join Showings s
	on s.id_Showing = t.id_Showing 
	where s.id_turno = Valuee;
END //



call CountQuantityForMovie(475557);
call CountQuantityForCinema(1);
call CountQuantityForTurn(1);

DELIMITER //
CREATE PROCEDURE `CountMoneyForMovie` (in Valuee int)
BEGIN
    select sum(b.total) from buy b
	inner join ticket t
	on t.id_Buy = b.id_Buy 
	inner join showings s
	on t.id_Showing = s.id_Showing
	where s.idMovie = valuee;
END //
-- --------------------------------------------------------------------------------


-- ---------------------------------------------------------------------------------

call CountQuantityForMovieXTurnXCinema(475557,1,1);
		select * from ticket;
        
        
DELIMITER //
CREATE PROCEDURE `CountMoneyForCinema` (in Valuee int)
BEGIN
    select sum(b.total) from buy b
	inner join ticket t
	on t.id_Buy = b.id_Buy 
	inner join showings s
	on t.id_Showing = s.id_Showing
	where s.idCine = valuee;
END //

DELIMITER //
CREATE PROCEDURE `CountMoneyForTurn` (in Valuee int)
BEGIN
    select sum(b.total) from buy b
	inner join ticket t
	on t.id_Buy = b.id_Buy 
	inner join showings s
	on t.id_Showing = s.id_Showing
	where s.id_turno = valuee;
END //


call CountMoneyForMovie(475557);
call CountMoneyForCinema(1);
call CountMoneyForTurn(4);

select count(t.nro_entrada) from ticket t
inner join showings s
on s.id_Showing = t.id_Showing 
where s.idMovie = 475557;

select count(t.nro_entrada) from ticket t
inner join showings s
on s.id_Showing = t.id_Showing 
where s.idCine = 2;

select count(t.nro_entrada) from ticket t
inner join showings s
on s.id_Showing = t.id_Showing 
where s.id_turno = 3;

select sum(b.total) from buy b
inner join ticket t
on t.id_Buy = b.id_Buy 
inner join showings s
on t.id_Showing = s.id_Showing
where s.idMovie = 475557;

select sum(b.total) from buy b
inner join ticket t
on t.id_Buy = b.id_Buy 
inner join showings s
on t.id_Showing = s.id_Showing
where s.idCine = 1;

select sum(b.total) from buy b
inner join ticket t
on t.id_Buy = b.id_Buy 
inner join showings s
on t.id_Showing = s.id_Showing
where s.id_turno = 1;

select t.nro_entrada,t.qr,s.day,c.namee,c.adress,m.title_Movie,tur.hr_start 
from ticket t
inner join showings s 
on s.id_Showing = t.id_Showing
inner join cinemas c
on s.idCine = c.id_cinema
inner join movies m
on m.id_Movie = s.idMovie
inner join turns tur 
on tur.id_turno = s.id_turno;
drop procedure `GetAllByIdUser`;
DELIMITER // 
create procedure `GetAllByIdUser`(in id integer)
BEGIN
select * from ticket t
inner join buy b
on b.id_Buy = t.id_Buy
where id_User = id
group by t.id_Buy;
END //

call GetAllByIdUser(2);

select * from Buy;

drop procedure GetAllTicketByIdBuy;
DELIMITER //
create procedure `GetAllTicketByIdBuy`(in id integer)
BEGIN
select c.namee, r.nombre, m.title_Movie, s.day ,t.hr_start,ti.id_Buy, ti.nro_entrada from ticket ti
inner join showings s
on s.id_Showing = ti.id_Showing
inner join turns t
on s.id_turno = t.id_turno
inner join movies m
on m.id_Movie = s.idMovie
inner join room r
on s.idRoom = r.idRoom
inner join cinemas c
on r.id_Cine = c.id_cinema
where ti.id_Buy = id;
END //

call GetAllTicketByIdBuy(28);

DELIMITER //
Create Procedure `ShowingForDays` (in days date, in endDay date)
BEGIN
	select * from showings s
    where s.day between days and endDay;
END //

call ShowingForDays('2019-11-20','2019-11-26');


truncate table cinemas;
truncate table room;
truncate table showings;
truncate table ticket;
truncate table paytc;
truncate table buy;

select email from users where email = 'sssss';
select email from users where email = 'nico@outlook.com';

insert into perfilusers(user_name,firstName,lastName,dni) value('ADMIN2','juan','perez',3923432);
insert into users(email,password,id_rol,id_perfilUser) value('juan_perez@outlook.com',123456,2,6);

-- ########################################################## PROCEDURES #############################################################

-- =================================================== CARGAR USUARIO =====================================

DELIMITER //
CREATE PROCEDURE `CargarUserClient` (in user_name varchar(50),in firstName varchar(50),in lastName varchar(50),in dni int, in email varchar(50),in password varchar(50))
BEGIN
    insert into perfilusers(user_name,firstName,lastName,dni) value(user_name,firstName,lastName,dni);
    -- set id = last_insert_id();select @id;
    insert into users(email,password,id_rol,id_perfilUser) value(email,password,1,last_insert_id());

END //

-- call `CargarUser`('u','u','u',12215,'u@outlook.com',123456,2);

-- =================================================== CARGAR USUARIO =====================================
-- =================================================== CARGAR USUARIO =====================================
-- =================================================== CARGAR USUARIO =====================================
-- =================================================== CARGAR USUARIO =====================================
DELIMITER //
CREATE PROCEDURE `CargarRoomCinema` (in nombre varchar(50),in capacidad int,in id int)
BEGIN
    insert into room(nombre,capacidad,id_Cine) value(nombre,capacidad,id);
END //

drop procedure `CargarRoomCinema`;


select * from room r 
inner join cinemas c 
on c.id_cinema = r.id_Cine
where c.id_cinema = 1;