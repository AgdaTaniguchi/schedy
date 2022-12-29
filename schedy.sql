CREATE DATABASE schedy
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE schedy;

CREATE TABLE Estudante(
	id_estudante INT PRIMARY KEY AUTO_INCREMENT,
	nome VARCHAR(50) NOT NULL,
	celular VARCHAR(15) NOT NULL UNIQUE,
	email VARCHAR(50) NOT NULL UNIQUE,
	senha VARCHAR(255) NOT NULL,
	foto VARCHAR(80) NOT NULL,
	serie VARCHAR(3),
	estado CHAR(2),
	cidade VARCHAR(40),
	nascimento DATE
);

CREATE TABLE Materia(
	id_materia INT PRIMARY KEY AUTO_INCREMENT,
	nome VARCHAR(40) NOT NULL UNIQUE
);

CREATE TABLE Conteudo(
	id_conteudo INT PRIMARY KEY AUTO_INCREMENT,
	nome VARCHAR(40) NOT NULL UNIQUE,
	id_materia INT NOT NULL,
	FOREIGN KEY (id_materia) REFERENCES Materia(id_materia)
);

CREATE TABLE Questao(
	id_questao INT PRIMARY KEY AUTO_INCREMENT,
	enunciado varchar(2000) NOT NULL,
	numero_questao int not null,
	id_conteudo INT NOT NULL,
	FOREIGN KEY (id_conteudo) REFERENCES Conteudo(id_conteudo)
);

CREATE TABLE Alternativa(
	id_alternativa INT PRIMARY KEY AUTO_INCREMENT,
	texto VARCHAR(1000) NOT NULL,
	esta_certa BOOLEAN NOT NULL,
	id_questao INT NOT NULL,
	FOREIGN KEY (id_questao) REFERENCES Questao(id_questao)
);

CREATE TABLE Simulado(
	id_simulado INT PRIMARY KEY AUTO_INCREMENT,
	tipo VARCHAR(10) NOT NULL,
	data DATE NOT NULL,
	tempo TIME NOT NULL,
	id_estudante INT NOT NULL,
	FOREIGN KEY (id_estudante) REFERENCES Estudante(id_estudante)
);

CREATE TABLE Questao_Simulado(
	id_QS INT PRIMARY KEY AUTO_INCREMENT,
	usuario_acertou BOOLEAN NOT NULL,
	id_questao INT,
	FOREIGN KEY (id_questao) REFERENCES Questao(id_questao),
	id_simulado INT,
	FOREIGN KEY (id_simulado) REFERENCES Simulado(id_simulado)
);

CREATE TABLE Cronograma(
	id_cronograma INT PRIMARY KEY AUTO_INCREMENT,
	id_estudante INT NOT NULL,
	FOREIGN KEY (id_estudante) REFERENCES Estudante(id_estudante)
);

CREATE TABLE Evento(
	id_evento INT PRIMARY KEY AUTO_INCREMENT,
	titulo VARCHAR(30) NOT NULL,
	descricao VARCHAR(120),
	dia_semana CHAR(3) NOT NULL,
	horario TIME NOT NULL,
	receber_notificacao BOOLEAN,
	cor CHAR(6),
	id_cronograma INT NOT NULL,
	FOREIGN KEY (id_cronograma) REFERENCES Cronograma(id_cronograma)
);

CREATE TABLE Administrador(
	id_administrador INT PRIMARY KEY AUTO_INCREMENT,
	nome VARCHAR(50) NOT NULL,
	senha CHAR(60) NOT NULL,
	email VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE Notificacao(
	id_notificacao INT PRIMARY KEY AUTO_INCREMENT,
	texto VARCHAR(120),
	titulo VARCHAR(30),
	id_estudante INT NOT NULL,
	FOREIGN KEY (id_estudante) REFERENCES Estudante(id_estudante)
);

CREATE TABLE Vestibular(
	id_vestibular INT PRIMARY KEY AUTO_INCREMENT,
	nome VARCHAR(30),
	texto VARCHAR(500),
	id_administrador INT NOT NULL,
	FOREIGN KEY (id_administrador) REFERENCES Administrador(id_administrador)
);

CREATE TABLE Link(
	id_link INT PRIMARY KEY AUTO_INCREMENT,
	texto VARCHAR(30),
	link VARCHAR(50),
	id_vestibular INT NOT NULL,
	FOREIGN KEY (id_vestibular) REFERENCES Vestibular(id_vestibular)
);

INSERT INTO Materia (nome) VALUES ("Matemática");

INSERT INTO Conteudo (nome, id_materia) VALUES ("Soma", "1");

INSERT INTO Questao (enunciado, numero_questao, id_conteudo) VALUES ('Qual o resultado de 1 + 1?', 08, 1);

INSERT INTO Alternativa (texto, esta_certa, id_questao) VALUES ("2", 1, 1);

INSERT INTO Alternativa (texto, esta_certa, id_questao) VALUES ("3", 0, 1);

INSERT INTO Alternativa (texto, esta_certa, id_questao) VALUES ("9", 0, 1);

INSERT INTO Alternativa (texto, esta_certa, id_questao) VALUES ("5", 0, 1);

INSERT INTO Alternativa (texto, esta_certa, id_questao) VALUES ("-1", 0, 1);


INSERT INTO Conteudo (nome, id_materia) VALUES ("Multiplicação", 1);

INSERT INTO Questao (enunciado, numero_questao, id_conteudo) VALUES ("Qual o resultado de 5 x 1?", 50, 2);

INSERT INTO Alternativa (texto, esta_certa, id_questao) VALUES ("1", 0, 2);

INSERT INTO Alternativa (texto, esta_certa, id_questao) VALUES ("5", 1, 2);

INSERT INTO Alternativa (texto, esta_certa, id_questao) VALUES ("6", 0, 2);

INSERT INTO Alternativa (texto, esta_certa, id_questao) VALUES ("2", 0, 2);

INSERT INTO Alternativa (texto, esta_certa, id_questao) VALUES ("3", 0, 2);

INSERT INTO estudante (nome, celular, email, senha, foto) VALUES ("Agda", "11999999999", "agda@email.com", md5("123456"), c1022e860390476432eed8aea761dd76.png");