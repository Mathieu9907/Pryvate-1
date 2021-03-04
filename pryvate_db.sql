-- MySQL Script generated by MySQL Workbench
-- Tue Feb 23 16:04:18 2021
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`Lesson`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Lesson` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Lesson` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `date_time_of_lesson` DATETIME NOT NULL,
  `ski_or_snowboard` TINYINT UNSIGNED NOT NULL,
  `client_id` INT UNSIGNED NOT NULL,
  `level` INT(1) UNSIGNED NULL,
  `reservation_number` INT(10) UNSIGNED NULL,
  `clerk_name` VARCHAR(3) NULL,
  `date_created` DATE NULL,
  `length` FLOAT UNSIGNED NULL,
  `instructor` VARCHAR(70) NULL,
  `desk_or_request` TINYINT UNSIGNED NOT NULL,
  `paid` TINYINT UNSIGNED NOT NULL,
  `checked_in` TINYINT UNSIGNED NOT NULL,
  `finalized_in_sales` TINYINT UNSIGNED NOT NULL,
  `notes` TEXT(500) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Client`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`Client` ;

CREATE TABLE IF NOT EXISTS `mydb`.`Client` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(30) NOT NULL,
  `last_name` VARCHAR(40) NOT NULL,
  `age` SMALLINT(3) UNSIGNED NOT NULL,
  `parent` VARCHAR(71) NULL,
  `phone_number` INT(30) UNSIGNED NULL,
  `signed_waiver` TINYINT UNSIGNED NOT NULL,
  `notes` TEXT(500) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;