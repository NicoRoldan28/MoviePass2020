
use MP;
create database MP;
drop database MP;

#######################################  perfilUsers  ##############################################

create table perfilUsers(
    id_perfil integer auto_increment primary key,
    user_name varchar(20) unique not null,
    firstName varchar(30) not null,
    lastName varchar(30) not null,
    dni integer unique not null
);

drop table perfilUsers;
select * from perfilusers;




#######################################  ROL  ##############################################

create table rol(
    id_rol int primary key,
    name_description varchar(20) unique not null
);

drop table rol;
select * from rol;

#######################################  USERS  ##############################################

create table users(
id_user integer auto_increment primary key,
email varchar(40) not null,
password varchar (20) not null,
id_perfilUser integer not null,
id_rol integer not null,
constraint fk_id_perfilUser foreign key(id_perfilUser) references perfilUsers(id_perfil),
constraint fk_id_rol foreign key(id_rol) references rol(id_rol));



drop table users;
select * from users;


#######################################  Movies  ##############################################

create table Movies(
    id_Movie integer primary key,
    title_Movie varchar(100),
    image blob,
    lenght int,
    lenguage varchar(20)
);

drop table Movies;
select * from movies;

select * from movies
where id_Movie=413518;

truncate table movies;

######################################  Genders  ##############################################

create table Genders(
    id_Gender integer primary key,
    name_Gender varchar(20)
);

drop table Genders;
select * from Genders;
truncate table genders;

#######################################  GendersXMovies  ##############################################

create table GendersXMovies(
    id_Gender integer,
    id_Movie integer,
    constraint pk_GendersXMovies primary key(id_Movie,id_Gender),
    constraint fk_id_Gender foreign key(id_Gender) references Genders(id_Gender),
    constraint fk_id_Movie foreign key(id_Movie) references Movies(id_Movie)
);

drop table GendersXMovies;
select * from GendersXMovies;
truncate table gendersxmovies;

#######################################  Cinemas  ##############################################

Create table Cinemas(
    id_cinema integer auto_increment primary key,
    adress varchar(50) not null,
    name varchar(50) not null
);

drop table Cinemas;
select * from Cinemas;

truncate table cinemas;

#######################################  Room  ##############################################

create table Room(
idRoom integer auto_increment primary key,
nombre varchar(20) not null,
price_ticket integer not null,
capacidad integer not null,
id_Cine integer not null,
constraint foreign key fk_id_Cine(id_Cine) references Cinemas(id_cinema)
);

drop table room;
select * from Room;

#######################################  Showings  ##############################################

create table Showings(
	id_Showing integer auto_increment primary key,
    day datetime not null,
    idMovie integer,
    idRoom integer,
    hrFinish datetime not null,
    constraint fk_id_Room foreign key(idRoom) references Room(idRoom),
    constraint fk_id_Movie foreign key(idMovie) references Movies(id_Movie)
);

drop table Showings;
select * from showings;
truncate showings;

#######################################  Ticket  ##############################################

create table Ticket(
nro_entrada integer auto_increment primary key,
id_Showing integer not null,
id_Buy integer not null,
constraint fk_id_Showing foreign key(id_Showing) references showings(id_Showing),
constraint fk_id_Buy foreign key(id_Buy) references Buy(id_Buy)
);

drop table ticket;
select * from ticket;

truncate table ticket;



######################################  Buy  ##############################################


create table Buy(
id_Buy integer auto_increment primary key,
quantityTickets integer not null,
discount float not null,
days date,
total integer,
id_Pay integer,
id_User integer not null,
constraint fk_id_Pay foreign key(id_Pay) references PayTC(id_Pay),
constraint fk_id_User foreign key(id_User) references users(id_user)
);

drop table buy;
select *from buy b;
truncate table buy;

#######################################  CreditAccount  ##############################################

create table CreditAccount(
id_CreditAccount integer primary key,
name varchar(50),
cvv int not null,
expiration varchar(50),
cardNumber integer not null,
type varchar(50),
company varchar(50));

drop table CreditAccount;
select *from CreditAccount;
truncate table CreditAccount;

#######################################  PayTC  ##############################################


