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
INSERT INTO user VALUES (1, 'Алексей','Малютин','+79818573314', 20, 'M', 1, 'Alexey', 'malutin.alex@gmail.com', '0dd3e512642c97ca3f747f9a76e374fbda73f9292823c0313be9d78add7cdd8f72235af0c553dd26797e78e1854edee0ae002f8aba074b066dfce1af114e32f8', '0dd3e512642c97ca3f747f9a76e374fbda73f9292823c0313be9d78add7cdd8f72235af0c553dd26797e78e1854edee0ae002f8aba074b066dfce1af114e32f8'),
(2, 'Дарья','','', 18, 'F', 2, 'Denali', '', 'b99fef31fa25246f1dac85ac660f49d62af403aa0c9012d2946f1f6a7c03c8871361a709272775f23efacc64f59d607b7beae2e030ac7cca92f1557f4698db6f', '2e3fce77cf8c4c7478a96d207c1c39715892cac84a18cbec9b634f4bc22b390b48cd30a4df2e7ebbaee65c346a662c5be2d12441322f7a4bac821a382c4af091'),
(3, 'User Example','','', 20, 'M', 3, 'Example', '', '4dff4ea340f0a823f15d3f4f01ab62eae0e5da579ccb851f8db9dfe84c58b2b37b89903a740e1ee172da793a6e79d560e5f7f9bd058a12a280433ed6fa46510a', '2e3fce77cf8c4c7478a96d207c1c39715892cac84a18cbec9b634f4bc22b390b48cd30a4df2e7ebbaee65c346a662c5be2d12441322f7a4bac821a382c4af091');
COMMIT;