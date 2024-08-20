
CREATE TABLE transport_commentaires
(
  Id_commentaire INT          NOT NULL AUTO_INCREMENT,
  Id_personnel   INT          NOT NULL,
  Id_vehicule    INT          NOT NULL,
  texte          VARCHAR(250) NOT NULL,
  dtc            DATETIME     NOT NULL,
  PRIMARY KEY (Id_commentaire)
);

CREATE TABLE transport_etat
(
  Id_etat_vehicule INT          NOT NULL AUTO_INCREMENT,
  nom              VARCHAR(150) NOT NULL,
  PRIMARY KEY (Id_etat_vehicule)
);

CREATE TABLE transport_evaluations
(
  Id_evaluation INT          NOT NULL AUTO_INCREMENT,
  texte         VARCHAR(250) NOT NULL,
  dtc           DATETIME     NOT NULL,
  Id_admin      INT          NOT NULL,
  Id_personnel  INT          NOT NULL,
  PRIMARY KEY (Id_evaluation)
);

CREATE TABLE transport_personnels
(
  Id_personnel         INT          NOT NULL AUTO_INCREMENT,
  nom                  VARCHAR(50)  NOT NULL,
  prenom               VARCHAR(50)  NOT NULL,
  date_arrive          DATE         NOT NULL,
  telephone            INT          NOT NULL,
  email                VARCHAR(150) NOT NULL,
  mdp                  VARCHAR(200) NOT NULL,
  dtc                  DATETIME     NOT NULL,
  Id_statut_personnels INT          NOT NULL,
  Id_role              INT          NOT NULL,
  PRIMARY KEY (Id_personnel)
);

CREATE TABLE transport_roles
(
  Id_role INT          NOT NULL AUTO_INCREMENT,
  nom     VARCHAR(150) NOT NULL,
  PRIMARY KEY (Id_role)
);

CREATE TABLE transport_statut
(
  Id_statut_personnels INT          NOT NULL AUTO_INCREMENT,
  nom                  VARCHAR(150) NOT NULL,
  date_debut           DATE         NULL    ,
  date_fin             DATE         NULL    ,
  PRIMARY KEY (Id_statut_personnels)
);

CREATE TABLE transport_vehicules
(
  Id_vehicule      INT         NOT NULL AUTO_INCREMENT,
  numero           VARCHAR(50) NOT NULL,
  type             VARCHAR(50) NOT NULL,
  date_ct          DATE        NOT NULL,
  km               INT         NOT NULL,
  Id_etat_vehicule INT         NOT NULL,
  PRIMARY KEY (Id_vehicule)
);

ALTER TABLE transport_personnels
  ADD CONSTRAINT FK_transport_statut_TO_transport_personnels
    FOREIGN KEY (Id_statut_personnels)
    REFERENCES transport_statut (Id_statut_personnels);

ALTER TABLE transport_personnels
  ADD CONSTRAINT FK_transport_roles_TO_transport_personnels
    FOREIGN KEY (Id_role)
    REFERENCES transport_roles (Id_role);

ALTER TABLE transport_vehicules
  ADD CONSTRAINT FK_transport_etat_TO_transport_vehicules
    FOREIGN KEY (Id_etat_vehicule)
    REFERENCES transport_etat (Id_etat_vehicule);

ALTER TABLE transport_commentaires
  ADD CONSTRAINT FK_transport_vehicules_TO_transport_commentaires
    FOREIGN KEY (Id_vehicule)
    REFERENCES transport_vehicules (Id_vehicule);

ALTER TABLE transport_commentaires
  ADD CONSTRAINT FK_transport_personnels_TO_transport_commentaires
    FOREIGN KEY (Id_personnel)
    REFERENCES transport_personnels (Id_personnel);

ALTER TABLE transport_evaluations
  ADD CONSTRAINT FK_transport_personnels_TO_transport_evaluations
    FOREIGN KEY (Id_admin)
    REFERENCES transport_personnels (Id_personnel);

ALTER TABLE transport_evaluations
  ADD CONSTRAINT FK_transport_personnels_TO_transport_evaluations1
    FOREIGN KEY (Id_personnel)
    REFERENCES transport_personnels (Id_personnel);
