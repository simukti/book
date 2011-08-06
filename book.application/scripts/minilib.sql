-- MySQL Workbench forward engineer

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';


-- -----------------------------------------------------
-- Table `books_author`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `books_author` ;

CREATE  TABLE IF NOT EXISTS `books_author` (
  `id_books_author` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `author_name` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`id_books_author`) ,
  UNIQUE INDEX `author_name_UNIQUE` (`author_name` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci
COMMENT = 'store category master data' ;


-- -----------------------------------------------------
-- Table `books_category`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `books_category` ;

CREATE  TABLE IF NOT EXISTS `books_category` (
  `id_books_category` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `category_name` VARCHAR(64) NOT NULL ,
  PRIMARY KEY (`id_books_category`) ,
  UNIQUE INDEX `category_name_UNIQUE` (`category_name` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci, 
COMMENT = 'store category master data' ;


-- -----------------------------------------------------
-- Table `books_publisher`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `books_publisher` ;

CREATE  TABLE IF NOT EXISTS `books_publisher` (
  `id_books_publisher` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `publisher_name` VARCHAR(64) NOT NULL ,
  PRIMARY KEY (`id_books_publisher`) ,
  UNIQUE INDEX `publisher_name_UNIQUE` (`publisher_name` ASC) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci, 
COMMENT = 'store publisher master data' ;


-- -----------------------------------------------------
-- Table `user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `user` ;

CREATE  TABLE IF NOT EXISTS `user` (
  `id_user` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `uname` VARCHAR(64) NOT NULL ,
  `password` VARCHAR(64) NOT NULL ,
  `fullname` VARCHAR(64) NOT NULL ,
  `email` VARCHAR(64) NOT NULL ,
  `role` VARCHAR(16) NOT NULL ,
  PRIMARY KEY (`id_user`) ,
  UNIQUE INDEX `uname_UNIQUE` (`uname` ASC) ,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) )
ENGINE = InnoDB, 
COMMENT = 'store user data' ;


-- -----------------------------------------------------
-- Table `books`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `books` ;

CREATE  TABLE IF NOT EXISTS `books` (
  `id_books` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `id_books_author` MEDIUMINT UNSIGNED NOT NULL ,
  `id_books_category` MEDIUMINT UNSIGNED NOT NULL ,
  `id_books_publisher` MEDIUMINT UNSIGNED NOT NULL ,
  `book_title` VARCHAR(140) NOT NULL ,
  `book_abstract` VARCHAR(1500) NOT NULL ,
  `isbn` VARCHAR(64) NOT NULL DEFAULT 'N/A' ,
  `year_published` YEAR NULL ,
  `date_added` TIMESTAMP NOT NULL DEFAULT NOW() ,
  `cover_filepath` VARCHAR(254) NOT NULL DEFAULT '/assets/cover/no_cover.jpg' ,
  `id_user` SMALLINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id_books`) ,
  INDEX `book_title` (`book_title` ASC) ,
  INDEX `book_abstract` (`book_abstract` ASC) ,
  INDEX `fk_books_books_author` (`id_books_author` ASC) ,
  INDEX `fk_books_books_publisher1` (`id_books_publisher` ASC) ,
  INDEX `fk_books_books_category1` (`id_books_category` ASC) ,
  INDEX `fk_books_user1` (`id_user` ASC) ,
  CONSTRAINT `fk_books_books_author`
    FOREIGN KEY (`id_books_author` )
    REFERENCES `books_author` (`id_books_author` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_books_books_publisher1`
    FOREIGN KEY (`id_books_publisher` )
    REFERENCES `books_publisher` (`id_books_publisher` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_books_books_category1`
    FOREIGN KEY (`id_books_category` )
    REFERENCES `books_category` (`id_books_category` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_books_user1`
    FOREIGN KEY (`id_user` )
    REFERENCES `user` (`id_user` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci, 
COMMENT = 'store books data' ;


-- -----------------------------------------------------
-- Table `books_review`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `books_review` ;

CREATE  TABLE IF NOT EXISTS `books_review` (
  `id_books_review` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(64) NOT NULL ,
  `email` VARCHAR(64) NOT NULL ,
  `review_time` TIMESTAMP NOT NULL DEFAULT NOW() ,
  `content` MEDIUMTEXT NOT NULL ,
  `id_books` BIGINT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id_books_review`) ,
  INDEX `fk_books_review_books1` (`id_books` ASC) ,
  CONSTRAINT `fk_books_review_books1`
    FOREIGN KEY (`id_books` )
    REFERENCES `books` (`id_books` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci, 
COMMENT = 'store books review data' ;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `books_author`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO books_author (`id_books_author`, `author_name`) VALUES (NULL, 'Unknown');

COMMIT;

-- -----------------------------------------------------
-- Data for table `books_category`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO books_category (`id_books_category`, `category_name`) VALUES (NULL, 'No Category');

COMMIT;

-- -----------------------------------------------------
-- Data for table `books_publisher`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO books_publisher (`id_books_publisher`, `publisher_name`) VALUES (NULL, 'Unknown');

COMMIT;


-- -----------------------------------------------------
-- Data for table `user`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `user` (`id_user`, `uname` ,`password` ,`fullname` ,`email`, `role`) VALUES (NULL , 'simukti', SHA1( 'simukti' ) , 'Sarjono Mukti Aji', 'simukti@live.com', 'admin');

COMMIT;