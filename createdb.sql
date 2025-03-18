DROP DATABASE if exists auto_240617 ;
CREATE DATABASE auto_240617;
use auto_240617;
Delete from auto;
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

