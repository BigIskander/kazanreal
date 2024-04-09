-- phpMyAdmin SQL Dump
-- version 2.6.1
-- http://www.phpmyadmin.net
-- 
-- ����: localhost
-- ����� ��������: ��� 09 2024 �., 19:36
-- ������ �������: 4.1.16
-- ������ PHP: 4.4.4
-- 
-- ��: `kazanreal`
-- 

-- --------------------------------------------------------

-- 
-- ��������� ������� `config`
-- 

CREATE TABLE `config` (
  `ID` int(11) NOT NULL auto_increment,
  `pname` varchar(255) NOT NULL default '',
  `content` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `pname` (`pname`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=5 ;

-- 
-- ���� ������ ������� `config`
-- 

INSERT INTO `config` VALUES (1, 'user', 'Iskander');
INSERT INTO `config` VALUES (2, 'pass', '34819d7beeabb9260a5c854bc85b3e44');
INSERT INTO `config` VALUES (3, 'mail', 'my@email');
INSERT INTO `config` VALUES (4, 'rsize', '0');

-- --------------------------------------------------------

-- 
-- ��������� ������� `galery`
-- 

CREATE TABLE `galery` (
  `ID` int(11) NOT NULL auto_increment,
  `sort` int(11) NOT NULL default '0',
  `name` varchar(255) default NULL,
  `cdate` datetime default '0000-00-00 00:00:00',
  `udate` datetime default '0000-00-00 00:00:00',
  `mimage` int(11) default '0',
  `icols` int(11) default '0',
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=111 ;

-- 
-- ���� ������ ������� `galery`
-- 

INSERT INTO `galery` VALUES (37, 38, 'Моя казань', NULL, NULL, 3, 42);
INSERT INTO `galery` VALUES (38, 37, 'Казанский кремль', NULL, NULL, 54, 52);
INSERT INTO `galery` VALUES (39, 39, 'Булак', NULL, NULL, 10, 52);
INSERT INTO `galery` VALUES (40, 40, ' Орнаменты', NULL, NULL, 123, 54);
INSERT INTO `galery` VALUES (41, 41, 'Старина', NULL, NULL, 9, 3);

-- --------------------------------------------------------

-- 
-- ��������� ������� `images`
-- 

CREATE TABLE `images` (
  `ID` int(11) NOT NULL auto_increment,
  `ID_gal` int(11) NOT NULL default '0',
  `sort` int(11) NOT NULL default '0',
  `image` varchar(255) NOT NULL default '',
  `cdate` datetime default NULL,
  `title` varchar(255) default NULL,
  `rsize` int(11) default NULL,
  `width` int(11) NOT NULL default '0',
  `height` int(11) NOT NULL default '0',
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1251 AUTO_INCREMENT=538 ;

-- 
-- ���� ������ ������� `images`
-- 

INSERT INTO `images` VALUES (3, 37, 3, '3.jpg', NULL, 'Карета на улице Баумана!', 0, 640, 360);
INSERT INTO `images` VALUES (4, 41, 3, '4.jpg', NULL, 'ул. Баумана , рис 1', 0, 640, 360);
INSERT INTO `images` VALUES (5, 41, 4, '5.jpg', NULL, 'ул. Баумана , рис 2', 0, 640, 360);
INSERT INTO `images` VALUES (6, 37, 6, '6.jpg', NULL, 'Часть старого здания на улице Баумана!', 0, 640, 360);
INSERT INTO `images` VALUES (9, 41, 9, '9.jpg', NULL, 'ул. Баумана , рис 3', 0, 640, 360);
INSERT INTO `images` VALUES (10, 39, 10, '10.jpg', NULL, 'Вид на Лево-Булачную улицу!', 0, 640, 360);
INSERT INTO `images` VALUES (12, 39, 12, '12.jpg', NULL, 'Лево-Булачная!', 0, 640, 360);
INSERT INTO `images` VALUES (14, 39, 14, '14.jpg', NULL, 'Фонтаны на Булаке(1)!', 0, 640, 360);
INSERT INTO `images` VALUES (15, 39, 15, '15.jpg', NULL, 'Фонтаны на Булаке!(2)', 0, 640, 360);
INSERT INTO `images` VALUES (16, 38, 277, '16.jpg', NULL, 'Фонтаны на Булаке!', 0, 640, 360);
INSERT INTO `images` VALUES (17, 37, 17, '17.jpg', NULL, 'Фонтаны на Булаке!', 0, 640, 360);
INSERT INTO `images` VALUES (20, 37, 20, '20.jpg', NULL, 'Радуга (на Булаке)', 0, 640, 360);
INSERT INTO `images` VALUES (21, 37, 21, '21.jpg', NULL, 'Ак Барс (цветочная композиция)', 0, 640, 360);
INSERT INTO `images` VALUES (22, 37, 22, '22.jpg', NULL, 'Цветочная композиция!', 0, 640, 360);
INSERT INTO `images` VALUES (24, 37, 24, '24.jpg', NULL, 'Театр имени Г. Камала', 0, 640, 360);
INSERT INTO `images` VALUES (25, 37, 25, '25.jpg', NULL, 'Здание пенсионного фонда!', 0, 640, 360);
INSERT INTO `images` VALUES (26, 37, 26, '26.jpg', NULL, 'Вид на улицу Баумана с улицы Петербургской!', 0, 640, 360);
INSERT INTO `images` VALUES (28, 37, 28, '28.jpg', NULL, 'ул. Петербургская', 0, 640, 360);
INSERT INTO `images` VALUES (30, 37, 30, '30.jpg', NULL, 'ул. Петербургская(1)', 0, 640, 360);
INSERT INTO `images` VALUES (32, 37, 32, '32.jpg', NULL, 'ул. Петербургская(2)', 0, 640, 360);
INSERT INTO `images` VALUES (34, 37, 34, '34.jpg', NULL, 'ул. Петербургская(3)', 0, 640, 360);
INSERT INTO `images` VALUES (38, 37, 38, '38.jpg', NULL, 'Фонари на улице Петербургской', 0, 640, 360);
INSERT INTO `images` VALUES (40, 37, 40, '40.jpg', NULL, 'ул. Петербургская(4)', 0, 640, 360);
INSERT INTO `images` VALUES (41, 37, 41, '41.jpg', NULL, 'ул. Петербургская(5)', 0, 640, 360);
INSERT INTO `images` VALUES (54, 38, 54, '54.jpg', NULL, 'Вид на Казанский Кремль.(1)', 0, 640, 360);
INSERT INTO `images` VALUES (56, 37, 56, '56.jpg', NULL, 'Вход в метро, вдали виден цирк!', 0, 640, 360);
INSERT INTO `images` VALUES (58, 38, 58, '58.jpg', NULL, 'Спуск с улицы Кремлевской!', 0, 640, 360);
INSERT INTO `images` VALUES (60, 38, 60, '60.jpg', NULL, 'Вид на Казанский Кремль.(2)', 0, 640, 360);
INSERT INTO `images` VALUES (61, 37, 61, '61.jpg', NULL, 'Спуск с улицы Кремлевская!', 0, 640, 360);
INSERT INTO `images` VALUES (63, 37, 63, '63.jpg', NULL, 'Вид на город, с права виден кусочек Кремля!', 0, 640, 360);
INSERT INTO `images` VALUES (64, 37, 64, '64.jpg', NULL, 'фото', 0, 640, 360);
INSERT INTO `images` VALUES (65, 37, 65, '65.jpg', NULL, 'Памятник Мусы Джалиля возле Казанского Кремля!', 0, 640, 360);
INSERT INTO `images` VALUES (70, 38, 70, '70.jpg', NULL, 'Мечеть Кул Шариф!(вид нижней части)', 0, 640, 360);
INSERT INTO `images` VALUES (79, 38, 79, '79.jpg', NULL, 'Мечеть Кул Шариф!', 0, 360, 640);
INSERT INTO `images` VALUES (80, 38, 80, '80.jpg', NULL, 'Мечеть Кул Шариф!(1)', 0, 640, 360);
INSERT INTO `images` VALUES (81, 38, 81, '81.jpg', NULL, 'Мечеть Кул Шариф!(2)', 0, 640, 360);
INSERT INTO `images` VALUES (82, 38, 82, '82.jpg', NULL, 'Мечеть Кул Шариф!(3)', 0, 640, 360);
INSERT INTO `images` VALUES (83, 38, 83, '83.jpg', NULL, 'Мечеть Кул Шариф!(в полную высоту)', 0, 360, 640);
INSERT INTO `images` VALUES (85, 38, 85, '85.jpg', NULL, 'Территория Казанского кремля!', 0, 640, 360);
INSERT INTO `images` VALUES (88, 38, 88, '88.jpg', NULL, 'Территория Казанского Кремля(1)', 0, 640, 360);
INSERT INTO `images` VALUES (89, 36, 89, '89.jpg', NULL, 'Церковь!', 0, 640, 360);
INSERT INTO `images` VALUES (90, 36, 90, '90.jpg', NULL, 'Церковь!(1)', 0, 640, 360);
INSERT INTO `images` VALUES (91, 38, 91, '91.jpg', NULL, 'Территория Казанского кремля!(2)', 0, 640, 360);
INSERT INTO `images` VALUES (92, 36, 92, '92.jpg', NULL, 'Здание на територии казанского кремля!', 0, 640, 360);
INSERT INTO `images` VALUES (93, 38, 93, '93.jpg', NULL, 'Башня Сююмбике', 0, 360, 640);
INSERT INTO `images` VALUES (94, 38, 94, '94.jpg', NULL, 'Территория Казанского Кремля!(3)', 0, 640, 360);
INSERT INTO `images` VALUES (95, 38, 95, '95.jpg', NULL, 'Территория Казанского Кремля!(4)', 0, 640, 360);
INSERT INTO `images` VALUES (96, 38, 96, '96.jpg', NULL, 'Территория Казанского Кремля!(5)', 0, 640, 360);
INSERT INTO `images` VALUES (97, 38, 97, '97.jpg', NULL, 'фото', 0, 640, 360);
INSERT INTO `images` VALUES (98, 38, 98, '98.jpg', NULL, 'Вид на стену Казанского Кремля!', 0, 640, 360);
INSERT INTO `images` VALUES (99, 37, 99, '99.jpg', NULL, 'Вид на Казань с територии Кремля!', 0, 640, 360);
INSERT INTO `images` VALUES (100, 38, 100, '100.jpg', NULL, 'Территория Казанского кремля!(6)', 0, 640, 360);
INSERT INTO `images` VALUES (104, 38, 104, '104.jpg', NULL, 'Ворота башни Сююмбике!', 0, 640, 360);
INSERT INTO `images` VALUES (105, 38, 105, '105.jpg', NULL, 'Нижняя часть Башни Сююмбике!', 0, 640, 360);
INSERT INTO `images` VALUES (107, 38, 107, '107.jpg', NULL, 'фото 2', 0, 640, 360);
INSERT INTO `images` VALUES (111, 38, 111, '111.jpg', NULL, 'Территория Казанского Кремля!(7)', 0, 640, 360);
INSERT INTO `images` VALUES (112, 38, 112, '112.jpg', NULL, 'фото 3', 0, 640, 360);
INSERT INTO `images` VALUES (113, 38, 113, '113.jpg', NULL, 'Территория Казанского Кремля(8)!', 0, 640, 360);
INSERT INTO `images` VALUES (114, 38, 114, '114.jpg', NULL, 'Стена Казанского Кремля изнутри(3)!', 0, 640, 360);
INSERT INTO `images` VALUES (118, 38, 118, '118.jpg', NULL, 'Сторожевая башня!', 0, 360, 640);
INSERT INTO `images` VALUES (119, 38, 119, '119.jpg', NULL, 'Территория Казанского Кремля(9)!', 0, 640, 360);
INSERT INTO `images` VALUES (123, 40, 122, '123.jpg', NULL, 'Ворота Башни Cююмбике! (верхняя часть)', 0, 640, 360);
INSERT INTO `images` VALUES (127, 40, 126, '127.jpg', NULL, 'Ворота Башни Cююмбике! (нижняя часть)', 0, 640, 360);
INSERT INTO `images` VALUES (128, 40, 128, '128.jpg', NULL, 'Ворота Cююмбике! (нижняя часть с частью стены)', 0, 640, 360);
INSERT INTO `images` VALUES (130, 37, 130, '130.jpg', NULL, 'Вид на город!', 0, 640, 360);
INSERT INTO `images` VALUES (133, 38, 133, '133.jpg', NULL, 'Фонтан', 0, 640, 360);
INSERT INTO `images` VALUES (135, 36, 135, '135.jpg', NULL, 'Ворота у здания!', 0, 640, 360);
INSERT INTO `images` VALUES (142, 38, 142, '142.jpg', NULL, 'Памятник зодчим Казанского Кремля!', 0, 640, 360);
INSERT INTO `images` VALUES (143, 40, 129, '143.jpg', NULL, 'Часть невысокой ограды на территории Казанского Кремля!', 0, 640, 360);
INSERT INTO `images` VALUES (148, 38, 148, '148.jpg', NULL, 'Фото', 0, 640, 360);
INSERT INTO `images` VALUES (155, 38, 155, '155.jpg', NULL, ' Фото 2', 0, 640, 360);
INSERT INTO `images` VALUES (159, 38, 159, '159.jpg', NULL, 'Фото 3', 0, 640, 360);
INSERT INTO `images` VALUES (165, 38, 165, '165.jpg', NULL, 'На стене Казанского Кремля!', 0, 640, 360);
INSERT INTO `images` VALUES (169, 37, 169, '169.jpg', NULL, 'Вид на город с Кремлевской стены!', 0, 640, 360);
INSERT INTO `images` VALUES (172, 38, 172, '172.jpg', NULL, 'Спуск со стены Казанского Кремля.', 0, 360, 640);
INSERT INTO `images` VALUES (173, 38, 173, '173.jpg', NULL, 'фото 4', 0, 640, 360);
INSERT INTO `images` VALUES (174, 38, 174, '174.jpg', NULL, 'фото 5', 0, 640, 360);
INSERT INTO `images` VALUES (176, 38, 176, '176.jpg', NULL, 'У выхода с Казанского Кремля!', 0, 640, 360);
INSERT INTO `images` VALUES (178, 36, 178, '178.jpg', NULL, 'Музей!', 0, 640, 360);
INSERT INTO `images` VALUES (179, 38, 179, '179.jpg', NULL, 'фото 6', 0, 640, 360);
INSERT INTO `images` VALUES (180, 38, 180, '180.jpg', NULL, 'фото 7', 0, 640, 360);
INSERT INTO `images` VALUES (181, 37, 181, '181.jpg', NULL, 'фото', 0, 640, 360);
INSERT INTO `images` VALUES (183, 37, 183, '183.jpg', NULL, 'Пирамида в городе Казань!', 0, 640, 360);
INSERT INTO `images` VALUES (185, 36, 185, '185.jpg', NULL, 'Памятник Мусы Джалиля, с права Национальный музей!', 0, 640, 360);
INSERT INTO `images` VALUES (190, 38, 190, '190.jpg', NULL, 'Стена Казанского Кремля!(с наружи)', 0, 640, 360);
INSERT INTO `images` VALUES (194, 37, 194, '194.jpg', NULL, 'Казанскй цирк!', 0, 640, 360);
INSERT INTO `images` VALUES (196, 37, 196, '196.jpg', NULL, 'Казанский цирк!(1)', 0, 640, 360);
INSERT INTO `images` VALUES (200, 38, 200, '200.jpg', NULL, 'Лестница у стены Казанского Кремля!', 0, 640, 360);
INSERT INTO `images` VALUES (201, 37, 201, '201.jpg', NULL, 'Снято возле стены Казанского кремля.', 0, 640, 360);
INSERT INTO `images` VALUES (202, 37, 202, '202.jpg', NULL, 'Снято возле стены Казанского кремля.(1)', 0, 640, 360);
INSERT INTO `images` VALUES (203, 37, 203, '203.jpg', NULL, 'Снято возле стены Казанского кремля.(2)', 0, 640, 360);
INSERT INTO `images` VALUES (204, 38, 204, '204.jpg', NULL, 'Мечеть Кул Шариф!(снято с наружи, на переднем плане виден кусочек кремлевской стены)', 0, 640, 360);
INSERT INTO `images` VALUES (207, 38, 207, '207.jpg', NULL, 'Вид на город (возле Казанского Кремля)!', 0, 640, 360);
INSERT INTO `images` VALUES (211, 38, 211, '211.jpg', NULL, 'Вид на Казанский Кремль вечером!', 0, 640, 360);
INSERT INTO `images` VALUES (213, 38, 213, '213.jpg', NULL, 'Вид на Казанский Кремль вечером!(1)', 0, 640, 360);
INSERT INTO `images` VALUES (214, 38, 214, '214.jpg', NULL, 'Вид на Казанский Кремль вечером!(2)', 0, 640, 360);
INSERT INTO `images` VALUES (226, 38, 226, '226.jpg', NULL, 'Вид на Казанский Кремль вечером!(3)', 0, 640, 360);
INSERT INTO `images` VALUES (232, 37, 232, '232.jpg', NULL, 'Вид на пирамиду!', 0, 640, 360);
INSERT INTO `images` VALUES (234, 38, 234, '234.jpg', NULL, 'Вид на казанский кремль вечером!(4)', 0, 360, 640);
INSERT INTO `images` VALUES (243, 39, 243, '243.jpg', NULL, 'Фонтаны на Булаке!(3)', 0, 640, 360);
INSERT INTO `images` VALUES (245, 39, 245, '245.jpg', NULL, 'Фонтаны на Булаке!(4)', 0, 640, 360);
INSERT INTO `images` VALUES (246, 39, 246, '246.jpg', NULL, 'Фонтаны на Булаке (справа Лево-Булачная, слева Право-Булачная улицы)!', 0, 640, 360);
INSERT INTO `images` VALUES (250, 37, 250, '250.jpg', NULL, 'Вид на пирамиду!(1)', 0, 640, 360);
INSERT INTO `images` VALUES (257, 39, 257, '257.jpg', NULL, 'Фонтаны на Булаке!', 0, 640, 360);
INSERT INTO `images` VALUES (258, 37, 258, '258.jpg', NULL, 'Мост через реку Казанка около Кремля!', 0, 640, 360);
INSERT INTO `images` VALUES (259, 37, 259, '267.jpg', NULL, 'Вид на город с моста через Казанку!', 0, 640, 360);
INSERT INTO `images` VALUES (264, 37, 264, '272.jpg', NULL, 'Мост Миллениум!', 0, 640, 360);
INSERT INTO `images` VALUES (267, 37, 267, '259.jpg', NULL, 'фото 2', 0, 640, 360);
INSERT INTO `images` VALUES (269, 38, 269, '269.jpg', NULL, 'Вид на Казанский Кремль вечером!(5)', 0, 640, 360);
INSERT INTO `images` VALUES (272, 37, 272, '264.jpg', NULL, 'Кремль с набережной Казанки!', 0, 640, 360);
INSERT INTO `images` VALUES (276, 38, 276, '276.jpg', NULL, 'Вид на Казанский Кремль вечером!(6)', 0, 640, 360);
INSERT INTO `images` VALUES (277, 37, 277, '277.jpg', NULL, 'Парк Шурале', 0, 640, 360);
INSERT INTO `images` VALUES (280, 37, 280, '280.jpg', NULL, 'Парк Шурале -1', 0, 640, 360);
INSERT INTO `images` VALUES (281, 37, 281, '281.jpg', NULL, 'Парк Шурале -2', 0, 640, 360);
INSERT INTO `images` VALUES (285, 37, 285, '285.jpg', NULL, 'Парк Шурале -3', 0, 640, 360);
        