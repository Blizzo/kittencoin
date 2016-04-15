DROP DATABASE IF EXISTS KittenCoin;
CREATE DATABASE KittenCoin;
USE KittenCoin;
CREATE TABLE users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name varchar(50) NOT NULL,
    password varchar(32) NOT NULL,
    admin INT NOT NULL DEFAULT 0,
    total INT NOT NULL DEFAULT 50
);
CREATE TABLE transfers (
    id INT NOT NULL AUTO_INCREMENT,
    transfer_to INT NOT NULL,
    transfer_from INT NOT NULL,
    amount INT NOT NULL,
    comment varchar(140),

    PRIMARY KEY(id),
    INDEX(transfer_to),
    INDEX(transfer_from),

    FOREIGN KEY (transfer_to)
        REFERENCES users(id),

    FOREIGN KEY (transfer_from)
        REFERENCES users(id)
);

CREATE USER 'kittencoin'@'localhost' IDENTIFIED BY 'KittyPasswordy0';
#CREATE USER 'kc-search'@'localhost' IDENTIFIED BY 'KittySearchPasswordy0';
GRANT SELECT,INSERT,UPDATE on KittenCoin.* to 'kittencoin'@'localhost';
#GRANT SELECT on KittenCoin.* to 'kc-search'@'localhost';
FLUSH PRIVILEGES


