CREATE DATABASE IF NOT EXISTS `ao3_repo`
  CHARACTER SET = utf8mb4
  COLLATE = utf8mb4_0900_ai_ci;
CREATE USER IF NOT EXISTS
  'ao3_repo'@'ao3_repo'
  IDENTIFIED BY 'ao3_repo'
  FAILED_LOGIN_ATTEMPTS 3
  PASSWORD_LOCK_TIME 7;
GRANT ALL ON `ao3_repo`.* TO 'ao3_repo'@'localhost';

USE `ao3_repo`;
