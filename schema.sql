DROP DATABASE IF EXISTS `yeticave`;

CREATE DATABASE yeticave
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;

USE yeticave;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    userName CHAR(128),
    email CHAR(128),
    password CHAR(64),
    contact CHAR(255),
    avatarPath CHAR(255),
    registrationDate DATE
);

INSERT into users (userName, email, password, contact, avatarPath, registrationDate)
VALUES ("Константин", "kos@mail.ru", "12345", "Москва", "img/user.jpg", "2018-04-14"),
("Вася", "vaso@mail.ru", "12345", "Рязань", "img/user2.jpg", "2018-04-14");

CREATE TABLE bets (
  id INT AUTO_INCREMENT PRIMARY KEY,
  userId INT,
  itemId INT,
  summ INT,
  betDate DATE
);

INSERT INTO bets (userId, itemId, summ, betDate)
VALUES ("1", "1", "10999", "2018-05-06"),
("2", "4", "10999", "2018-05-05");

CREATE TABLE items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    userId INT,
    itemName CHAR(128),
    description CHAR(255),
    itemImg CHAR(128),
    categoryId INT,
    startPrice INT,
    dateOfEnd DATE,
    betStep INT
);


INSERT into items (userId, itemName, description, itemImg, categoryId, startPrice, dateOfEnd, betStep)
VALUES ("1", "2014 Rossignol District Snowboard", "описание", "img/lot-1.jpg", "1", "10999", "2018-12-31", "111"),
("1", "DC Ply Mens 2016/2017 Snowboard", "описание", "img/lot-2.jpg", "1", "159999", "2018-12-31", "111"),
("1", "Крепления Union Contact Pro 2015 года размер L/XL", "описание", "img/lot-3.jpg", "2", "8000", "2018-12-31", "111"),
("2", "Ботинки для сноуборда DC Mutiny Charocal", "описание", "img/lot-4.jpg", "3", "10999", "2018-12-31", "111"),
("2", "Куртка для сноуборда DC Mutiny Charocal", "описание", "img/lot-5.jpg", "4", "7500", "2018-12-31", "111"),
("2", "Маска Oakley Canopy", "описание", "img/lot-6.jpg", "6", "5400", "2018-12-31", "111");

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category CHAR(255)
);

INSERT into categories (category)
VALUES ("Доски и лыжи"), ("Крепления"), ("Ботинки"), ("Одежда"), ("Инструменты"), ("Разное");