create table PayTC(
id_Pay integer auto_increment primary key,
cod_aut integer,
days date not null,
total float not null
-- id_CreditAccount integer not null,
-- constraint fk_id_CreditAccount foreign key(id_CreditAccount) references CreditAccount(id_CreditAccount)
);

drop table PayTC;
select *from PayTC;
truncate table PayTC;



#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% QUERYS %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

insert into rol(id_rol,name_description) values(1,'CLIENTE'),(2,'ADMINISTRADOR');
insert into perfilusers(user_name,firstName,lastName,dni) value('Rodri_07','Rodrigo','Villarroel',39809917);
insert into users(email,password,id_perfilUser,id_rol) value('rodrigo_villarroel@outlook.com',123456,1,2);



select * from users u
inner join perfilusers p
on u.id_perfilUser = p.id_perfil;

select count(t.nro_entrada) from Ticket t
inner join Showings s
on s.id_Showing = t.id_Showing 
where s.id_turno = Valuee;


select count(id_cinema) from Cinemas;

select count(t.nro_entrada) 
from ticket t
inner join showings s
on s.id_Showing = t.id_Showing
where s.id_Showing =2;

#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% STORE PROCEDURE %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

DELIMITER //
CREATE PROCEDURE `CargarUserClient` (in user_name varchar(50),in firstName varchar(50),in lastName varchar(50),in dni int, in email varchar(50),in password varchar(50))

BEGIN
    insert into perfilusers(user_name,firstName,lastName,dni) value(user_name,firstName,lastName,dni);
    insert into users(email,password,id_rol,id_perfilUser) value(email,password,1,last_insert_id());

END //

CREATE PROCEDURE `CargarUserClient` (in user_name varchar(50),in firstName varchar(50),in lastName varchar(50),in dni int, in email varchar(50),in password varchar(50))
DELIMITER //
CREATE PROCEDURE `CargarUserClient` (in user_name varchar(50),in firstName varchar(50),in lastName varchar(50),in dni int, in email varchar(50),in password varchar(50))

BEGIN
    insert into perfilusers(user_name,firstName,lastName,dni) value(user_name,firstName,lastName,dni);
    -- set id = last_insert_id();select @id;
    insert into users(email,password,id_rol,id_perfilUser) value(email,password,1,last_insert_id());

END //

call `CargarUserClient`("nicolas","nico","roldan",41306783,"rodrigo.villarroel.07@gmail.com","1234");

drop procedure `CargarUserClient`;


DELIMITER //
CREATE PROCEDURE `CargarRoomCinema` (in nombre varchar(50),in capacidad int,in id int)
BEGIN
    insert into room(nombre,capacidad,id_Cine) value(nombre,capacidad,id);
END //

call `CargarRoomCinema`();

drop procedure `CargarRoomCinema`;

DELIMITER //
CREATE PROCEDURE `ShowingForDay` (in dayTime datetime)
BEGIN
	select s.id_Showing, s.day, s.idMovie, s.idRoom, s.hrFinish, r.id_Cine from showings s
	inner join room r on s.idRoom = r.idRoom
	WHERE CAST(dayTime AS date) = CAST(s.day AS date);
END //

DELIMITER //
CREATE PROCEDURE `ShowingForDayAndYesterday` (in dayTime datetime)
BEGIN
	select s.id_Showing, s.day, s.idMovie, s.idRoom, s.hrFinish, r.id_Cine from showings s
	inner join room r on s.idRoom = r.idRoom
	WHERE CAST(dayTime AS date) = CAST(s.day AS date)
    or  CAST(DATE_ADD(dayTime, INTERVAL -1 DAY) AS date) = CAST(s.day AS date);
END //
	
call `ShowingForDayAndYesterday`("2020-11-29 22:00:00");

drop procedure `ShowingForDayAndYesterday`;

DELIMITER //
Create Procedure `ShowingForDays` (in days datetime, in endDay datetime)
BEGIN
    select s.id_Showing, s.day, s.idMovie, s.idRoom, s.hrFinish, r.id_Cine from showings s
	inner join room r on s.idRoom = r.idRoom
    where s.day between days and endDay
    order By s.day;
END //
select * from showings
call `ShowingForDays`('2020-03-02 16:00:00','2020-03-02 22:00:00');

