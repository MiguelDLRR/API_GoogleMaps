CREATE DATABASE  googlemaps;
USE googlemaps;

CREATE TABLE locales (
id INT PRIMARY KEY AUTO_INCREMENT,
nombre VARCHAR(30),
coordenadas VARCHAR (100),
poblacion VARCHAR(30),
tipo VARCHAR(30) CHECK(tipo IN ('bares','restaurantes','discotecas'))

);

INSERT INTO locales (nombre, coordenadas, poblacion, tipo)VALUES ('Bar Candanchu', '{ lat: 42.57017 , lng: -0.54785 }','Jaca','bares');
INSERT INTO locales (nombre, coordenadas, poblacion, tipo)VALUES ('La borda de Bosnerau', '{ lat: 42.62891, lng:-0.31919  }','Biescas','restaurantes');
INSERT INTO locales (nombre, coordenadas, poblacion, tipo)VALUES ('Pub Rolling', '{ lat: 42.51874, lng: -0.36473 }','Sabiñanigo','discotecas'); 

DROP TABLE locales;
