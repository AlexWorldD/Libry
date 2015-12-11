SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP SCHEMA IF EXISTS libry;
CREATE SCHEMA libry  DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE libry;

--
-- Table structure for table `writing`
--
CREATE TABLE writing (
	writing_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    title VARCHAR(128) NOT NULL,
    release_year YEAR DEFAULT NULL,
    page_num TINYINT UNSIGNED DEFAULT NULL,
    description TEXT,
    lang TINYINT UNSIGNED NOT NULL,
    lang_origin TINYINT UNSIGNED NOT NULL,
    PRIMARY KEY (writing_id),
    INDEX idx_fk_lang (lang),
    INDEX idx_fk_lang_original (lang_origin),
    CONSTRAINT fk_writing_lang FOREIGN KEY (lang) REFERENCES language (language_id) ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT fk_writing_lang_original FOREIGN KEY (lang_origin) REFERENCES language (language_id) ON DELETE RESTRICT ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
--
-- Table structure for table `author`
--
CREATE TABLE author (
	author_id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(32) NOT NULL,
    last_name VARCHAR(64) NOT NULL,
    patronymic VARCHAR(64) DEFAULT NULL,
    year_born YEAR DEFAULT NULL,
    year_death YEAR DEFAULT NULL,
    country_id TINYINT UNSIGNED NOT NULL,
    PRIMARY KEY (author_id),
    INDEX idx_fk_country_id (country_id),
    CONSTRAINT `fk_country_id` FOREIGN KEY (country_id) REFERENCES country (country_id)  ON DELETE RESTRICT ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
--
-- Table structure for table `language`
--
CREATE TABLE language (
	language_id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    lang VARCHAR(32) NOT NULL,
    PRIMARY KEY (language_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
--
-- Table structure for table `book`
--
CREATE TABLE book (
	book_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    writing_id INT UNSIGNED NOT NULL,
    numbers TINYINT UNSIGNED DEFAULT NULL,
    PRIMARY KEY (book_id),
    INDEX idx_fk_writing_id (writing_id),
    CONSTRAINT fk_book_writing FOREIGN KEY (writing_id) REFERENCES writing (writing_id) ON DELETE RESTRICT ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
--
-- Table structure for table `author_writing`
--
CREATE TABLE author_writing (
	author_id SMALLINT UNSIGNED NOT NULL,
    writing_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (author_id, writing_id),
    INDEX idx_fk_writing_id (writing_id),
    CONSTRAINT fk_author_writing_author FOREIGN KEY (author_id) REFERENCES author (author_id) ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT fk_author_writing_writing FOREIGN KEY (writing_id) REFERENCES writing (writing_id) ON DELETE RESTRICT ON UPDATE CASCADE
    
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
--
-- Table structure for table `common_books`
--
CREATE TABLE common_books (
	book_id INT UNSIGNED NOT NULL,
    user_id INT UNSIGNED NOT NULL,
    PRIMARY KEY (book_id, user_id),
    INDEX idx_fk_book_id (`book_id`),
    INDEX idx_fk_lcommon_books_user (user_id),
    CONSTRAINT fk_common_books_book FOREIGN KEY (book_id) REFERENCES book (book_id) ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT fk_common_books_user FOREIGN KEY (user_id) REFERENCES user (user_id) ON DELETE RESTRICT ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
--
-- Table structure for table `user`
--
CREATE TABLE user (
	user_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(32) NOT NULL,
    last_name VARCHAR(64) NOT NULL,
    phone VARCHAR(16) DEFAULT NULL,
    age TINYINT UNSIGNED DEFAULT NULL,
    sex ENUM('F', 'M') DEFAULT NULL,
    -- TODO change adress_id to NOT NULL!!!
    address_id INT UNSIGNED DEFAULT NULL,
-- TODO make secure.
-- INFO for Login
	username VARCHAR(32) NOT NULL,
    email VARCHAR(64) NOT NULL,
    password CHAR(128) NOT NULL,
    salt CHAR(128) NOT NULL,
    PRIMARY KEY (user_id),
    INDEX idx_fk_address_id (address_id),
    CONSTRAINT fk_user_address FOREIGN KEY (address_id) REFERENCES address (address_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
--
-- Table structure for table `want_read`
--
CREATE TABLE want_read (
	user_id INT UNSIGNED NOT NULL,
    writing_id INT UNSIGNED NOT NULL,
    PRIMARY KEY (user_id, writing_id),
    INDEX idx_fk_writing_id (writing_id),
    CONSTRAINT fk_want_read_user FOREIGN KEY (user_id) REFERENCES user (user_id) ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT fk_want_read_writing FOREIGN KEY (writing_id) REFERENCES writing (writing_id) ON DELETE RESTRICT ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
--
-- Table structure for table `address`
--
CREATE TABLE address (
	address_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    address VARCHAR(50) NOT NULL,
	address2 VARCHAR(50) DEFAULT NULL,
	city_id SMALLINT UNSIGNED NOT NULL,
    PRIMARY KEY (address_id),
    INDEX idx_fk_city_id (city_id),
    CONSTRAINT `fk_city_id` FOREIGN KEY (city_id) REFERENCES city (city_id) ON DELETE RESTRICT ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
--
-- Table structure for table `city`
--
CREATE TABLE city (
	city_id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
    city VARCHAR(64) NOT NULL,
    country_id TINYINT UNSIGNED NOT NULL,
    PRIMARY KEY (city_id),
    INDEX idx_fk_country_id (country_id),
    CONSTRAINT `fk_city_country` FOREIGN KEY (country_id) REFERENCES country (country_id) ON DELETE RESTRICT ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
--
-- Table structure for table `country`
--
CREATE TABLE country (
	country_id TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
    country VARCHAR(64) NOT NULL,
    PRIMARY KEY (country_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
--
-- Table structure for table `rental`
--
CREATE TABLE rental (
	rental_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    book_id INT UNSIGNED NOT NULL,
    user_from INT UNSIGNED NOT NULL,
    user_to INT UNSIGNED NOT NULL,
    rental_date DATE NOT NULL,
    return_date DATE DEFAULT NULL,
    PRIMARY KEY (rental_id),
    UNIQUE KEY  (rental_date,book_id,user_to),
    INDEX idx_fk_book_id (book_id),
	INDEX idx_fk_user_from (user_from),
	INDEX idx_fk_user_to (user_to),
	CONSTRAINT fk_rental_book_id FOREIGN KEY (book_id) REFERENCES book (book_id) ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT fk_rental_user_from FOREIGN KEY (user_from) REFERENCES user (user_id) ON DELETE RESTRICT ON UPDATE CASCADE,
	CONSTRAINT fk_rental_user_to FOREIGN KEY (user_to) REFERENCES user (user_id) ON DELETE RESTRICT ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
