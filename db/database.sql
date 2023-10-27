drop DATABASE if exists pedepizza;

create database if not exists pedepizza;

use pedepizza;

create table if not exists ingredients (
  id int auto_increment primary key,
  name varchar (40) unique,
  image varchar (100) unique
);

create table if not exists pizzas (
  id int auto_increment primary key,
  name varchar (40),
  image varchar (100) unique
);

create table if not exists pizzerias (
  id int auto_increment primary key,
  pizzeria_name varchar (40),
  image varchar (100) unique,
  telefone varchar (16) unique,
  cnpj varchar (14) not null unique,
  zipcode varchar (8) not null,
  city varchar (40) not null,
  state varchar (2) not null,
  street varchar (40) not null,
  street_number varchar (10) not null,
  email varchar (255) unique
);

create table if not exists pizzas_ingredients (
  id int auto_increment primary key,
  id_ingredient int not null,
  id_pizza int not null,
  CONSTRAINT FK_1_PIZZAS_INGREDIENTS FOREIGN KEY (id_ingredient) REFERENCES ingredients (id),
  CONSTRAINT FK_2_PIZZAS_INGREDIENTS FOREIGN KEY (id_pizza) REFERENCES pizzas (id)
);

create table if not exists cardarpios (
  id int auto_increment primary key,
  id_pizza int not null,
  id_pizzeria int not null,
  CONSTRAINT FK_1_CARDAPIO FOREIGN KEY (id_pizza) REFERENCES pizzas (id),
  CONSTRAINT FK_2_CARDAPIO FOREIGN KEY (id_pizzeria) REFERENCES pizzerias (id)
);

create table if not exists admin(
  id int auto_increment primary key,
  username varchar (50) unique,
  password varchar (255)
);

insert into
  ingredients (name, image)
values
  ('Ovo', 'ovo.png');

insert into
  ingredients (name, image)
values
  ('Abacaxi', 'abacaxi.png');

insert into
  ingredients (name, image)
values
  ('Calabresa', 'calabresa.png');

insert into
  ingredients (name, image)
values
  ('Catupiry', 'catupiry.png');

insert into
  ingredients (name, image)
values
  ('Cheddar', 'cheddar.png');

insert into
  ingredients (name, image)
values
  ('Brocolis', 'brocolis.png');

insert into
  ingredients (name, image)
values
  ('Azeitona Verde', 'azeitona-verde.png');

insert into
  ingredients (name, image)
values
  ('Alho', 'alho.png');

insert into
  ingredients (name, image)
values
  ('Beringela', 'beringela.png');

insert into
  ingredients (name, image)
values
  ('Bombom', 'bombom.png');

insert into
  ingredients (name, image)
values
  ('Tomate', 'tomate.png');

insert into
  ingredients (name, image)
values
  ('Oregano', 'oregano.png');

insert into
  ingredients (name, image)
values
  ('Cebola', 'cebola.png');

insert into
  ingredients (name, image)
values
  ('Muçarela', 'mucarela.png');

insert into
  ingredients (name, image)
values
  ('Milho', 'milho.png');

insert into
  ingredients (name, image)
values
  ('Frango', 'frango.png');

insert into
  ingredients (name, image)
values
  ('Palmito', 'palmito.png');

insert into
  ingredients (name, image)
values
  ('Molho de tomate', 'molho-tomate.png');

select
  *
from
  ingredients;

insert into
  pizzas (name, image)
values
  ('Portuguesa', 'portuguesa.png');

insert into
  pizzas (name, image)
values
  ('Calabresa', 'calabresa.png');

insert into
  pizzas (name, image)
values
  ('Havaiana', 'havaiana.png');

insert into
  pizzas (name, image)
values
  ('Manjericao', 'manjericao.png');

insert into
  pizzas (name, image)
values
  ('Mista', 'mista.png');

insert into
  pizzas (name, image)
values
  ('Pimentao', 'pimentao.png');

insert into
  pizzas (name, image)
values
  ('Presunto com abacaxi', 'presunto-abacaxi.png');

insert into
  pizzas (name, image)
values
  ('Margueritha', 'margueritha.png');

insert into
  pizzas (name, image)
values
  ('Queijo crocante', 'queijo-crocante.png');

insert into
  pizzas (name, image)
values
  ('Margarita', 'margarita.png');

insert into
  pizzas (name, image)
values
  ('Confete', 'confete.png');

insert into
  pizzas (name, image)
values
  ('Chocolate com morango', 'chocolate-morango.png');

insert into
  pizzas (name, image)
values
  ('Doce mista', 'doce-mista.png');

insert into
  pizzas (name, image)
values
  ('Carne com queijo', 'carne-queijo.png');

select
  *
from
  pizzas;

insert into
  admin (username, password)
values
  ('admin', 'admin');

select
  *
from
  admin;

insert into
  pizzerias (
    pizzeria_name,
    image,
    telefone,
    cnpj,
    zipcode,
    city,
    state,
    street,
    street_number,
    email
  )
values
  (
    'pizzeria do Zé',
    'pizzeria-ze.png',
    '+55 11 999999999',
    '12345678901234',
    '12345678',
    'São Paulo',
    'SP',
    'Rua dos Bobos',
    '0',
    'zedapizza@teste.com'
  );

SELECT
  *
FROM
  pizzerias;

insert into
  pizzas_ingredients (id_pizza, id_ingredient)
values
  (1, 1);

insert into
  pizzas_ingredients (id_pizza, id_ingredient)
values
  (1, 7);

insert into
  pizzas_ingredients (id_pizza, id_ingredient)
values
  (1, 11);

insert into
  pizzas_ingredients (id_pizza, id_ingredient)
values
  (1, 12);

insert into
  pizzas_ingredients (id_pizza, id_ingredient)
values
  (2, 3);

insert into
  pizzas_ingredients (id_pizza, id_ingredient)
values
  (2, 7);