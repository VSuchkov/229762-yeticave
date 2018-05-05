INSERT into users (userName, email, password, contact, avatarPath, registrationDate)
VALUES ("Константин", "kos@mail.ru", "12345", "Москва", "img/user.jpg", ""),
("Вася", "vaso@mail.ru", "12345", "Рязань", "img/user2.jpg", "");

INSERT into categories (category)
VALUES ("Доски и лыжи", "Крепления", "Ботинки", "Одежда", "Инструменты", "Разное");

INSERT into items (userId, name, description, itemImg, categoryId, startPrice, dateOfEnd, betStep)
VALUES ("", "2014 Rossignol District Snowboard", "описание", "img/lot-1.jpg", "categoryId", "10999", "dateOfEnd", "betStep"), 
("", "DC Ply Mens 2016/2017 Snowboard", "описание", "img/lot-2.jpg", "categoryId", "159999", "dateOfEnd", "betStep"), 
("", "Крепления Union Contact Pro 2015 года размер L/XL", "описание", "img/lot-3.jpg", "categoryId", "8000", "dateOfEnd", "betStep"), 
("", "Ботинки для сноуборда DC Mutiny Charocal", "описание", "img/lot-4.jpg", "categoryId", "10999", "dateOfEnd", "betStep"), 
("", "Куртка для сноуборда DC Mutiny Charocal", "описание", "img/lot-5.jpg", "categoryId", "7500", "dateOfEnd", "betStep"),
("", "Маска Oakley Canopy", "описание", "img/lot-6.jpg", "categoryId", "5400", "dateOfEnd", "betStep");

INSERT into bet (userId, itemId, summ, betDate);

VALUES ("", "", "", "");
