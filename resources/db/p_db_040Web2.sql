-- ETML
-- Auteur: Anthony Höhn
-- Date: 26.04.2021
-- Description: Base de données du projet 040-Web2

DROP DATABASE if EXISTS p_db_040_Web2;
CREATE DATABASE p_db_040_Web2;
USE p_db_040_Web2;

DROP USER IF EXISTS 'dbUser040'@'%';
CREATE USER 'dbUser040'@'%' IDENTIFIED BY '.Etml-';
GRANT SELECT, INSERT, UPDATE, DELETE ON p_db_040_Web2.* TO 'dbUser040'@'%';

CREATE TABLE t_category(
    idCategory INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    catName VARCHAR(50) NOT NULL
);

CREATE TABLE t_book(
    idBook INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    booTitle VARCHAR(50) NOT NULL,
    booPages SMALLINT UNSIGNED NOT NULL,
    booExtract VARCHAR(255) NOT NULL,
    booSumary TEXT NOT NULL,
    booPublicationYear DATE NOT NULL,
    booScoreAverage INT UNSIGNED DEFAULT 0,
    idxCategory INT NOT NULL,
    CONSTRAINT fk_t_book_t_category_idCategory FOREIGN KEY (idxCategory) REFERENCES t_category(idCategory) 
);

CREATE TABLE t_editor(
    idEditor INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ediName VARCHAR(50) NOT NULL
);

CREATE TABLE t_author(
    idAuthor INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    autFirstname VARCHAR(50) NOT NULL,
    autLastname VARCHAR(50) NOT NULL,
    autBirthday DATE NOT NULL,
    idxEditor INT NOT NULL,
    CONSTRAINT fk_t_author_t_editor_idEditor FOREIGN KEY (idxEditor) REFERENCES t_editor(idEditor)
);

CREATE TABLE t_user(
    idUser INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    useLogin VARCHAR(50) NOT NULL,
    usePassword VARCHAR(255) NOT NULL,
    useIsAdmin BOOLEAN NOT NULL DEFAULT 0,
    useInscriptionDate DATE NOT NULL,
    useSuggestBook INT UNSIGNED NOT NULL DEFAULT 0,
    useAppreciationNumber INT UNSIGNED NOT NULL DEFAULT 0
);

CREATE TABLE t_write(
    idxBook INT NOT NULL,
    idxAuthor INT NOT NULL,
    CONSTRAINT fk_t_write_t_book_idBook FOREIGN KEY (idxBook) REFERENCES t_book(idBook),
    CONSTRAINT fk_t_write_t_author_idAuthor FOREIGN KEY (idxAuthor) REFERENCES t_author(idAuthor),
    PRIMARY KEY (idxBook, idxAuthor)
);

INSERT INTO t_editor (ediName) VALUES
    ('Maison d''édition Gallimard'),
    ("Les Éditions Flammarion"),
    ('Les éditions Milan'),
    ('Les éditions Baudelaire'),
    ('Hachette'),
    ('Maison d''édition Le léopard masqué'),
    ('Les éditions de Minuit'),
    ('Maison d''éditon Privat'
);

INSERT INTO t_category (catName) VALUES
    ('Bande dessinée'),
    ('Roman d''amour'),
    ('Roman Policier'),
    ('Fantastique'),
    ('Science-fiction'
);

INSERT INTO t_book (booTitle, booPages, booExtract, booSumary, booPublicationYear, idxCategory) VALUES
    ('Livre 1', 345, 'Extrait du livre 1', 'Résumé du livre 1', '2003-04-30', 1 ),
    ('Livre 2', 456, 'Extrait du livre 2', 'Résumé du livre 2', '2015-07-30', 2 ),
    ('Livre 3', 123, 'Extrait du livre 3', 'Résumé du livre 3', '1996-09-30', 4 ),
    ('Livre 4', 789, 'Extrait du livre 4', 'Résumé du livre 4', '1992-12-30', 2 ),
    ('Livre 5', 120, 'Extrait du livre 5', 'Résumé du livre 5', '1998-02-10', 3 ),
    ('Livre 6', 789, 'Extrait du livre 6', 'Résumé du livre 6', '1992-12-30', 2 ),
    ('Livre 7', 789, 'Extrait du livre 7', 'Résumé du livre 7', '1992-12-30', 2 ),
    ('Livre 8', 789, 'Extrait du livre 8', 'Résumé du livre 8', '1992-12-30', 2 ),
    ('Livre 9', 789, 'Extrait du livre 9', 'Résumé du livre 9', '1992-12-30', 2 ),
    ('Livre 10', 789, 'Extrait du livre 10', 'Résumé du livre 10', '1992-12-30', 2
);

/*https://forum.phpfrance.com/php-debutant/inserer-date-inscription-t259102.html*/

INSERT INTO t_user (useLogin, usePassword, useIsAdmin, useInscriptionDate, useSuggestBook, useAppreciationNumber) VALUES 
    ('admin', "$2y$10$ebINd1FQ518pmgmdagSBzeoSS3Ps5NEucIASl0DVnqJt4jD9oXV1a", 1, '2021-04-28', 0, 0),
    ('anthohn', '$2y$10$/nJCUqu0g8LO4uIDoCDIE.GLvXJUGomTiiCak6e7MyjPunXIGhdPq', 0, '2021-04-28', 0, 0),
    ('julcartier', '$2y$10$/nJCUqu0g8LO4uIDoCDIE.GLvXJUGomTiiCak6e7MyjPunXIGhdPq', 0, '2021-04-28', 0, 0),
    ('yousayeh', '$2y$10$/nJCUqu0g8LO4uIDoCDIE.GLvXJUGomTiiCak6e7MyjPunXIGhdPq', 0, '2021-04-28', 0, 0
); 

