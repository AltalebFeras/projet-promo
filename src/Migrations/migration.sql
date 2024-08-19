CREATE TABLE transport_roles (
   Id_role INT AUTO_INCREMENT,
   nom VARCHAR(150) NOT NULL,
   PRIMARY KEY(Id_role)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE transport_statut (
   Id_statut_personnels INT AUTO_INCREMENT,
   date_debut DATE,
   date_fin DATE,
   maladie BOOLEAN,
   present BOOLEAN,
   vacances BOOLEAN,
   PRIMARY KEY(Id_statut_personnels)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE transport_etat (
   Id_etat_vehicule INT AUTO_INCREMENT,
   circulation BOOLEAN NOT NULL,
   parking BOOLEAN NOT NULL,
   garage BOOLEAN NOT NULL,
   PRIMARY KEY(Id_etat_vehicule)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE transport_personnel (
   Id_personel INT AUTO_INCREMENT,
   nom VARCHAR(50) NOT NULL,
   prenom VARCHAR(50),
   date_arrive DATE,
   e_mail VARCHAR(150) NOT NULL,
   telephone INT NOT NULL,
   mdp VARCHAR(200) NOT NULL,
   dtc DATETIME,
   Id_statut_personnels INT NOT NULL,
   Id_role INT NOT NULL,
   PRIMARY KEY(Id_personel),
   FOREIGN KEY(Id_statut_personnels) REFERENCES transport_statut(Id_statut_personnels),
   FOREIGN KEY(Id_role) REFERENCES transport_roles(Id_role)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE transport_vehicules (
   Id_vehicule INT AUTO_INCREMENT,
   numero VARCHAR(50) NOT NULL,
   type VARCHAR(50) NOT NULL,
   date_ct DATE,
   km INT NOT NULL,
   Id_etat_vehicule INT NOT NULL,
   PRIMARY KEY(Id_vehicule),
   FOREIGN KEY(Id_etat_vehicule) REFERENCES transport_etat(Id_etat_vehicule)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE transport_commentaires (
   Id_commentaire INT AUTO_INCREMENT,
   texte VARCHAR(250) NOT NULL,
   dtc DATETIME,
   Id_vehicule INT NOT NULL,
   Id_personel INT NOT NULL,
   PRIMARY KEY(Id_commentaire),
   FOREIGN KEY(Id_vehicule) REFERENCES transport_vehicules(Id_vehicule),
   FOREIGN KEY(Id_personel) REFERENCES transport_personnel(Id_personel)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE transport_evaluation (
   Id_evaluation INT AUTO_INCREMENT,
   texte VARCHAR(250),
   dtc DATETIME,
   Id_personel INT NOT NULL,
   Id_personel_1 INT NOT NULL,
   PRIMARY KEY(Id_evaluation),
   FOREIGN KEY(Id_personel) REFERENCES transport_personnel(Id_personel),
   FOREIGN KEY(Id_personel_1) REFERENCES transport_personnel(Id_personel)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
