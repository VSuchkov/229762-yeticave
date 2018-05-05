DROP DATABASE IF EXISTS `yeticave`;

CREATE DATABASE yeticave
DEFAULT CHARACTER SET utf8
DEFAULT COLLATE utf8_general_ci;

USE yeticave;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    userName CHAR(128),
    email    CHAR(128),
    password CHAR(64),
    contact CHAR(255),
    avtarPath CHAR(255),
    registrationDate DATE

);

CREATE TABLE bet (
  id INT AUTO_INCREMENT PRIMARY KEY,
  userId INT,
  itemId INT,
  summ INT,
  betDate DATE
);

CREATE TABLE items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    userId INT,
    name CHAR(128),
    description CHAR(255),
    itemImg CHAR(128),
    categoryId INT,
    startPrice INT,
    dateOfEnd DATE,
    betStep INT
);

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category CHAR(255)
);

