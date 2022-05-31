CREATE TABLE IF NOT EXISTS esami(
    esame varchar(40) not null,
    data_esame varchar(40) not null,
    posizione varchar(40) not null,
    professore varchar(40) not null,
    canale integer,
    note varchar(40),
    constraint chiave_esame primary key (esame,data_esame),
    check (canale>=1 and canale<=3)
);