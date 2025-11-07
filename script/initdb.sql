create table if not exists adresse (
    id int(5) auto_increment primary key,
    num int(4) not null,
    libelle varchar(255) not null,
    cp varchar(6) not null,
    ville varchar(150) not null
);

create table if not exists client (
    id int(5) auto_increment primary key,
    nom varchar(100) not null,
    prenom varchar(150) not null,
    email varchar(255) not null,
    tel varchar(15) not null,
    adresse_id int(5) not null,
    constraint fk_adresse 
        foreign key (adresse_id) 
        references adresse (id)
);