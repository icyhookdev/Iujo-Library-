CREATE DATABASE library;

CREATE TABLE gender(
	id_gender SERIAL PRIMARY KEY NOT NULL,
	gender_n VARCHAR(12) NOT NULL
	);

CREATE TABLE core (
	id_core SERIAL PRIMARY KEY NOT NULL,
	core_n VARCHAR(50) NOT NULL
	);
	
CREATE TABLE person (
	id_person SERIAL PRIMARY KEY NOT NULL,
	person_n VARCHAR(90) NOT NULL,
	person_ln VARCHAR(90) NOT NULL,
	ci VARCHAR(15) NOT NULL,
	direction TEXT NOT NULL,
	id_gender INT NOT NULL REFERENCES gender,
	birthdate DATE NOT NULL,
	phone BIGINT NOT NULL,
	id_core INT NOT NULL REFERENCES core
	);

CREATE TABLE users(	
	id_user SERIAL PRIMARY KEY NOT NULL,
	username VARCHAR(25) NOT NULL,
	email VARCHAR(100) NOT NULL,
	password VARCHAR(255) NOT NULL,
	id_person INT REFERENCES person ON DELETE CASCADE
	);

CREATE TABLE author (
	id_author SERIAL PRIMARY KEY NOT NULL,
	author_n VARCHAR(60) NOT NULL
	);

CREATE TABLE genre(
	id_genre SERIAL PRIMARY KEY NOT NULL,
	genre_n VARCHAR(60) NOT NULL
	);

CREATE TABLE editorial(
	id_editorial SERIAL PRIMARY KEY NOT NULL,
	editorial_n VARCHAR(60) NOT NULL,
	phone BIGINT NOT NULL,
	location TEXT NOT NULL
	);

CREATE TABLE book(
	id_book SERIAL PRIMARY KEY NOT NULL,
	book_n VARCHAR(100) NOT NULL,
	created_at DATE NOT NULL,
	register_at TIMESTAMP NOT NULL DEFAULT Now(),
	quantity INT NOT NULL,
	id_author INT NOT NULL REFERENCES author ON DELETE CASCADE,
	id_genre INT NOT NULL REFERENCES genre ON DELETE CASCADE,
	id_editorial INT NOT NULL REFERENCES editorial ON DELETE CASCADE
	);

CREATE TABLE lendings (
	id_lendings SERIAL PRIMARY KEY NOT NULL,
	register_at TIMESTAMP NOT NULL DEFAULT Now(),
	stats BOOL DEFAULT true, 
	id_user INT NOT NULL REFERENCES users ON DELETE CASCADE,
	id_person INT NOT NULL REFERENCES person ON DELETE CASCADE,
	id_book INT NOT NULL REFERENCES book ON DELETE CASCADE
	);
	
insert into core (core_n) values ('IUJO'), ('ITJO'), ('INCEJO');
insert into gender (gender_n) values ('Hombre'), ('Mujer');

insert into users (username, email, password) values ('root','root@support.com','123456');

CREATE TABLE entity (
	id_entity SERIAL PRIMARY KEY NOT NULL,
	entity_n VARCHAR(30) NOT NULL
	);

INSERT INTO entity (entity_n) VALUES ('Persona'),('Empresa');


CREATE TABLE company (
	id_company SERIAL PRIMARY KEY NOT NULL,
	company_n VARCHAR(60) NOT NULL,
	description TEXT NOT NULL
	);
	
CREATE TABLE donations (
	id_donation SERIAL PRIMARY KEY NOT NULL,
	reason TEXT NOT NULL,
	id_entity INT NOT NULL REFERENCES entity ON DELETE CASCADE,
	id_company INT REFERENCES company ON DELETE CASCADE,
	id_person INT REFERENCES person ON DELETE CASCADE,
	id_book INT REFERENCES book ON DELETE CASCADE,
	register_at DATE NOT NULL DEFAULT Now()
	);