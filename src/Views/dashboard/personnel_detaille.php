<?php include_once __DIR__ . '/../includes/header.php'; ?>

<div class="container mt-5">

                      <div class="d-flex flex-row justify-content-center mb-5 my-5 titre-detail">              
    <h2><strong>Ajouter/Editer Personnel</strong></h2>
                      </div>
                      <div class="d-flex flex-row justify-content-center mb-5 my-5 logo"> 
                      <img src="\assets\image\logo.png" alt="logo">
</div>

                      <div class="row">
    <div class="alert-container">
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($_GET['error']); ?></div>
        <?php endif; ?>
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($_GET['success']); ?></div>
        <?php endif; ?>
    </div>
<div class="col-md-4  align-self-center">
    <form method="post" action="<?= HOME_URL . 'dashboard/personnel_detaille?Id_personnel=' . $personnel['Id_personnel'] ?>" class="mb-4">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" id="nom" name="nom" class="form-control nom-detail" value="<?= htmlspecialchars($personnel['nom']) ?>">
        </div>

        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" id="prenom" name="prenom" class="form-control prenom-detail" value="<?= htmlspecialchars($personnel['prenom']) ?>">
        </div>

        <div class="mb-3">
            <label for="date_arrive" class="form-label">Date d'arrivée</label>
            <input type="date" id="date_arrive" name="date_arrive" class="form-control dtc-detail" value="<?= htmlspecialchars($personnel['date_arrive']) ?>">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control email-detail" value="<?= htmlspecialchars($personnel['email']) ?>">
        </div>

        <div class="mb-3">
            <label for="telephone" class="form-label">Téléphone</label>
            <input type="text" id="telephone" name="telephone" class="form-control telephone-detail" value="<?= htmlspecialchars($personnel['telephone']) ?>">
        </div>

        <input type="hidden" name="action" value="edit_personnel modifier-detail" />
        <button type="submit" class="btn btn-warning">Modifier</button>
    </form>
    </div>

    <div class="col-md-4">
    <p><strong>Statut Actuel:</strong> <?= $statuts_personnel ? htmlspecialchars($statuts_personnel['status_name']) : 'Aucun statut trouvé' ?></p>
    <?php if ($statuts_personnel['status_name'] !== 'present') : ?>
    <p>Du : </strong> <?= $statuts_personnel ? htmlspecialchars($statuts_personnel['date_debut']) : 'Aucun date trouvé' ?> </p>
    <p>Au : </strong> <?= $statuts_personnel? htmlspecialchars($statuts_personnel['date_fin']) : 'Aucun date trouvé'?></p>
    <?php endif;?>

    <h4 class="mt-4">Déclarer un changement</h4>
    <form method="post" action="<?= HOME_URL . 'dashboard/personnel_detaille?Id_personnel=' . $personnel['Id_personnel'] ?>" class="mb-4">
        <div class="mb-3">
            <label for="statut" class="form-label">Sélectionnez un statut</label>
            <select id="statut" name="Id_statut" class="form-select statut-detail">
                <option value="">Choisir...</option>
                <?php foreach ($statuts as $statut) : ?>
                    <option value="<?= $statut['Id_statut'] ?>"><?= htmlspecialchars($statut['nom']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div id="divForStatusDates" class="mb-3">
            <label for="date_debut" class="form-label">Date Début Statut</label>
            <input type="date" id="date_debut" name="date_debut" class="form-control debut-statut"><br>

            <label for="date_fin" class="form-label">Date Fin Statut</label>
            <input type="date" id="date_fin" name="date_fin" class="form-control fin-statut">
        </div>

        <input type="hidden" name="action" value="changer_status_personnel" />
        <input type="hidden" name="Id_personnel" value="<?= $personnel['Id_personnel'] ?>" />
        <button type="submit" class="btn btn-info">Déclarer</button>
    </form>
                </div>

                <div class="col-md-4 col-sm-12">
    <?php if ($personnel['role_name'] != 'admin') : ?>
        <h4 class="mt-4">Ajouter une évaluation</h4>
        <form method="post" action="<?= HOME_URL . 'dashboard/personnel_detaille?Id_personnel=' . $personnel['Id_personnel'] ?>" class="mb-4">
            <input type="hidden" name="Id_admin" value="<?= $_SESSION['Id_personnel'] ?>" />
            <input type="hidden" name="Id_personnel" value="<?= $_GET['Id_personnel'] ?>" />
            <input type="hidden" name="action" value="ajouter_evaluation" />

            <div class="mb-3">
                <label for="texte" class="form-label">Evaluation</label>
                <input type="text" name="texte" id="texte" class="form-control evaluation-detail" />
            </div>

            <button type="submit" class="btn btn-primary">Soumettre</button>
        </form>

        <div class="mb-3 der-eval">
            <p><strong>Dernière évaluation:</strong> <?= isset($personnel['evaluation']) ? htmlspecialchars($personnel['evaluation']) : 'Pas d\'évaluation disponible' ?></p>
            </div>
    </div>
       
    <?php else : ?>
        <p class="text-danger">Vous ne pouvez pas évaluer ce personnel !</p>
    <?php endif; ?>
        <div class="col-md-4">
    <h4 class="mt-4">Effacer ce personnel</h4>
    <form method="post" action="<?= HOME_URL . 'dashboard/personnel_detaille?Id_personnel=' . $personnel['Id_personnel'] ?>">
        <input type="hidden" name="action" value="suprimmer_personnel" />
        <input type="hidden" name="Id_personnel" value="<?= $personnel['Id_personnel'] ?>" />
        <button type="submit" class="btn btn-danger"><i class="bi bi-trash">Effacer</i></button>
    </form>
    </div>
    </div>
</div>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>
