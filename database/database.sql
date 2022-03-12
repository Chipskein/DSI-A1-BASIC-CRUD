DROP DATABASE `DS1_LIB`;
CREATE DATABASE IF NOT EXISTS `DS1_LIB`;
USE `DS1_LIB`;
CREATE TABLE IF NOT EXISTS `Usuario`(
    `id` INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `email` VARCHAR(250) NOT NULL UNIQUE,
    `nome` VARCHAR(250) NOT NULL,
    `password` VARCHAR(500) NOT NULL
);
CREATE TABLE IF NOT EXISTS `Livros`(
    `id` INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `titulo` VARCHAR(250) NOT NULL,
    `ano` INTEGER NOT NULL,
    `editora` VARCHAR(250) NOT NULL,
    `autores` VARCHAR(500) NOT NULL,
    `qt` INTEGER DEFAULT 1
);
CREATE TABLE IF NOT EXISTS `LivrosEmprestados`(
    `usuario` INTEGER NOT NULL,
    `livro` INTEGER NOT NULL,
    `dataSaida` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `dataEntrega` DATETIME NOT NULL,
    FOREIGN KEY(usuario) REFERENCES `Usuario`(id),
    FOREIGN KEY(livro) REFERENCES `Livros`(id)
);

INSERT INTO `Livros`(titulo,ano,editora,autores,qt) VALUES("LIVRO DE TESTE",2020,"EDITORA DE TESTE","Jose Marcilio,Manga Bonga,Julius Cesar",1);
INSERT INTO `Livros`(titulo,ano,editora,autores,qt) VALUES("LIVRO DE TESTE1",2019,"EDITORA DE TESTE2","Jose Marcilio,Manga Bonga,Julius Cesar,Marcio",2);
INSERT INTO `Livros`(titulo,ano,editora,autores,qt) VALUES("LIVRO DE TESTE2",2018,"EDITORA DE TESTE","Jose Marcilio,Manga Bonga,Julius Cesar,Lurdes",3);
INSERT INTO `Livros`(titulo,ano,editora,autores,qt) VALUES("LIVRO DE TESTE3",1990,"EDITORA DE TESTE","Jose Marcilio,Manga Bonga,Julius Cesar,Maicon",5);
INSERT INTO `Livros`(titulo,ano,editora,autores,qt) VALUES("LIVRO DE TESTE4",1200,"EDITORA DE TESTE2","Jose Marcilio,Manga Bonga,Julius Cesar,Peaky Blinders",100);
INSERT INTO `Livros`(titulo,ano,editora,autores,qt) VALUES("LIVRO DE TESTE5",1970,"EDITORA DE TESTE2","Jose Marcilio,Manga Bonga,Julius Cesar,Marcelinho da rocinha",2);
INSERT INTO `Livros`(titulo,ano,editora,autores,qt) VALUES("LIVRO DE TESTE6",1965,"EDITORA DE TESTE","Jose Marcilio,Manga Bonga,Julius Cesar,Acerola",1);
INSERT INTO `Livros`(titulo,ano,editora,autores,qt) VALUES("LIVRO DE TESTE7",2000,"EDITORA DE TESTE","Jose Marcilio,Manga Bonga,Julius Cesar,Laranjinha",9);
INSERT INTO `Livros`(titulo,ano,editora,autores,qt) VALUES("LIVRO DE TESTE8",2002,"EDITORA DE TESTE2","Jose Marcilio,Manga Bonga,Julius Cesar,RATAO",9);
INSERT INTO `Livros`(titulo,ano,editora,autores,qt) VALUES("LIVRO DE TESTE9",2010,"EDITORA DE TESTE","Jose Marcilio,Manga Bonga,Julius Cesar,Cesio",2);
INSERT INTO `Livros`(titulo,ano,editora,autores,qt) VALUES("LIVRO DE TESTE10",2015,"EDITORA DE TESTE","Jose Marcilio,Manga Bonga,Julius Cesar,GOIANO",3);


INSERT INTO `Usuario`(email,nome,password) VALUES ('abfn0905@gmail.com','admin','$2a$08$Cf1f11ePArKlBJomM0F6a.8hkDBVwbjEj4M.X8f8Mif742BLRbCGO');