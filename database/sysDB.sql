/* CREATE DATABASE sysDB.db; */

DROP TABLE IF EXISTS tb_grupo;
CREATE TABLE "tb_grupo" (
	"id"	INTEGER NOT NULL UNIQUE,
	"nome"	TEXT NOT NULL UNIQUE,
	PRIMARY KEY("id" AUTOINCREMENT)
);

INSERT INTO tb_grupo (nome) VALUES ("Usuários"), ("Administradores");

DROP TABLE IF EXISTS tb_usuario;
CREATE TABLE "tb_usuario" (
	"id"	INTEGER NOT NULL UNIQUE,
	"nome"	TEXT NOT NULL,
	"email"	TEXT NOT NULL UNIQUE,
	"senha"	TEXT NOT NULL,
	"id_grupo"	INTEGER NOT NULL,
	PRIMARY KEY("id" AUTOINCREMENT),
	FOREIGN KEY("id_grupo") REFERENCES "tb_grupo"("id") ON DELETE CASCADE
);

INSERT INTO tb_usuario (nome, email, senha, id_grupo) VALUES
("Usuário Teste", "user@user.com", "1234", 1),
("Administrador Teste", "adm@adm.com", "1234", 2),
("Fernando Costa Migliorini", "fercosmig@gmail.com", "1234", 2);


