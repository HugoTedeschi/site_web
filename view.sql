CREATE VIEW achats AS
SELECT c.prenom, c.nom, i.no_facture, i.no_instrument, i.modele, i.type, i.nom_fourn, i.prix, i.no_vendeur
FROM Instrument i, Client c, Facture f 
WHERE c.no_client=f.no_client AND i.no_facture=f.no_facture

CREATE VIEW achats_physique AS
SELECT a.prenom, a.nom, a.no_facture, a.no_instrument, a.modele, a.type, a.nom_fourn, a.prix, i.adresse_mag, m.ville
FROM achats a, Instrument i, Magasin m
WHERE m.adresse=i.adresse_mag AND i.no_instrument=a.no_instrument AND a.no_vendeur IS NOT NULL

CREATE VIEW achats_en_ligne AS
SELECT a.prenom, a.nom, a.no_facture, a.no_instrument, a.modele, a.type, a.nom_fourn, a.prix, c.no_commande
FROM achats a, Commande c
WHERE  c.no_facture=a.no_facture AND a.no_vendeur IS NULL

CREATE VIEW facture_prix AS
SELECT f.no_facture, c.no_client, c.nom, c.prenom, SUM(i.prix) AS prix_total
FROM Facture f, Client c, Instrument i 
WHERE f.no_client=c.no_client AND i.no_facture=f.no_facture
GROUP BY f.no_facture, c.no_client, c.nom, c.prenom

UPDATE Instrument SET Instrument.adresse_mag='45 avenue des Etats-Unis'
WHERE Instrument.no_facture<600005

CREATE VIEW gestion_commande AS
SELECT co.no_commande, co.adresse_mag AS adresse_du_Magasin, cl.adresse AS adresse_du_client, f.date AS date_achat, co.date AS date_livraison, (co.frais_de_port+facture_prix.prix_total) AS prix_avec_port
FROM Client cl, Commande co, Facture f , facture_prix
WHERE cl.no_client=f.no_client AND co.no_facture=f.no_facture AND facture_prix.no_facture=f.no_facture;
