-- Création de la BDD --
CREATE DATABASE IF NOT EXISTS ggeparrot_ecf DEFAULT CHARACTER SET utf8;

-- Utilisation de la BDD
USE ggeparrot_ecf;

-- CREATION DES TABLES --

-- Création de la table user --
CREATE TABLE user (
  id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  email varchar(180) NOT NULL,
  roles text NOT NULL,
  password varchar(255) NOT NULL,
  firstname varchar(50) NOT NULL,
  lastname varchar(50) NOT NULL
);

-- Création de la table car --
CREATE TABLE car (
  id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  brand varchar(50) NOT NULL,
  model varchar(100) NOT NULL,
  year date NOT NULL,
  km int NOT NULL,
  price int NOT NULL,
  teaser_img varchar(255) NOT NULL,
  img1 varchar(255) NOT NULL,
  img2 varchar(255) NOT NULL,
  img3 varchar(255) NOT NULL
);

-- Création de la table contact --
CREATE TABLE contact (
  id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  car_id int DEFAULT NULL,
  email varchar(180) NOT NULL,
  firstname varchar(50) NOT NULL,
  lastname varchar(50) NOT NULL,
  tel varchar(13) NOT NULL,
  subject varchar(50) NOT NULL,
  message text NOT NULL,
  FOREIGN KEY (car_id) REFERENCES car(id)
);

-- Création de la table opening_time --
CREATE TABLE opening_time (
  id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  day varchar(10) NOT NULL,
  open_am time DEFAULT NULL,
  close_am time DEFAULT NULL,
  open_pm time DEFAULT NULL,
  close_pm time DEFAULT NULL
);

-- Création de la table opinion --
CREATE TABLE opinion (
  id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  firstname varchar(50) NOT NULL,
  lastname varchar(50) NOT NULL,
  score int NOT NULL,
  opinion longtext NOT NULL,
  is_validate tinyint(1) NOT NULL
);

-- Création de la table service --
CREATE TABLE service (
  id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  title varchar(50) NOT NULL,
  description longtext NOT NULL
);

-- Création de la table option --
CREATE TABLE option (
  id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  name varchar(50) NOT NULL
);

-- Création de la table car_option --
CREATE TABLE car_option (
  car_id int NOT NULL,
  option_id int NOT NULL,
  FOREIGN KEY (car_id) REFERENCES car(id),
  FOREIGN KEY (option_id) REFERENCES option(id)
);

-- ALIMENTATION DES TABLES --

-- Alimentation de la table user --
INSERT INTO user (`email`, `roles`, `password`, `firstname`, `lastname`) VALUES
('admin@admin.fr', '[\"ROLE_ADMIN\"]', '$2y$13$7udH3Ici6ovnmq033zblfen1s3Opp6Xn5QprB8pNrm5r5zH4U18tW', 'Admin', 'Administrateur'),
('employe@employe.fr', '[\"ROLE_USER\"]', '$2y$13$8JmqjqSjVc7jCieERfP7aOc3JSaL1nDN6rFSOSzynfFV3vU0529gW', 'Empl', 'Employe');

-- Alimentation de la table car --
INSERT INTO car (`brand`, `model`, `year`, `km`, `price`, `teaser_img`, `img1`, `img2`, `img3`) VALUES
('Renault', 'Clio III 1.5 dci', '2009-02-15', 85000, 4500, 'clio1-6567101d6cceb.jpg', 'clio2-6567101d6d36b.jpg', 'clio3-6567101d6d9e2.jpg', 'clio4-6567101d6df18.jpg'),
('Mercedes', 'Classe C Break', '2015-03-25', 56000, 24000, 'merc1-6566fb1b910e5.jpg', 'Merc2-6566fb1b919ff.jpg', 'merc3-6566fb1b920aa.jpg', 'merc4-6566fb1b925b9.jpg'),
('BMW', 'Serie 4', '2012-05-02', 135000, 12000, 'bmw1-6566fb4802f08.jpg', 'bmw2-6566fb4803550.jpg', 'bmw3-6566fb4803bd6.jpg', 'bmw4-6566fb480410f.jpg'),
('Audi', 'A5 3.0 TFSI', '2020-11-05', 26300, 33000, 'audi1-6566fb8b89804.jpg', 'audi2-6566fb8b89f8e.jpg', 'audi3-6566fb8b8a65c.jpg', 'audi4-6566fb8b8ac56.jpg'),
('Mercedes', 'CLA', '2021-01-12', 10000, 38000, 'Mercedes1-6566fbc8ce683.jpg', 'Mercedes2-6566fbc8cee42.jpg', 'Mercedes3-6566fbc8cf445.jpg', 'Mercedes4-6566fbc8cf987.jpg');

