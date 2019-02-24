CREATE DATABASE IF NOT EXISTS hay_pallard;
use hay_pallard;

CREATE TABLE IF NOT EXISTS users (
    id INT NOT NULL AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    salt CHAR(32) NOT NULL,
    pass VARCHAR(255) NOT NULL,
    api_key VARCHAR(255) NOT NULL,
    is_admin BOOLEAN DEFAULT false NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS sites (
    id INT NOT NULL AUTO_INCREMENT,
    url_site VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS history_site (
    id INT NOT NULL AUTO_INCREMENT,
    id_site INT NOT NULL,
    update_at DATETIME NOT NULL,
    status_code INT NOT NULL,
    PRIMARY KEY (id)
);

INSERT INTO users VALUES(1, 'deschaussettes@yopmail.com', MD5(RAND()), MD5(CONCAT('password', salt)), 'abcdefghjaimelesapis', true);

INSERT INTO sites VALUES(1, 'https://google.com');
INSERT INTO sites VALUES(2, 'https://jolisite.com');