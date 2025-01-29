CREATE DATABASE sysDB.db; 

CREATE TABLE "tb_groups" (
	"id"	INTEGER,
	"name"	TEXT NOT NULL UNIQUE,
	PRIMARY KEY("id" AUTOINCREMENT)
);

INSERT INTO tb_groups (name) VALUES ("Usuarios"), ("Administradores");

CREATE TABLE "tb_users" (
	"id"	INTEGER,
	"name"	TEXT NOT NULL,
	"email"	TEXT NOT NULL UNIQUE,
	"password"	TEXT NOT NULL,
	"id_group"	INTEGER NOT NULL,
	FOREIGN KEY("id_group") REFERENCES "tb_groups"("id") ON DELETE CASCADE,
	PRIMARY KEY("id" AUTOINCREMENT)
);

INSERT INTO tb_users (name, email, password, id_group) VALUES
("User Test", "user@user.com", "1234", 1),
("Adm Test", "adm@adm.com", "1234", 2),
("Fernando Costa Migliorini", "fercosmig@gmail.com", "1234", 2);


