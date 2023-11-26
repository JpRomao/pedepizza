DROP DATABASE IF EXISTS pedepizza;

CREATE DATABASE IF NOT EXISTS pedepizza;

ALTER DATABASE pedepizza CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE pedepizza;

CREATE TABLE IF NOT EXISTS ingredients (
  id VARCHAR(255) PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  image VARCHAR(255) NOT NULL,
  created_by VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UNIQUE(image),
  UNIQUE(name)
);

CREATE TABLE IF NOT EXISTS pizzerias (
  id VARCHAR(255) PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  image VARCHAR(255) NOT NULL,
  phone VARCHAR(16) NOT NULL,
  cnpj VARCHAR(14) NOT NULL,
  zip_code VARCHAR(8) NOT NULL,
  city VARCHAR(255) NOT NULL,
  state VARCHAR(2) NOT NULL,
  street VARCHAR(255) NOT NULL,
  number VARCHAR(10) NOT NULL,
  neighborhood VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UNIQUE(email),
  UNIQUE(cnpj),
  UNIQUE(phone),
  UNIQUE(image)
);

CREATE TABLE IF NOT EXISTS pizzas (
  id VARCHAR(255) PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  image VARCHAR(255) NOT NULL,
  time_to_prepare INT NOT NULL,
  created_by VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT FK_1_PIZZAS FOREIGN KEY (created_by) REFERENCES pizzerias (id),
  UNIQUE(image)
);

CREATE TABLE IF NOT EXISTS pizzas_ingredients (
  id INT PRIMARY KEY AUTO_INCREMENT,
  id_ingredient VARCHAR(255) NOT NULL,
  id_pizza VARCHAR(255) NOT NULL,
  CONSTRAINT FK_1_PIZZAS_INGREDIENTS FOREIGN KEY (id_ingredient) REFERENCES ingredients (id),
  CONSTRAINT FK_2_PIZZAS_INGREDIENTS FOREIGN KEY (id_pizza) REFERENCES pizzas (id)
);

