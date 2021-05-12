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
    booNoteCount INT NOT NULL DEFAULT 0,
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

CREATE TABLE t_vote(
    idxBook INT NOT NULL,
    idxUser INT NOT NULL,
    votNote FLOAT NOT NULL,
    CONSTRAINT fk_t_vote_t_book_idBook FOREIGN KEY (idxBook) REFERENCES t_book(idBook),
    CONSTRAINT fk_t_vote_t_user_idUser FOREIGN KEY (idxUser) REFERENCES t_user(idUser)
    -- PRIMARY KEY (idxUser, idxBook)
);

-- INSERT INTO t_vote (idxBook, idxUser, votNote) VALUES
-- (8, 1, 1);

INSERT INTO t_editor (ediName) VALUES
('Hachette Livre'),
("First Interactive"),
('Talents Hauts Editions'),
('Calligram'),
('Actes Sud Littérature'),
('Presses De La Cite'),
('XO Editions'),
('Mnémos Editions');

INSERT INTO t_category (catName) VALUES
('Bande dessinée'),
('Roman d''amour'),
('Roman Policier'),
('Fantastique'),
('Science-fiction'),
('Documentaire'),
('Théatre');

INSERT INTO t_author (autFirstname, autLastname, autBirthday, idxEditor) VALUES
('Rowling', 'Joanne', '1965-07-31' , 1),
('Poquelin', 'Jean-Baptiste', '1622-01-15' , 1),
('Valade', 'Janet', '1963-01-01' , 2),
('Colin', 'Fabrice', '1972-07-06' , 3),
('de Saint Mars', 'Dominique', '1949-05-29' , 4),
('Fernández', 'Laura', '1981-07-05' , 5),
('Steel', 'Danielle', '1947-08-14' , 6),
('Minier', 'Bernard', '1960-08-25' , 7),
('Basseterre', 'Luce', '1957-03-17' , 8);


