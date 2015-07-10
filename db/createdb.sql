CREATE TABLE clients(
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(250) NOT NULL,
    age INT NOT NULL,
    address VARCHAR(250) NOT NULL,
    married BIT NOT NULL,
    PRIMARY KEY (id)
);