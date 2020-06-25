DROP DATABASE IF EXISTS sys;

CREATE DATABASE sys;

USE sys;

DROP TABLE IF EXISTS Cliente;

CREATE TABLE Cliente (idcliente INT AUTO_INCREMENT, nome VARCHAR(100) NOT NULL, cpf VARCHAR(11) NOT NULL UNIQUE, sexo VARCHAR(1),
CONSTRAINT ClientePK PRIMARY KEY (idcliente));

INSERT INTO Cliente(nome, cpf, sexo) VALUES ('Marcio Torres GitHub' ,'5987123330', 'M'), ('Camila Silva', '12345678911', 'F'), 
('Regis Guimaraes', '03322767086', 'M'), ('Mariane Freitas', '15232564521', 'F'), ('Tiaguinho', '2012358911','M'), ('Betinho', '89521563961', 'M'),
('Fernanda Oliveira', '5515630120', 'F');

DROP TABLE IF EXISTS Produto;

CREATE TABLE Produto(idproduto INT AUTO_INCREMENT, nome VARCHAR(100) NOT NULL UNIQUE, preco DOUBLE NOT NULL,
CONSTRAINT ProdutoPK PRIMARY KEY (idproduto));

INSERT INTO Produto (nome, preco) VALUES ('banana', 3.00), ('maca', 1.20), ('laranja', 1.00), ('shampoo clear men do CR7', 11.50), ('pao frances', 2.45), 
('omo lava roupas', 10.0), ('escopeta calibre 12', 5000.0), ('ar condicionado da lg', 10000.0),('samsung galaxy s8', 1000.0), ('iphone ultima geracao', 50000.99);

DROP TABLE IF EXISTS NotaFiscal;

CREATE TABLE NotaFiscal(idnotafiscal INT AUTO_INCREMENT, idcliente INT NOT NULL, datanota DATE NOT NULL,
CONSTRAINT NotaFiscalPK PRIMARY KEY (idnotafiscal),
CONSTRAINT NotaFiscalClienteFK FOREIGN KEY (idcliente) REFERENCES Cliente(idcliente) ON DELETE CASCADE ON UPDATE CASCADE);

INSERT INTO NotaFiscal(idcliente, datanota) VALUES (2, '1998-06-01'), (1,'2017-07-11'), (3, '2018-06-18'), (2, '2017-02-25'),
(1, '2018-08-21'), (4, '2017-06-18'), (5, '2000-01-30'), (6, '2004-05-01'), (5,'2001-06-06'),(2, '2018-02-14'),(1, '2017-04-01'),
(3, '2014-06-21');

DROP TABLE IF EXISTS ItemVenda;

CREATE TABLE ItemVenda(iditemvenda INT AUTO_INCREMENT, idnotafiscal INT NOT NULL, idproduto INT NOT NULL, quantidade DOUBLE NOT NULL,
CONSTRAINT ItemVendaPK PRIMARY KEY (iditemvenda),
CONSTRAINT ItemVendaFKNotaFiscal FOREIGN KEY (idnotafiscal) REFERENCES NotaFiscal(idnotafiscal) ON DELETE CASCADE ON UPDATE CASCADE,
CONSTRAINT ItemVendaFKProduto FOREIGN KEY (idproduto) REFERENCES Produto(idproduto) ON DELETE CASCADE ON UPDATE CASCADE);

INSERT INTO ItemVenda(idnotafiscal, idproduto, quantidade) VALUES (1, 2, 3), (2,1,3), (3,4,5),(2,1,1), (2,1,1), (3,4,4), (5,5,6),
(8,1,20), (4,1,8), (2,5,8), (4,4,4), (5,5,5), (1,1,1), (2,1,20), (1,3, 20), (8,5,20), (9,1,10), (11, 3,20), (10,2,5);