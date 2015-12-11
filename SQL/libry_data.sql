SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

USE libry;
--
-- Dumping data for table language
--
SET AUTOCOMMIT=0;
INSERT INTO language VALUES (1, 'Русский'),
(2, 'Английский'),
(3, 'Французский'),
(4, 'Немецкий'),
(5, 'Итальянский'),
(6, 'Греческий');
COMMIT;
--
-- Dumping data for table country
--
SET AUTOCOMMIT=0;
INSERT INTO country VALUES (1, 'Россия'),
(2, 'США'),
(3, 'Великобритания'),
(4, 'Германия'),
(5, 'Франция'),
(6, 'Италия'),
(7, 'Греция'),
(8, 'Белоруссия');
COMMIT;
--
-- Dumping data for table city
--
SET AUTOCOMMIT=0;
INSERT INTO city VALUES (1, 'Санкт-Петербург', 1),
(2, 'Москва', 1),
(3, 'Пермь', 1),
(4, 'Сочи', 1),
(5, 'Владивосток', 1),
(6, 'Нью-Йорк', 2),
(7, 'Лас-Вегас', 2),
(8, 'Лондон', 3),
(9, 'Ливерпуль', 3),
(10, 'Минск', 8);
COMMIT;
--
-- Dumping data for table user
--
SET AUTOCOMMIT=0;
INSERT INTO user VALUES (1, 'Алексей','Малютин','+79818573314', 20, 'M', 1, 'Alexey', 'malutin.alex@gmail.com', 'ab75e606d18188a7a4fd8149105c76df5e4cda83b54776c62dd264c4e2875745cea60eefb3c79faf8cc88551deb2645a1452822bc34d0ead18f62b8e0221ad86', '2e3fce77cf8c4c7478a96d207c1c39715892cac84a18cbec9b634f4bc22b390b48cd30a4df2e7ebbaee65c346a662c5be2d12441322f7a4bac821a382c4af091'),
(2, 'Дарья','','', 18, 'F', 2, 'Denali', '', 'ea7f99bae841fd6791972141813ca6385a0cfc77e11f971283152125671550081cd24614b4981243e65108dac21beecc5ff416bdfb4b4d06d4fd9c8851fb40d3', '2e3fce77cf8c4c7478a96d207c1c39715892cac84a18cbec9b634f4bc22b390b48cd30a4df2e7ebbaee65c346a662c5be2d12441322f7a4bac821a382c4af091'),
(3, 'User Example','','', 20, 'M', 3, 'Example', '', 'bb3a87676198b7d1d99ad592478bdd7e6d8bf23703277a88eec60b1586df6e6e3e8692f13d73f20dd551850a868eb8cdeba395cdfb9aef516c77d102440eebb9', '2e3fce77cf8c4c7478a96d207c1c39715892cac84a18cbec9b634f4bc22b390b48cd30a4df2e7ebbaee65c346a662c5be2d12441322f7a4bac821a382c4af091');
COMMIT;
--
-- Dumping data for table address
--
SET AUTOCOMMIT=0;
INSERT INTO address VALUES (1, 'Ботаническая, 64/3', '' , 1),
(2, 'Ботаническая, 64/2', '' , 1);
COMMIT;