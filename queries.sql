INSERT into users (userName, email, password, contact, avatarPath, registrationDate)
VALUES ("Константин", "kos@mail.ru", "12345", "Москва", "img/user.jpg", "14-04-2018"),
("Вася", "vaso@mail.ru", "12345", "Рязань", "img/user2.jpg", "23-04-2018");

INSERT into categories (category)
VALUES ("Доски и лыжи"), ("Крепления"), ("Ботинки"), ("Одежда"), ("Инструменты"), ("Разное");

INSERT into items (userId, itemName, description, itemImg, categoryId, startPrice, dateOfEnd, betStep)
VALUES ("1", "2014 Rossignol District Snowboard", "описание", "img/lot-1.jpg", "1", "10999", "2018-12-31", "111"),
("1", "DC Ply Mens 2016/2017 Snowboard", "описание", "img/lot-2.jpg", "1", "159999", "2018-12-31", "111"),
("1", "Крепления Union Contact Pro 2015 года размер L/XL", "описание", "img/lot-3.jpg", "2", "8000", "2018-12-31", "111"),
("2", "Ботинки для сноуборда DC Mutiny Charocal", "описание", "img/lot-4.jpg", "3", "10999", "2018-12-31", "111"),
("2", "Куртка для сноуборда DC Mutiny Charocal", "описание", "img/lot-5.jpg", "4", "7500", "2018-12-31", "111"),
("2", "Маска Oakley Canopy", "описание", "img/lot-6.jpg", "6", "5400", "2018-12-31", "111");

INSERT into bets (userId, itemId, summ, betDate);

VALUES ("1", "1", "10999", "2018-05-06"),
("2", "4", "10999", "2018-05-05");

-- получить все категории

SELECT * FROM "categories"

-- получаем новые открытые лоты

SELECT * FROM "items", where dateOfEnd >= "сегодня"

-- показываем лот по его id

SELECT itemName FROM items
WHERE id = 10;

-- показываем категорию по id

SELECT category FROM categories WHERE id = 5;

-- обновлияем название лота по  его иденитификатору

UPDATE items SET itemName = "значение"
WHERE id = 4;

-- получаем самые свежие ставки

SELECT bets WHERE itemId = "3" ORDER BY betDate DESC;