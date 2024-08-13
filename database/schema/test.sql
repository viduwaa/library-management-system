-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema library-system
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema library-system
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `library-system` DEFAULT CHARACTER SET utf8 ;
USE `library-system` ;

-- -----------------------------------------------------
-- Table `library-system`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `library-system`.`users` (
  `user_id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `mobile_no` VARCHAR(45) NOT NULL,
  `password` TEXT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE INDEX `mobile_no_UNIQUE` (`mobile_no` ASC) ,
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `library-system`.`books`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `library-system`.`books` (
  `books_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `author` VARCHAR(45) NULL,
  `genre` VARCHAR(45) NULL,
  `cover` LONGTEXT NULL,
  `quantity` INT NULL,
  PRIMARY KEY (`books_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `library-system`.`borrowed_books`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `library-system`.`borrowed_books` (
  `book_id` INT NOT NULL,
  `user_mobile` VARCHAR(45) NOT NULL,
  `borrow_date` DATETIME NULL,
  `return_date` DATETIME NULL,
  PRIMARY KEY (`book_id`, `user_mobile`),  -- Composite primary key
  INDEX `fk_books_has_users_books_idx` (`book_id` ASC),
  INDEX `books_has_users_idx` (`user_mobile` ASC),
  CONSTRAINT `fk_books_has_users_books`
    FOREIGN KEY (`book_id`)
    REFERENCES `library-system`.`books` (`books_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `books_has_users`
    FOREIGN KEY (`user_mobile`)
    REFERENCES `library-system`.`users` (`mobile_no`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `library-system`.`admin`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `library-system`.`admin` (
  `admin_id` INT NOT NULL AUTO_INCREMENT,
  `admin_name` VARCHAR(45) NULL,
  `admin_password` TEXT NULL,
  PRIMARY KEY (`admin_id`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
