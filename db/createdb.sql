CREATE TABLE countries(
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(250) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE clients(
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(250) NOT NULL,
    age INT NOT NULL,
    address VARCHAR(250) NOT NULL,
    married BIT NOT NULL,
    country_id INT,
    PRIMARY KEY (id),
    FOREIGN KEY (country_id)
        REFERENCES countries(id)
        ON DELETE SET NULL
);