-- Alimentation de la table contact --
INSERT INTO contact (`car_id`, `email`, `firstname`, `lastname`, `tel`, `subject`, `message`) VALUES
(NULL, 'test@test.fr', 'Test', 'SuperTest', '0600000000', 'Test', 'Le super message test pour tester.'),
(NULL, 'julien.bariton@exemple.fr', 'Julien', 'Bariton', '0606060606', 'Renseignement', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. A scelerisque purus semper eget duis at tellus at. Molestie ac feugiat sed lectus vestibulum mattis ullamcorper velit. Diam vel quam elementum pulvinar etiam non. Nunc scelerisque viverra mauris in. Augue neque gravida in fermentum. Convallis convallis tellus id interdum velit. Non enim praesent elementum facilisis leo vel fringilla est. Pellentesque habitant morbi tristique senectus et netus. Amet mattis vulputate enim nulla aliquet porttitor lacus luctus accumsan. Mattis pellentesque id nibh tortor id aliquet lectus. Nunc faucibus a pellentesque sit amet porttitor eget dolor morbi. Justo eget magna fermentum iaculis. Lacus laoreet non curabitur gravida arcu ac tortor dignissim convallis. Arcu cursus vitae congue mauris rhoncus aenean vel. Lobortis scelerisque fermentum dui faucibus in ornare quam viverra orci. Bibendum est ultricies integer quis auctor elit sed. Mauris rhoncus aenean vel elit scelerisque mauris pellentesque pulvinar. Turpis massa sed elementum tempus egestas sed sed. Morbi non arcu risus quis varius quam quisque id.'),
(2, 'athena.grimi@example.com', 'Athéna', 'Grimi', '0606060606', 'Renseignement annonce N° 6 Mercedes Classe C Break', 'Demande de renseignement');

-- Alimentation de la table opening_time --
INSERT INTO opening_time (`day`, `open_am`, `close_am`, `open_pm`, `close_pm`) VALUES
('Lundi', '08:00:00', '12:00:00', '14:00:00', '18:00:00'),
('Mardi', '08:00:00', '12:00:00', '14:00:00', '18:00:00'),
('Mercredi', '08:00:00', '12:00:00', '14:00:00', '18:00:00'),
('Jeudi', '08:00:00', '12:00:00', '14:00:00', '18:00:00'),
('Vendredi', '08:00:00', '12:00:00', '14:00:00', '18:00:00'),
('Samedi', '08:00:00', '12:00:00', NULL, NULL),
('Dimanche', NULL, NULL, NULL, NULL);

-- Alimentation de la table opinion --
INSERT INTO opinion (`firstname`, `lastname`, `score`, `opinion`, `is_validate`) VALUES
('Julien', 'Unknown', 5, 'Arcu risus quis varius quam. Velit ut tortor pretium viverra suspendisse potenti. Purus in massa tempor nec feugiat nisl pretium fusce. Pharetra diam sit amet nisl suscipit adipiscing. Ut enim blandit volutpat maecenas.', 1),
('Cassandra', 'Littlefish', 4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Elit eget gravida cum sociis natoque penatibus et magnis dis. Nisl vel pretium lectus quam id leo in vitae. In ante metus dictum at tempor commodo ullamcorper.', 1),
('Jérôme', 'Laplace', 5, 'Nec ullamcorper sit amet risus nullam eget felis eget nunc. Elementum curabitur vitae nunc sed velit dignissim sodales ut. Quisque sagittis purus sit amet.', 1),
('Valérie', 'Petitjean', 4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Elit eget gravida cum sociis natoque penatibus et magnis dis.', 1);

-- Alimentation de la table option --
INSERT INTO option (`name`) VALUES
('Aide parking'),
('Aide parking avec caméra de recul'),
('Jantes alu'),
('Peinture métallisée'),
('Rétroviseurs dégivrants'),
('Rétroviseurs rabattables'),
('Carte main libre'),
('Climatisation automatique'),
('Direction assistée'),
('Fermeture électrique'),
('GPS'),
('Prise audio USB'),
('Ordinateur de bord'),
('Régulateur de vitesse'),
('Siège conducteur réglable hauteur'),
('Vitres électriques'),
('Volant cuir'),
('Volant multifonctions'),
('Volant réglable en hauteur et profondeur'),
('Ecran tactile'),
('Bluetooth'),
('ABS'),
('AFU'),
('Aide au démarrage en côte'),
('Airbags front. + lat.\r\n'),
('Airbags latéraux\r\n'),
('Projecteurs antibrouillard'),
('Avertisseur d''angle mort'),
('Contrôle de pression des pneus'),
('Détecteur de pluie'),
('ESP'),
('Fixations ISOFIX'),
('Phares av. de jour à LED'),
('Portes arrière avec sécurité enfant'),
('Sièges arrières rabattable'),
('Système Start & Stop'),
('Détection des panneaux routiers'),
('Rétroviseurs électriques'),
('Accoudoir central avant');

-- Alimentation de la table service --
INSERT INTO service (`title`, `description`) VALUES
('Révision', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Aliquet bibendum enim facilisis gravida neque convallis a cras. Pellentesque id nibh tortor id aliquet. Lectus vestibulum mattis ullamcorper velit sed ullamcorper morbi tincidunt. Vestibulum rhoncus est pellentesque elit. Odio euismod lacinia at quis risus sed vulputate. Faucibus scelerisque eleifend donec pretium vulputate sapien.'),
('Carrosserie', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Aliquet bibendum enim facilisis gravida neque convallis a cras. Pellentesque id nibh tortor id aliquet. Lectus vestibulum mattis ullamcorper velit sed ullamcorper morbi tincidunt. Vestibulum rhoncus est pellentesque elit. Odio euismod lacinia at quis risus sed vulputate. Faucibus scelerisque eleifend donec pretium vulputate sapien.'),
('Peinture', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Aliquet bibendum enim facilisis gravida neque convallis a cras. Pellentesque id nibh tortor id aliquet. Lectus vestibulum mattis ullamcorper velit sed ullamcorper morbi tincidunt. Vestibulum rhoncus est pellentesque elit. Odio euismod lacinia at quis risus sed vulputate. Faucibus scelerisque eleifend donec pretium vulputate sapien.'),
('Changement de pneus', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Aliquet bibendum enim facilisis gravida neque convallis a cras. Pellentesque id nibh tortor id aliquet. Lectus vestibulum mattis ullamcorper velit sed ullamcorper morbi tincidunt. Vestibulum rhoncus est pellentesque elit. Odio euismod lacinia at quis risus sed vulputate. Faucibus scelerisque eleifend donec pretium vulputate sapien.');

-- Alimentation de la table car_option --
INSERT INTO car_option (`car_id`, `option_id`) VALUES
(1, 1),
(1, 2),
(1, 8),
(1, 10),
(1, 13),
(1, 22),
(1, 28),
(1, 31),
(1, 34),
(1, 37),
(2, 1),
(2, 2),
(2, 4),
(2, 8),
(2, 13),
(2, 16),
(2, 20),
(2, 21),
(2, 22),
(2, 23),
(2, 24),
(2, 28),
(2, 36),
(2, 37),
(2, 38),
(2, 39),
(3, 1),
(3, 5),
(3, 8),
(3, 20),
(3, 22),
(3, 23),
(3, 24),
(3, 33),
(3, 34),
(3, 36),
(3, 38),
(3, 39),
(4, 4),
(4, 13),
(4, 14),
(4, 21),
(4, 22),
(4, 23),
(4, 24),
(4, 28),
(4, 37),
(4, 39),
(5, 1),
(5, 2),
(5, 3),
(5, 4),
(5, 6),
(5, 8),
(5, 12),
(5, 13),
(5, 14),
(5, 15),
(5, 16),
(5, 20),
(5, 22),
(5, 23),
(5, 24),
(5, 25),
(5, 26),
(5, 27),
(5, 28),
(5, 29),
(5, 30),
(5, 34),
(5, 36),
(5, 37),
(5, 38),
(5, 39);