CREATE TABLE IF NOT EXISTS menus (
  id INT PRIMARY KEY AUTO_INCREMENT,
  id_pizza VARCHAR(255) NOT NULL,
  id_pizzeria VARCHAR(255) NOT NULL,
  CONSTRAINT FK_1_CARDAPIO FOREIGN KEY (id_pizza) REFERENCES pizzas (id),
  CONSTRAINT FK_2_CARDAPIO FOREIGN KEY (id_pizzeria) REFERENCES pizzerias (id),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS admin(
  id VARCHAR(255) PRIMARY KEY,
  username VARCHAR(50),
  password VARCHAR(255),
  UNIQUE(username)
);

INSERT INTO
  pizzerias (
    id,
    name,
    image,
    phone,
    cnpj,
    zip_code,
    city,
    state,
    neighborhood,
    street,
    number,
    email,
    password
  )
VALUES
  (
    '1',
    'pizzeria do Zé',
    'pizzaria-do-ze.jpg',
    '11999999999',
    '12345678901234',
    '12345678',
    'São Paulo',
    'SP',
    'Vila do Zé',
    'Rua dos Bobos',
    '0',
    'zedapizza@teste.com',
    '123456'
  );

INSERT INTO
  ingredients (id, name, image, created_by)
VALUES
  ('1', 'Ovo', 'ovo.png', '1');

INSERT INTO
  ingredients (id, name, image, created_by)
VALUES
  ('2', 'Abacaxi', 'abacaxi.png', '1');

INSERT INTO
  ingredients (id, name, image, created_by)
VALUES
  ('3', 'Calabresa', 'calabresa.png', '1');

INSERT INTO
  ingredients (id, name, image, created_by)
VALUES
  ('4', 'Catupiry', 'catupiry.png', '1');

INSERT INTO
  ingredients (id, name, image, created_by)
VALUES
  ('5', 'Cheddar', 'cheddar.png', '1');

INSERT INTO
  ingredients (id, name, image, created_by)
VALUES
  ('6', 'Brocolis', 'brocolis.png', '1');

INSERT INTO
  ingredients (id, name, image, created_by)
VALUES
  ('7', 'Azeitona Verde', 'azeitona-verde.png', '1');

INSERT INTO
  ingredients (id, name, image, created_by)
VALUES
  ('8', 'Alho', 'alho.png', '1');

INSERT INTO
  ingredients (id, name, image, created_by)
VALUES
  ('9', 'Beringela', 'beringela.png', '1');

INSERT INTO
  ingredients (id, name, image, created_by)
VALUES
  ('10', 'Bombom', 'bombom.png', '1');

INSERT INTO
  ingredients (id, name, image, created_by)
VALUES
  ('11', 'Tomate', 'tomate.png', '1');

INSERT INTO
  ingredients (id, name, image, created_by)
VALUES
  ('12', 'Oregano', 'oregano.png', '1');

INSERT INTO
  ingredients (id, name, image, created_by)
VALUES
  ('13', 'Cebola', 'cebola.png', '1');

INSERT INTO
  ingredients (id, name, image, created_by)
VALUES
  ('14', 'Muçarela', 'mucarela.png', '1');

INSERT INTO
  ingredients (id, name, image, created_by)
VALUES
  ('15', 'Milho', 'milho.png', '1');

INSERT INTO
  ingredients (id, name, image, created_by)
VALUES
  ('16', 'Frango', 'frango.png', '1');

INSERT INTO
  ingredients (id, name, image, created_by)
VALUES
  ('17', 'Palmito', 'palmito.png', '1');

INSERT INTO
  ingredients (id, name, image, created_by)
VALUES
  ('18', 'Molho de tomate', 'molho-tomate.png', '1');

SELECT
  *
FROM
  ingredients;

INSERT INTO
  pizzas (id, name, image, created_by, time_to_prepare)
VALUES
  ('1', 'Portuguesa', 'portuguesa.png', '1', 45);

INSERT INTO
  pizzas (id, name, image, created_by, time_to_prepare)
VALUES
  ('2', 'Calabresa', 'calabresa.png', '1', 45);

INSERT INTO
  pizzas (id, name, image, created_by, time_to_prepare)
VALUES
  ('3', 'Havaiana', 'havaiana.png', '1', 45);

INSERT INTO
  pizzas (id, name, image, created_by, time_to_prepare)
VALUES
  ('4', 'Manjericao', 'manjericao.png', '1', 45);

INSERT INTO
  pizzas (id, name, image, created_by, time_to_prepare)
VALUES
  ('5', 'Mista', 'mista.png', '1', 45);

INSERT INTO
  pizzas (id, name, image, created_by, time_to_prepare)
VALUES
  ('6', 'Pimentao', 'pimentao.png', '1', 45);

INSERT INTO
  pizzas (id, name, image, created_by, time_to_prepare)
VALUES
  (
    '7',
    'Presunto com abacaxi',
    'presunto-abacaxi.png',
    '1',
    45
  );

INSERT INTO
  pizzas (id, name, image, created_by, time_to_prepare)
VALUES
  ('8', 'Margueritha', 'margueritha.png', '1', 45);

INSERT INTO
  pizzas (id, name, image, created_by, time_to_prepare)
VALUES
  (
    '9',
    'Queijo crocante',
    'queijo-crocante.png',
    '1',
    45
  );

INSERT INTO
  pizzas (id, name, image, created_by, time_to_prepare)
VALUES
  ('10', 'Margarita', 'margarita.png', '1', 45);

INSERT INTO
  pizzas (id, name, image, created_by, time_to_prepare)
VALUES
  ('11', 'Confete', 'confete.png', '1', 45);

INSERT INTO
  pizzas (id, name, image, created_by, time_to_prepare)
VALUES
  (
    '12',
    'Chocolate com morango',
    'chocolate-morango.png',
    '1',
    45
  );

INSERT INTO
  pizzas (id, name, image, created_by, time_to_prepare)
VALUES
  ('13', 'Doce mista', 'doce-mista.png', '1', 45);

INSERT INTO
  pizzas (id, name, image, created_by, time_to_prepare)
VALUES
  (
    '14',
    'Carne com queijo',
    'carne-queijo.png',
    '1',
    45
  );

SELECT
  *
FROM
  pizzas;

INSERT INTO
  admin (id, username, password)
VALUES
  ('1', 'admin', 'admin');

SELECT
  *
FROM
  admin;

SELECT
  *
FROM
  pizzerias;

INSERT INTO
  pizzas_ingredients (id_pizza, id_ingredient)
VALUES
  ('1', '1');

INSERT INTO
  pizzas_ingredients (id_pizza, id_ingredient)
VALUES
  ('1', '7');

INSERT INTO
  pizzas_ingredients (id_pizza, id_ingredient)
VALUES
  ('1', '11');

INSERT INTO
  pizzas_ingredients (id_pizza, id_ingredient)
VALUES
  ('1', '12');

INSERT INTO
  pizzas_ingredients (id_pizza, id_ingredient)
VALUES
  ('2', '3');

INSERT INTO
  pizzas_ingredients (id_pizza, id_ingredient)
VALUES
  ('2', '7');

INSERT INTO
  pizzas_ingredients (id_pizza, id_ingredient)
VALUES
  ('2', '11');

INSERT INTO
  menus (id_pizza, id_pizzeria)
VALUES
  ('1', '1');

INSERT INTO
  menus (id_pizza, id_pizzeria)
VALUES
  ('2', '1');

SELECT
  *
FROM
  pizzas_ingredients;

SELECT
  *
FROM
  menus;