drop procedure `ShowingForDays`;



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

call `CountQuantityForMovieXTurnXCinema`(475557,1,1);

drop procedure `CountQuantityForMovieXTurnXCinema`;


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

call `CountQuantity`();

drop procedure `CountQuantity`;

DELIMITER //
CREATE PROCEDURE `Total` (in idShowing int)
BEGIN
    select sum(b.total) as total from buy b
	inner join Ticket t
	on b.id_Buy = t.id_Buy
	where t.id_Showing = 1;
END //

DELIMITER //
CREATE PROCEDURE `Total` (in idShowing int)
BEGIN
    select sum(b.total) as total from buy b
	inner join Ticket t
	on b.id_Buy = t.id_Buy
	where t.id_Showing = 1;
END //

call `Total`();

drop procedure `Total`;

SELECT r.price_ticket from Showings as s 
                inner join room r on r.idRoom = s.idRoom 
                
                WHERE(s.id_Showing = 4);

'SELECT c.price_ticket from '.$this->tableName.' as s 
                inner join room r on r.idRoom = s.idRoom 
                inner join cinemas c on c.id_cinema = r.id_Cine
                WHERE(s.id_Showing = :id);';

DELIMITER //
CREATE PROCEDURE `CountQuantityForMovie` (in Valuee int)
BEGIN
	select count(t.nro_entrada) from Ticket t
	inner join Showings s
	on s.id_Showing = t.id_Showing 
	where s.idMovie = Valuee;
END //

call `CountQuantityForMovie`(724989);

drop procedure `CountQuantityForMovie`;


DELIMITER //
CREATE PROCEDURE `CountQuantityForCinema` (in Valuee int)
BEGIN
	select count(t.nro_entrada) from Ticket t
	inner join Showings s
	on s.id_Showing = t.id_Showing 
	where s.idCine = Valuee;
END //

call `CountQuantityForCinema`();

drop procedure `CountQuantityForCinema`;

drop procedure `CountQuantityForTurn`;


call `CountMoneyForMovie`(724989, "2020/11/23", "2020/11/28");

DELIMITER //
CREATE PROCEDURE CountMoneyForMovie (in Valuee int,in dayS date, in dayF date)
BEGIN
    select ifnull(sum(ta.total),0) as total from (select b.total from buy b
    inner join ticket t on
    t.id_Buy = b.id_Buy
    inner join showings s on
    s.id_Showing = t.id_Showing
    where s.idMovie = Valuee
    
    and s.day between dayS and dayF
    group by b.id_Buy) as ta;
END //


call `CountMoneyForMovie`(766208,2021-01-01,2021-01-20);

drop procedure `CountMoneyForCinema`;

DELIMITER //
CREATE PROCEDURE CountMoneyForCinema (in Valuee int,in dayS date, in dayF date)
BEGIN
    select ifnull(sum(ta.total),0) as total from (select b.total from buy b
    inner join ticket t
    on t.id_Buy = b.id_Buy 
    inner join showings s
    on t.id_Showing = s.id_Showing
    inner join room r
    on r.idRoom = s.idRoom
    where r.id_Cine = Valuee
    and s.day between dayS and dayF
    group by b.id_Buy) as ta;
END //


drop procedure `GetAllTicketByIdBuy`;

DELIMITER //
create procedure `GetAllTicketByIdBuy`(in id integer)
BEGIN
select c.name, r.nombre, m.title_Movie, s.day ,ti.id_Buy, ti.nro_entrada from ticket ti
inner join showings s
on s.id_Showing = ti.id_Showing
inner join movies m
on m.id_Movie = s.idMovie
inner join room r
on s.idRoom = r.idRoom
inner join cinemas c
on r.id_Cine = c.id_cinema
where ti.id_Buy = id
;
END //

DELIMITER //
create procedure `GetNumberTicketByIdBuy`(in id integer)
BEGIN
select ti.nro_entrada from ticket ti
where ti.id_Buy = id
;
END //


call `GetNumberTicketByIdBuy`(20);

call `GetAllTicketByIdBuy`(20);
select * from ticket;
select * from buy;

drop procedure `GetAllTicketByIdBuy`;


