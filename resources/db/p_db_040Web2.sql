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

INSERT INTO t_author (autFirstname, autLastname, autBirthday, idxEditor) VALUES
    ('Nom auteur 1', 'Prénom auteur 1', '2003-04-30' , 1),
    ('Nom auteur 2', 'Prénom auteur 2', '2003-04-30' , 6),
    ('Nom auteur 3', 'Prénom auteur 3', '2003-04-30' , 2),
    ('Nom auteur 4', 'Prénom auteur 4', '2003-04-30' , 5),
    ('Nom auteur 5', 'Prénom auteur 5', '2003-04-30' , 1),
    ('Nom auteur 6', 'Prénom auteur 6', '2003-04-30' , 2),
    ('Nom auteur 7', 'Prénom auteur 7', '2003-04-30' , 3),
    ('Nom auteur 8', 'Prénom auteur 8', '2003-04-30' , 4),
    ('Nom auteur 9', 'Prénom auteur 9', '2003-04-30' , 5),
    ('Nom auteur 10', 'Prénom auteur 10', '2003-04-30' , 2
);


INSERT INTO t_book (booTitle, booPages, booExtract, booSumary, booPublicationYear, idxCategory) VALUES
    ('Livre 1', 345, 'Extrait du livre 1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2003-04-30', 1 ),
    ('Livre 2', 456, 'Extrait du livre 2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2015-07-30', 2 ),
    ('Livre 3', 123, 'Extrait du livre 3', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1996-09-30', 4 ),
    ('Livre 4', 789, 'Extrait du livre 4', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1992-12-30', 2 ),
    ('Livre 5', 120, 'Extrait du livre 5', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1998-02-10', 3 ),
    ('Livre 6', 789, 'Extrait du livre 6', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1992-12-30', 2 ),
    ('Livre 7', 789, 'Extrait du livre 7', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1992-12-30', 2 ),
    ('Livre 8', 789, 'Extrait du livre 8', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1992-12-30', 2 ),
    ('Livre 9', 789, 'Extrait du livre 9', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1992-12-30', 2 ),
    ('Livre 10', 789, 'Extrait du livre 10', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1992-12-30', 2
);

INSERT INTO t_write (idxBook, idxAuthor) VALUES
    (1, 10),
    (2, 9),
    (3, 8),
    (4, 7),
    (5, 6),
    (6, 5),
    (7, 4),
    (8, 3),
    (9, 2),
    (10, 1
);


/*https://forum.phpfrance.com/php-debutant/inserer-date-inscription-t259102.html*/

INSERT INTO t_user (useLogin, usePassword, useIsAdmin, useInscriptionDate, useSuggestBook, useAppreciationNumber) VALUES 
    ('admin', '$2y$10$yu3SnAKYYtUfASDTsYt6Nu3OicImJmAqzl/HswCyD4biBrbmssJjS', 1, '2021-04-28', 0, 0),
    ('anthohn', '$2y$10$/nJCUqu0g8LO4uIDoCDIE.GLvXJUGomTiiCak6e7MyjPunXIGhdPq', 1, '2021-04-28', 0, 0),
    ('julcartier', '$2y$10$/nJCUqu0g8LO4uIDoCDIE.GLvXJUGomTiiCak6e7MyjPunXIGhdPq', 0, '2021-04-28', 0, 0),
    ('yousayeh', '$2y$10$/nJCUqu0g8LO4uIDoCDIE.GLvXJUGomTiiCak6e7MyjPunXIGhdPq', 0, '2021-04-28', 0, 0
); 

