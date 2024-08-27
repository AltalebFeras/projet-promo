<?php include_once __DIR__ . '/../includes/header.php'; ?>

<div class="container mt-5">
    <a class="btn rounded-pill" href="<?= Domain . HOME_URL . 'dashboard' ?>">Retour</a>
    <!-- Logo and Title Section -->
    <div class="text-center mb-5">
        <img src="<?= Domain . HOME_URL ?>assets\image\logo.png" alt="logo" class="img-fluid mb-3" style="max-width: 150px;">
        <h2 class="fw-bold"><?= $vehicule['numero'] ?? 'Non disponible' ?></h2>
        <p class="text-muted"><?= $vehicule['type'] ?? 'Non disponible' ?></p>
    </div>

    <!-- Alert Section -->
    <div class="alert-container">
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger"><?= $_GET['error'] ?></div>
        <?php endif; ?>
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success"><?= $_GET['success'] ?></div>
        <?php endif; ?>
    </div>

    <!-- Vehicle Details -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="mb-3">
                <strong>Le véhicule est actuellement :</strong>
                <p><?= $vehicule['etat_nom'] ?? 'Non disponible' ?></p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <?php if (($_SESSION['role'] === 'mecanicien' && $vehicule['etat_nom'] === 'circulation') ||
                    ($_SESSION['role'] === 'conducteur' && $vehicule['etat_nom'] === 'garage')
                ) : ?>
                    <p class="text-info">Vous ne pouvez pas déclarer un changement pour ce véhicule</p>
                <?php else: ?>

                    <strong>Déclarer un changement ?</strong>
                    <form action="<?= Domain . HOME_URL ?>dashboard/vehicule_detaille" method="post">
                        <select name="Id_etat_vehicule" id="etat" class="form-control" required>
                            <?php foreach ($etats as $etat): ?>
                                <option value="<?= $etat['Id_etat_vehicule'] ?>"
                                    <?= $etat['Id_etat_vehicule'] == $vehicule['Id_etat_vehicule'] ? 'selected' : '' ?>>
                                    <?= $etat['nom'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <input type="hidden" name="action" value="declarer_un_changement_du_lieu">
                        <input type="hidden" name="Id_vehicule" value="<?= $_GET['Id_vehicule'] ?>">
                        <button type="submit" class="btn btn-primary mt-2">Déclarer</button>
                    </form>

                <?php endif; ?>


            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="mb-3">
                <strong>Kilométrage :</strong>
                <p><?= isset($vehicule['km']) ? $vehicule['km'] . ' km' : 'Non disponible' ?></p>
            </div>
        </div>
        <div class="col-md-6">
            <?php if ($_SESSION['role'] === 'conducteur'): ?>
                <form action="<?= Domain . HOME_URL ?>dashboard/vehicule_detaille" method="post">
                    <div class="mb-3">
                        <strong>Entrez la nouvelle valeur :</strong>
                        <input type="number" name="km" id="km" class="form-control" required placeholder="Entrez la nouvelle valeur">
                    </div>
                    <input type="hidden" name="action" value="ajouter_kilometrage">
                    <input type="hidden" name="Id_vehicule" value="<?= $_GET['Id_vehicule'] ?>">
                    <button type="submit" class="btn rounded-pill mt-2">Mettre à Jour</button>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="mb-3">
                <strong>Dernier C.T. :</strong>
                <p><?= isset($vehicule['date_ct']) ? $vehicule['date_ct'] : 'Non disponible' ?></p>
            </div>
        </div>
        <?php if ($_SESSION['role'] === 'mecanicien'): ?>

            <div class="col-md-6">
                <form id="updateForm" action="<?= Domain . HOME_URL ?>dashboard/vehicule_detaille" method="post">

                    <input type="hidden" name="action" value="ajouter_C_T">
                    <input type="hidden" name="Id_vehicule" value="<?= $_GET['Id_vehicule'] ?>">
                    <button type="submit" class="btn rounded-pill mt-2" onclick="return confirmSubmit()">Mettre à jour</button>
                </form>
            </div>
    </div>
<?php endif; ?>

<script>
    function confirmSubmit() {
        return confirm("Are you sure you want to update?");
    }
</script>

<!-- Comment Sections -->
<div class="row mb-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Commentaire conducteur</h5>
                <?php if (!empty($commentaire_conducteur)): ?>
                    <p><?= htmlspecialchars($commentaire_conducteur[0]['texte']) ?></p>
                    <p class="text-muted"><?= date('d M. Y H:i', strtotime($commentaire_conducteur[0]['dtc'])) ?></p>
                    <p><strong>Par:</strong> <?= htmlspecialchars($commentaire_conducteur[0]['prenom']) ?> <?= htmlspecialchars($commentaire_conducteur[0]['nom']) ?></p>
                <?php else: ?>
                    <p>Aucun commentaire disponible.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Commentaire mécanos</h5>
                <?php if (!empty($commentaire_mecanicien)): ?>
                    <p><?= htmlspecialchars($commentaire_mecanicien[0]['texte']) ?></p>
                    <p class="text-muted"><?= date('d M. Y H:i', strtotime($commentaire_mecanicien[0]['dtc'])) ?></p>
                    <p><strong>Par:</strong> <?= htmlspecialchars($commentaire_mecanicien[0]['prenom']) ?> <?= htmlspecialchars($commentaire_mecanicien[0]['nom']) ?></p>
                <?php else: ?>
                    <p>Aucun commentaire disponible.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Add Comment Section -->
<div class="row mb-5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Ajouter un commentaire</h5>
                <form action="<?= Domain . HOME_URL ?>dashboard/vehicule_detaille" method="post">
                    <textarea name="texte" id="texte" class="form-control mb-3" rows="4" required placeholder="Zone pour ajouter le commentaire"></textarea>
                    <input type="hidden" name="action" value="ajouter_commentaire">
                    <input type="hidden" name="Id_vehicule" value="<?= $_GET['Id_vehicule'] ?>">
                    <button type="submit" class="btn rounded-pill">Ajouter Commentaire</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>