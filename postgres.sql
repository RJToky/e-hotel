create database hotel;
 
create table Client (
    idClient int PRIMARY KEY,
    nom varchar(20),
    mdp varchar(20),
    email varchar(20),
    numTel varchar(20)
);
create sequence seqClient;

create table Admin (
    idAdmin int PRIMARY KEY,
    nom varchar(20),
    mdp varchar(20),
    email varchar(20)
);
create sequence seqAdmin;

create table Type (
    idType int PRIMARY KEY,
    value varchar(20)
);
create sequence seqType;

create table Habitation (
    idHabitation int PRIMARY KEY,
    idType int,
    nbChambre int,
    loyer decimal,
    quartier varchar(20),
    descHabitation text,
    FOREIGN KEY (idType) REFERENCES Type(idType)
);
create sequence seqHabitation;

create table Photo (
    idPhoto int PRIMARY KEY,
    idHabitation int,
    nomPhoto varchar(20),
    FOREIGN KEY (idHabitation) REFERENCES Habitation(idHabitation)
);
create sequence seqPhoto;

create table Reservation (
    idReservation int PRIMARY KEY,
    idClient int,
    idHabitation int,
    dateDebut date,
    dateFin date,
    FOREIGN KEY (idClient) REFERENCES Client(idClient),
    FOREIGN KEY (idHabitation) REFERENCES Habitation(idHabitation)
);
create sequence seqReservation;


insert into Client values(nextVal('seqClient'), 'Judi', 'judi', 'judi@gmail.com', '0342421145');
insert into Client values(nextVal('seqClient'), 'Miharitiana', 'miharitiana', 'miha@gmail.com', '0345088066');

insert into Admin values(nextVal('seqAdmin'), 'Toky', 'toky', 'toky@gmail.com');

insert into Type values(nextVal('seqType'), 'Maison');
insert into Type values(nextVal('seqType'), 'Studio');

insert into Habitation values(nextVal('seqHabitation'), 1, 1, 1000, 'Ivato', 'Maison 4 chambres coté plein sud avec piscine');
insert into Habitation values(nextVal('seqHabitation'), 2, 1, 1500, 'Ambohibao', 'Maison 3 chambres  avec terrain de basket');
insert into Habitation values(nextVal('seqHabitation'), 2, 2, 2000, 'Mahamasina', 'Maison 3 chambres coté plein Ouest avec jardin');
insert into Habitation values(nextVal('seqHabitation'), 1, 4, 2600, 'Andoharanofotsy', 'Maison 4 chambres  avec piscine');
insert into Habitation values(nextVal('seqHabitation'), 1, 1, 2600, 'Ampefiloha', 'Maison 4 chambres avec piscine');
insert into Habitation values(nextVal('seqHabitation'), 1, 2, 1000, 'Arivonimamo', 'Maison 5 chambres  avec terrain de tennis');
insert into Habitation values(nextVal('seqHabitation'), 2, 1, 1500, 'Analakely', 'Maison 2 chambres avec piscine');
insert into Habitation values(nextVal('seqHabitation'), 2, 3, 2000, 'Talatamaty', 'Maison 4 chambres avec basket');
insert into Habitation values(nextVal('seqHabitation'), 1, 2, 2600, 'Itaosy', 'Maison 2 chambres avec jardin');
insert into Habitation values(nextVal('seqHabitation'), 1, 4, 2600,  'Ambohijatovo', 'Maison 3 chambres avec terrain');

insert into Photo values(nextVal('seqPhoto'), 1, 'house1.jpg');
insert into Photo values(nextVal('seqPhoto'), 2, 'house2.jpg');
insert into Photo values(nextVal('seqPhoto'), 3, 'house3.jpg');
insert into Photo values(nextVal('seqPhoto'), 4, 'house4.jpg');
insert into Photo values(nextVal('seqPhoto'), 5, 'house5.jpg');
insert into Photo values(nextVal('seqPhoto'), 6, 'house6.jpg');
insert into Photo values(nextVal('seqPhoto'), 7, 'house7.jpg');
insert into Photo values(nextVal('seqPhoto'), 8, 'house8.jpg');
insert into Photo values(nextVal('seqPhoto'), 9, 'house9.jpg');
insert into Photo values(nextVal('seqPhoto'), 10, 'house10.jpg');
