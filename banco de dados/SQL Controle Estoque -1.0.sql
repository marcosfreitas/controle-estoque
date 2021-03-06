-- MySQL Script generated by MySQL Workbench
-- 06/27/16 11:00:27
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema controle_estoque
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `controle_estoque` ;

-- -----------------------------------------------------
-- Schema controle_estoque
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `controle_estoque` DEFAULT CHARACTER SET utf8 ;
USE `controle_estoque` ;

-- -----------------------------------------------------
-- Table `controle_estoque`.`produto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `controle_estoque`.`produto` ;

CREATE TABLE IF NOT EXISTS `controle_estoque`.`produto` (
  `p_id` INT NOT NULL AUTO_INCREMENT,
  `p_nome` VARCHAR(100) NOT NULL,
  `p_descricao` VARCHAR(255) NOT NULL,
  `p_preco` DECIMAL(7,2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`p_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `controle_estoque`.`cliente`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `controle_estoque`.`cliente` ;

CREATE TABLE IF NOT EXISTS `controle_estoque`.`cliente` (
  `c_id` INT NOT NULL AUTO_INCREMENT,
  `c_nome` VARCHAR(100) NULL,
  `c_email` VARCHAR(45) NULL,
  `c_telefone` VARCHAR(45) NULL,
  PRIMARY KEY (`c_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `controle_estoque`.`pedido`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `controle_estoque`.`pedido` ;

CREATE TABLE IF NOT EXISTS `controle_estoque`.`pedido` (
  `pe_id` INT NOT NULL AUTO_INCREMENT,
  `fk_cliente` INT NOT NULL,
  `fk_produto` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`pe_id`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
