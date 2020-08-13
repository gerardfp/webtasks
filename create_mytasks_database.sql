DROP DATABASE IF EXISTS mytasks_database;
DROP USER IF EXISTS 'mytasks_user'@'localhost';

CREATE DATABASE mytasks_database;
CREATE USER 'mytasks_user'@'localhost' IDENTIFIED BY 'mytasks_password';
GRANT ALL PRIVILEGES ON mytasks_database.* TO 'mytasks_user'@'localhost'; 
FLUSH PRIVILEGES;
CREATE TABLE mytasks_database.tasks(task TEXT);
