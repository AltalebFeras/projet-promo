<?php include_once __DIR__ . '/../includes/header.php'; ?>

<div class="container mt-5">

    <div class="d-flex flex-row justify-content-center mb-5 my-5 titre-ajout">
        <h2><strong>Ajouter Personnel</strong></h2>
    </div>
    <a class="btn rounded-pill" href="<?= Domain . HOME_URL . 'dashboard' ?>">Retour</a>
    <div class="d-flex flex-row justify-content-center mb-5 my-5 logo-ajout">
        <img src="\assets\image\logo.png" alt="logo">

    </div>
    <div id="errorMessages" class="alert alert-danger" style="display:none;"></div>
    <div class="row ajout ">
        <div class="alert-container">
            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger"><?php echo $_GET['error']; ?></div>
            <?php endif; ?>
            <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success"><?php echo $_GET['success']; ?></div>
            <?php endif; ?>
        </div>
        <div class="col-lg-4 col-md-6">
            <form action="<?= Domain . HOME_URL . 'dashboard/personnel_detaille' ?>" method="POST" class="mb-4" onsubmit="return validateFormAjouterPersonnel();
    ">


                <div class="mb-3 d-flex flex-row justify-content-between">
                    <label for="nom" class="form-label d-flex">Nom :</label>
                    <input type="text" id="nom" name="nom" class="form-control ajout-nom" required>
                </div>

                <div class="mb-3 d-flex flex-row justify-content-between">
                    <label for="prenom" class="form-label">Prénom :</label>
                    <input type="text" id="prenom" name="prenom" class="form-control ajout-prenom" required>
                </div>

                <div class="mb-3 d-flex flex-row justify-content-between">
                    <label for="date_arrive" class="form-label">Date d'arrivée :</label>
                    <input type="date" id="date_arrive" name="date_arrive" class="form-control ajout-dta" required>
                </div>

                <div class="mb-3 d-flex flex-row justify-content-between">
                    <label for="telephone" class="form-label">Téléphone :</label>
                    <input type="tel" id="telephone" name="telephone" class="form-control ajout-tel" pattern="[0-9]{10}" required>
                </div>

                <div class="mb-3 d-flex flex-row justify-content-between">
                    <label for="email" class="form-label">Email :</label>
                    <input type="email" id="email" name="email" class="form-control ajout-email" required>
                </div>

                <div class="mb-3 d-flex flex-row justify-content-between">
                    <label for="mdp" class="form-label">Mot de passe :</label>
                    <input type="password" id="mdp" name="mdp" class="form-control ajout-mdp" required>
                </div>
                <div class="mb-3 d-flex flex-row justify-content-between">
                    <label for="mdpConfirmer" class="form-label">Confirmer mot de passe:</label>
                    <input type="password" id="mdpConfirmer" name="mdpConfirmer" class="form-control ajout-mdp" required>
                </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="mb-3 d-flex flex-row justify-content-between">
                <label for="Id_role" class="form-label">Rôle :</label>
                <select id="Id_role" name="Id_role" class="form-select ajout-role" required>
                    <option value="1">Admin</option>
                    <option value="2">Mécanicien</option>
                    <option value="3">Conducteur</option>
                </select>
            </div>

            <div class="mb-3 d-flex flex-row justify-content-between">
                <label for="Id_statut" class="form-label">Statut :</label>
                <select id="Id_statut" name="Id_statut" class="form-select ajout-statut" required>
                    <option value="1">Présent</option>
                    <option value="2">Vacances</option>
                    <option value="3">Maladie</option>
                </select>
            </div>

            <div class="mb-3 d-flex flex-row justify-content-between">
                <label for="date_debut" class="form-label">Date Début Statut :</label>
                <input type="date" id="date_debut" name="date_debut" class="form-control ajout-dtd-statut">
            </div>

            <div class="mb-3 d-flex flex-row justify-content-between">
                <label for="date_fin" class="form-label">Date Fin Statut :</label>
                <input type="date" id="date_fin" name="date_fin" class="form-control  ajout-dtf-statut">
            </div>


            <input type="hidden" name="action" value="ajout_personnel" />
            <button type="submit" class="btn rounded-pill">Ajouter</button>
            </form>
        </div>
    </div>
    <?php include_once __DIR__ . '/../includes/footer.php'; ?>