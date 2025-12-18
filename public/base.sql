CREATE OR REPLACE DATABASE Livraison;
USE Livraison;

CREATE TABLE Zone(
    id_zone INT AUTO_INCREMENT PRIMARY KEY,
    secteur VARCHAR(100)
);

CREATE TABLE Entrepot(
    id_entrepot INT AUTO_INCREMENT PRIMARY KEY,
    adresse VARCHAR(100)
);

CREATE TABLE Vehicule(
    id_vehicule INT AUTO_INCREMENT PRIMARY KEY,
    Matricule VARCHAR(30)
);

CREATE TABLE Livreurs(
    id_livreur INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50),
    salaire FLOAT
);

CREATE TABLE Colis(
    id_colis INT AUTO_INCREMENT PRIMARY KEY,
    nom_colis VARCHAR(50),
    poids FLOAT,
    prix FLOAT
);

CREATE TABLE Livraison(
    id_livraison INT AUTO_INCREMENT PRIMARY KEY,
    id_colis INT,
    id_zone INT,
    id_livreur INT,
    id_vehicule INT,
    id_entrepot INT,
    adresse_de_destination VARCHAR(100),
    id_statut  INT,
    date_livraison DATE,
    cout_livraison DECIMAL(10,2),
    carburant FLOAT
);

CREATE TABLE Statut(
    id_statut INT AUTO_INCREMENT PRIMARY KEY,
    Etat VARCHAR(20)
);

INSERT INTO Statut(Etat)VALUES('Livre') , ('en Attente') , ('annule');
------------------------
INSERT INTO Zone(secteur) VALUES ('Antananarivo');
INSERT INTO Zone(secteur) VALUES ('Antsirabe');
INSERT INTO Zone(secteur) VALUES ('Fianarantsoa');
INSERT INTO Zone(secteur) VALUES ('Toamasina');

INSERT INTO Entrepot(adresse) VALUES ('Andoharanofotsy');

INSERT INTO Vehicule(matricule) VALUES ('6545TAD');
INSERT INTO Vehicule(matricule) VALUES ('1234ABC');
INSERT INTO Vehicule(matricule) VALUES ('5678XYZ');
INSERT INTO Vehicule(matricule) VALUES ('9876DEF');

INSERT INTO Livreurs(nom, salaire) VALUES ('Nomena', 145);
INSERT INTO Livreurs(nom, salaire) VALUES ('Rakoto', 150);
INSERT INTO Livreurs(nom, salaire) VALUES ('Rabe', 140);
INSERT INTO Livreurs(nom, salaire) VALUES ('Solo', 160);
INSERT INTO Livreurs(nom, salaire) VALUES ('Jean', 155);


INSERT INTO Colis(nom_colis, poids , prix) VALUES ('Colis A', 2.5 , 10000.00);
INSERT INTO Colis(nom_colis, poids , prix) VALUES ('Colis B', 1.8 , 10000.00);
INSERT INTO Colis(nom_colis, poids , prix) VALUES ('Colis C', 3.2 , 10000.00);
INSERT INTO Colis(nom_colis, poids , prix) VALUES ('Colis D', 0.5 , 10000.00);
INSERT INTO Colis(nom_colis, poids , prix) VALUES ('Colis E', 4.0 , 10000.00);

-- INSERT INTO Mvt_jour(id_livreur, id_vehicule, jour) VALUES (1, 1, '2025-12-16');

INSERT INTO Livraison(
  id_colis, id_zone, id_livreur , id_vehicule , id_entrepot,
  adresse_de_destination, id_statut , date_livraison, cout_livraison , carburant
) VALUES (
  1, 1, 1 , 1 , 1,
  'Anosy', 2 , '2025-12-16', 10.00 , 200.00
);

CREATE OR REPLACE VIEW V_Livraison  AS
SELECT id_livraison , nom_colis , Etat , nom , adresse_de_destination , date_livraison , carburant , salaire ,
(carburant + salaire) as cout_de_revient , poids , prix , (poids * prix) as CA
FROM Livraison 
JOIN Livreurs ON Livreurs.id_livreur = Livraison.id_livreur
JOIN Vehicule ON Vehicule.id_vehicule = Livraison.id_vehicule
JOIN Colis ON Colis.id_colis = Livraison.id_colis
JOIN Statut ON Statut.id_statut = Livraison.id_statut;


