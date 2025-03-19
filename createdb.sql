DROP DATABASE if exists auto_240617 ;
CREATE DATABASE auto_240617;
use auto_240617;
create table auto (
                      id int primary key auto_increment,
                      hersteller varchar(255) ,
                      name varchar(255),
                      ps int,
                      farbe varchar(255),
                      baujahr int
);

insert into auto (hersteller, name, ps, farbe, baujahr)
values
    ('VW','Golf',90,'Blau',1996),
    ('BMW','3',120,'gelb',2015),
    ('Volvo','XC90',150,'rot',2022)
;

create table extras  (
                         id int auto_increment primary key,
                         name varchar(50)
);
INSERT INTO extras (id, name) VALUES
                                  (1, 'ABS'),
                                  (2, 'Klimaanlage'),
                                  (3, 'Airbag'),
                                  (4, 'Navigationssystem'),
                                  (5, 'Tempomat'),
                                  (6, 'Sitzheizung'),
                                  (7, 'Einparkhilfe'),
                                  (8, 'LED-Scheinwerfer'),
                                  (9, 'Panoramadach'),
                                  (10, 'Rückfahrkamera'),
                                  (11, 'Bluetooth'),
                                  (12, 'Keyless-Go'),
                                  (13, 'Spurhalteassistent'),
                                  (14, 'Notbremsassistent'),
                                  (15, 'Xenon-Scheinwerfer'),
                                  (16, 'Regensensor'),
                                  (17, 'Freisprecheinrichtung'),
                                  (18, 'Anhängerkupplung'),
                                  (19, 'Sportsitze'),
                                  (20, 'Leichtmetallfelgen');

CREATE TABLE colors (
                        id int auto_increment PRIMARY KEY ,
                        name varchar(50),
                        hexcode varchar(10)
                   );

INSERT INTO colors (name, hexcode) VALUES
                                       ('Rot', '#FF0000'),
                                       ('Grün', '#00FF00'),
                                       ('Blau', '#0000FF'),
                                       ('Schwarz', '#000000'),
                                       ('Weiß', '#FFFFFF'),
                                       ('Gelb', '#FFFF00'),
                                       ('Magenta', '#FF00FF'),
                                       ('Cyan', '#00FFFF'),
                                       ('Lila', '#800080'),
                                       ('Orange', '#FFA500'),
                                       ('Pink', '#FFC0CB'),
                                       ('Braun', '#A52A2A'),
                                       ('Grau', '#808080'),
                                       ('Beige', '#F5F5DC'),
                                       ('Violett', '#EE82EE'),
                                       ('Türkis', '#40E0D0'),
                                       ('Lavendel', '#E6E6FA'),
                                       ('Olive', '#808000'),
                                       ('Indigo', '#4B0082'),
                                       ('Gold', '#FFD700'),
                                       ('Silber', '#C0C0C0'),
                                       ('Bronze', '#CD7F32'),
                                       ('Dunkelgrün', '#006400'),
                                       ('Himmelblau', '#87CEEB'),
                                       ('Hellgrün', '#90EE90'),
                                       ('Dunkelblau', '#00008B'),
                                       ('Tomatenrot', '#FF6347'),
                                       ('Lime', '#00FF00'),
                                       ('Salbeigrün', '#9DC183'),
                                       ('Mandel', '#FFE4B5'),
                                       ('Koralle', '#FF7F50'),
                                       ('Scharlachrot', '#FF2400'),
                                       ('Hochzeitsweiß', '#FAF0E6'),
                                       ('Mintgrün', '#98FF98'),
                                       ('Zinnoberrot', '#E34234'),
                                       ('Aubergine', '#6A4E1F'),
                                       ('Bordeaux', '#9B111E'),
                                       ('Eisblau', '#A4D3E7'),
                                       ('Zartrosa', '#FFB6C1');


CREATE TABLE bestellungen (
                              bestellId int auto_increment PRIMARY KEY ,
                              vorname varchar(50),
                              nachname varchar(50),
                              farbcode varchar(10)
);

CREATE TABLE extrasBestellung (
                                bestellId int (2),
                                extrasId int (2),
                                PRIMARY KEY (bestellId,extrasId),
                                foreign key (bestellId) REFERENCES bestellungen(bestellId),
                                foreign key (extrasId) REFERENCES  extras(id)
);