DELIMITER // 
create procedure `GetAllByIdUser`(in id integer,in idBuy integer)
BEGIN
select c.name, r.nombre, m.title_Movie, s.day ,ti.id_Buy, ti.nro_entrada from ticket ti
inner join buy b
on b.id_Buy = ti.id_Buy
inner join showings s
on s.id_Showing = ti.id_Showing
inner join movies m
on m.id_Movie = s.idMovie
inner join room r
on s.idRoom = r.idRoom
inner join cinemas c
on r.id_Cine = c.id_cinema
where b.id_User = id
group by b.id_Buy
having b.id_Buy = idBuy;
END //


select * from ticket;
select * from buy;

truncate ticket;
call `GetAllByIdUser`(2);

drop procedure `GetAllByIdUser`;

DELIMITER //
create procedure `AddTicket`(in )

DELIMITER //
create procedure `GetAllBuyByIdUser`(in id integer)
BEGIN
select b.id_Buy, b.quantityTickets, b.discount, b.days, b.total, ifnull(b.id_Pay,0) as idPago, b.id_User from buy b
where b.id_User = id
and b.id_Pay !=0
group by b.id_Buy;
END //

call `GetAllBuyByIdUser`(2); 
drop procedure `GetAllBuyByIdUser`;
select * from buy
#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% SELECTS Y TRUNCATES%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
#%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%




truncate table cinemas;
truncate table room;
truncate table showings;
truncate table ticket;
truncate table paytc;
truncate table buy;



-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% PRUEBAS %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
-- %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

DELIMITER //
CREATE PROCEDURE `ShowingForDayOrderBy` (in dayTime datetime)
BEGIN
	select s.id_Showing, s.day, s.idMovie, s.idRoom, s.hrFinish, r.id_Cine from showings s
	inner join room r on s.idRoom = r.idRoom
	WHERE CAST(dayTime AS date) = CAST(s.day AS date)
    order by s.day desc;
END //

drop procedure ShowingForDayOrderBy;

DELIMITER //
CREATE PROCEDURE `CheckAvailability` (in id int)
BEGIN
select ((SELECT r.capacidad from showings as s 
inner join room r on r.idRoom = s.idRoom WHERE(s.id_Showing = id))-(select count(t.nro_entrada) from ticket t
where id_Showing = id)) as AVAILABILITY;
END //

call `CheckAvailability`(1);

INSERT INTO buy(id_User,discount,days,total)
            VALUES (1,0.25,'2020-03-03 22:00:00',1500);


truncate table cinemas;
truncate table room;
truncate table showings;
truncate table ticket;
truncate table paytc;
truncate table buy;

DELIMITER //
CREATE PROCEDURE `CargarBuy` (in id_User int,in discount float,in days date,in total int, in quantityTickets int)
BEGIN
	INSERT INTO buy(id_User,discount,days,total,quantityTickets)
	VALUES (id_User,discount,days,total,quantityTickets);
SELECT @@identity as id_Buyticket;
END //



call `CargarBuy`(2,0,'2020-03-03',1500,5);
drop procedure `CargarBuy`;
select * from ticket;
select * from buy;
select * from paytc;

select b.id_Buy from buy b
where b.id_User = 2
order by b.id_Buy desc limit 1;

DELIMITER //
CREATE PROCEDURE `AcreditePay` (in days date,in total int, in idBuy int)
BEGIN
	INSERT INTO paytc(days,total)
	VALUES (days,total);
	UPDATE buy b
	SET b.id_Pay = last_insert_id()
	WHERE b.id_Buy = idBuy;
END //

select * from paytc;

select * from buy;
drop procedure `AcreditePay`;
call `AcreditePay`("2020-12-20",1800,1);


SELECT b.id_Buy FROM buy b where b.id_User = 2
                order by b.id_Buy desc limit 1;

SELECT t.id_Showing from ticket t 
WHERE(t.id_Showing = 2)
group by t.id_Showing;

DELIMITER //
CREATE PROCEDURE `getTicketByIdBuy` (in id int)
BEGIN
	select t.id_Showing from ticket t
	WHERE(t.id_Buy = id)
	group by t.id_Showing;
END //

drop procedure `getTicketByIdBuy`;
call `getTicketByIdBuy`(13);

select * from buy
select * from ticket