INSERT INTO t_book (booTitle, booPages, booExtract, booSumary, booPublicationYear, idxCategory) VALUES
('Les Animaux fantastiques', 128, 'https://ebook.chapitre.com/ebook/9781781107263-les-animaux-fantastiques-le-texte-du-film-j-k-rowling/', 'Norbert Dragonneau, un magicien anglais, fait une escale à New York. Il transporte avec lui une valise dans laquelle il héberge une multitude d’animaux fantastiques capturés ou sauvés lors de ses voyages. Il a l’intention d’aller libérer l’un d’entre eux – Frank, un oiseau-tonnerre – en Arizona. Mais l’une des créatures parvient à fuir la valise et en tentant de la récupérer, Norbert échange malencontreusement ladite valise avec celle d’un ouvrier new-yorkais qui ignore tout du monde de la magie. Comment récupérer les créatures sans être repéré par le congrès magique des États-Unis d’Amérique ? Norbert Dragonneau peut-il empêcher l’ouvrier, Jacob Kowalski, de découvrir l’existence des magiciens ?', '2001-03-01', 5 ),
('Harry Potter à l''école des sorciers', 308, 'https://booknode.com/harry_potter_tome_1_harry_potter_a_l_ecole_des_sorciers_0983/extraits?offset=3', 'La famille Dursley mène une vie paisible au 4, Privet Drive, jusqu''au jour où deux mystérieux individus - des sorciers - rôdent aux abords du lotissement situé sur la commune de Little Whinging. Ils attendent avec impatience mais aussi fébrilité l''arrivée de Harry Potter, le survivant. Le jeune garçon, alors âgé de quinze mois, vient de perdre ses parents dans des circonstances étranges et est transporté en moto volante par le géant Hagrid jusqu''à la maison des Dursley, la seule famille qu''il lui reste désormais.Dix années passent...Harry Potter est élevé par l''oncle Vernon et la tante Pétunia qui ne l''aiment pas. Ces derniers l''obligent à dormir dans un placard à balais et à subir divers châtiments. Il subit de plein fouet l''agressivité de Dudley, le fils tyrannique des Dursley, et sa bande dont le "jeu" favori est la chasse au Harry.
Harry pense être un garçon ordinaire, auquel il arrive parfois d''étranges phénomènes... jusqu''au jour de son onzième anniversaire où il voit littéralement son existence bouleversée. Harry reçoit la visite du géant Hagrid qui vient le récupérer pour l''emmener à l''école de sorcellerie Poudlard, un collège exclusivement réservé aux jeunes sorciers et sorcières britanniques, et où une place l''attend depuis sa naissance. Harry apprend qu''il est un sorcier, célèbre de surcroît, tout comme ses parents décédés, James et Lily Potter. On lui révèle également que ses parents ne sont pas morts dans un accident de voiture mais assassinés par un terrifiant mage noir dont personne n''ose prononcer le nom.', '1997-07-26', 5 ),
('PHP & MySQL pour les nuls', 550, 'https://livre.fnac.com/a10614765/Pour-les-Nuls-6eme-edition-PHP-et-MySQL-Pour-les-Nuls-6ed-Janet-Valade', 'Pour comprendre enfin quelque chose à la micro-informatique ! Vous voici confronté à un micro-ordinateur - plus par nécessité que par goût, avouez-le -, sans savoir par quel bout prendre cet instrument barbare et capricieux. Oubliez toute appréhension, cette nouvelle collection est réellement faite pour vous ! Avec PHP et MySQL développez vos sites Web en toute sécurité ! Avec PHP et MySQL pour les Nuls, plus besoin d''être un as de la programmation pour développer des sites Web dynamiques et interactifs. Avec ce livre, vous apprendrez à manipuler tous les outils de gestion de sessions, manipuler les coockies, gérer le code XML et JavaScript, mettre en place des systèmes de sécurité, et bien d''autres choses encore.', '2017-08-17', 6 ),
('L''avare', 160, 'http://www.toutmoliere.net/img/pdf/avare.pdf', 'Elise, fille d’Harpagon, souhaite se marier avec Valère, tandis que son frère Cléante veut épouser Mariane. Mais le père a d’autres vues pour ses enfants, et a jeté lui-même son dévolu sur la jeune fille. La pièce, créée par Molière en 1668, serait donc une comédie amoureuse si, derrière cette première intrigue, ne se dessinait surtout la comédie d’un caractère, l’avare, dont la précieuse cassette, un moment dérobée, fait opportunément retour afin de permettre un dénouement heureux.
Créature comique, objet de moqueries et de vengeances, mais aussi nature monstrueuse et tyran domestique, Harpagon est bien la figure qui domine presque toutes les scènes, assure l’efficacité dramatique de la pièce et permet à la comédie de confiner à la farce. Par la satire, le quiproquo et l’ironie, Molière brosse de lui un portrait d’une drôlerie sans pitié.', '2015-08-26', 7 ),
('La bonne aventure', 224, 'https://halldulivre.com/ebook/9782362663840-la-bonne-aventure-fabrice-colin/', 'Un soir d''automne, Ombline Sauvage décida de se faire lire les lignes de la main. Quelques jours plus tôt – place Napoléon IV, à deux pas de chez elle – une roulotte de forain s''était installée, tirée par un hongre grisâtre et sans âge. « Mme Luciele - Avenir & choix de vie. Amour. Qui êtes-vous et que voulez-vous vraiment ? » Qui êtes-vous ? Cela, elle pensait à peu près le savoir. Une jeune femme seule, sans projet à long terme, dotée d''un don très sûr pour la mélancolie. Et qui réclamait d''être surprise, pour ne pas dire plus.', '1998-02-10', 3 ),
('Lili se fait piéger sur Internet', 45, 'https://sites.google.com/site/kravnenswerdie/lili-se-fait-pieger-sur-internet-29535916', 'Il y a un nouvel ordinateur chez Max et Lili et leurs parents n''ont pas encore installé le contrôle parental. Juste le temps de tomber dans quelques pièges et de faire des cyber-bêtises comme donner son identité ou accepter un rendez-vous... Et la prudence, Lili !', '2006-03-01', 1),
('Connerland', 472, 'https://www.babelio.com/livres/Fernndez-Connerland/1122319/extraits', 'Voss Van Conner est un écrivain de science-fiction qui, après s''être électrocuté avec son sèche-cheveux, se retrouve en serviette de bain dans une immense salle d''attente en forme de vaisseau spatial (ou l''inverse). Il est bientôt renvoyé sur Terre, muni d''instructions mystérieuses, dans un avion à bord duquel voyagent un représentant de commerce qui a lu ses 117 romans et une hôtesse de l''air adepte du speed dating seule capable de voir le fantôme de l''écrivain... Drôle et vif, Connerland est un hommage à Kurt Vonnegut, Douglas Adams et consorts, et à ces romans de science-fiction, un peu disparus aujourd''hui, dont la folie et l''invention confinaient au ridicule avec le plus grand sérieux et élevaient le grotesque au rang d''art. La fable burlesque de Laura Fernandez ressemble au roman qu''aurait pu écrire un Pynchon obsédé par Ghost.', '2019-04-10', 4 ),
('Coup de grâce', 248, 'https://books.google.ch/books/about/Coup_de_gr%C3%A2ce.html?id=DvrrDwAAQBAJ&printsec=frontcover&source=kp_read_button&redir_esc=y#v=onepage&q&f=false', 'Que faire quand on a tout perdu ? Renoncer ou tout recommencer ? Sydney Wells menait une vie idyllique jusqu''à la mort tragique de son mari dans un accident de la route. Absente du testament, elle est chassée de la propriété familiale par ses belles-filles, uniques héritières de la considérable fortune de son défunt époux. Alors qu''on lui offre l''opportunité de retourner à sa première passion, la mode, en tant que styliste, Sydney saisit sa chance. Naïve et manquant d''expérience, refusant d''écouter les mises en garde de ses propres filles, elle se laisse cependant vite piéger dans cet univers impitoyable... Humiliée et ruinée, la jeune veuve n''a plus d''autre choix que de repartir de zéro. Mais où trouver la force nécessaire pour cela ? Entre New York et Hong Kong, avec dignité et courage, Sydney s''efforce pourtant coûte que coûte de se réinventer. À la clé, un avenir plein de promesses en terre inconnue, dont elle pourra être fière...', '2020-08-13', 2 ),
('La vallée', 528 , 'https://books.google.com/books/about/La_vall%C3%A9e.html?id=0tLPDwAAQBAJ&printsec=frontcover&source=kp_read_button', 'En pleine nuit, Martin Servaz reçoit un appel étrange mais urgent de Marianne, la femme qu''il aime depuis toujours… et disparue depuis huit ans. Il fonce donc vers l''endroit qu''elle lui a décrit, et arrive dans une sombre vallée où se sont produits récemment d''odieux crimes, d’autant plus odieux qu’ils ont été filmés par l''assassin. Outre une communauté de moines, le policier – pourtant suspendu – va y croiser une collègue déterminée, et une psychiatre singulière mais non moins dangereusement séduisante ... Pour son sixième polar, Bernard Minier conjugue enquête criminelle, politique et questions sociales, le tout avec une profondeur d''analyse à laquelle le thriller nous habitue peu.', '2020-05-01', 3 ),
('Le Chant des Fenjicks', 490, 'https://books.google.com/books/about/Le_Chant_des_Fenjicks.html?id=-YjvDwAAQBAJ&printsec=frontcover&source=kp_read_button', 'Dans l’espace, seuls leurs chants résonnent. Les cybersquales sont des vaisseaux de transport vivant utilisés depuis des siècles. Leur nombre pourtant décroit et leur captivité ne permet pas une reproduction efficace. En cause, un collier cybernétique emprisonnant leurs consciences. Mais l’âme des Fenjicks demeure et le chant de la liberté va résonner de nouveau dans la galaxie.', '2020-09-18',5 );

INSERT INTO t_write (idxBook, idxAuthor) VALUES
(1, 1),
(2, 1),
(4, 2),
(3, 3),
(5, 4),
(6, 5),
(7, 6),
(8, 7),
(9, 8),
(10, 9);


/*https://forum.phpfrance.com/php-debutant/inserer-date-inscription-t259102.html*/

INSERT INTO t_user (useLogin, usePassword, useIsAdmin, useInscriptionDate, useSuggestBook, useAppreciationNumber) VALUES 
('admin', '$2y$10$yu3SnAKYYtUfASDTsYt6Nu3OicImJmAqzl/HswCyD4biBrbmssJjS', 1, '2021-04-28', 0, 0),
('anthohn', '$2y$10$/nJCUqu0g8LO4uIDoCDIE.GLvXJUGomTiiCak6e7MyjPunXIGhdPq', 1, '2021-04-28', 0, 0),
('julcartier', '$2y$10$/nJCUqu0g8LO4uIDoCDIE.GLvXJUGomTiiCak6e7MyjPunXIGhdPq', 0, '2021-04-28', 0, 0),
('yousayeh', '$2y$10$/nJCUqu0g8LO4uIDoCDIE.GLvXJUGomTiiCak6e7MyjPunXIGhdPq', 0, '2021-04-28', 0, 0); 
