<?php include_once __DIR__ . '/../includes/header.php'; ?>

<div class="container mt-5">
    <!-- Vehicle Details Section -->
    <div class="d-flex flex-row justify-content-center mb-5 my-5 titre-detail">
        <h2>Détails du Véhicule</h2>
    </div>
    <div class="d-flex flex-row justify-content-center mb-5 my-5 logo">
        <img src="\assets\image\logo.png" alt="logo">
    </div>

    <div class="alert-container">
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger"><?= $_GET['error'] ?></div>
        <?php endif; ?>
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success"><?= $_GET['success'] ?></div>
        <?php endif; ?>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Détails du Véhicule</h5>
                    <p class="card-text"><strong>Numéro de Véhicule:</strong> <?= $vehicule['numero'] ?? 'Non disponible' ?></p>
                    <p class="card-text"><strong>Type:</strong> <?= $vehicule['type'] ?? 'Non disponible' ?></p>
                    <p class="card-text"><strong>Date de CT:</strong> <?= isset($vehicule['date_ct']) ? $vehicule['date_ct'] : 'Non disponible' ?></p>
                    <p class="card-text"><strong>Kilométrage:</strong> <?= isset($vehicule['km']) ? $vehicule['km'] . ' km' : 'Non disponible' ?></p>
                    <p class="card-text"><strong>État du véhicule:</strong> <?= $vehicule['etat_nom'] ?? 'Non disponible' ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Form to Update Kilométrage -->
    <?php if ($_SESSION['role'] === 'conducteur'): ?>
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Mettre à Jour le Kilométrage</h5>
                        <form action="<?= Domain . HOME_URL ?>dashboard/vehicule_detaille" method="post">
                            <div class="form-group mb-3">
                                <label for="km">Kilométrage Actuel</label>
                                <input type="number" name="km" id="km" class="form-control" required>
                            </div>
                            <input type="hidden" name="action" value="ajouter_kilometrage">
                            <input type="hidden" name="Id_vehicule" value="<?= $_GET['Id_vehicule'] ?>">
                            <button type="submit" class="btn btn-bg-color">Mettre à Jour</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Form for Updating Lieu -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Déclarer un changement ?</h5>
                    <form action="<?= Domain . HOME_URL ?>dashboard/vehicule_detaille" method="post">
                        <div class="form-group mb-3">
                            <label for="etat">Lieu Actuel</label>
                            <select name="Id_etat_vehicule" id="etat" class="form-control" required>
                                <?php foreach ($etats as $etat): ?>
                                    <option value="<?= $etat['Id_etat_vehicule'] ?>"
                                        <?= $etat['Id_etat_vehicule'] == $vehicule['Id_etat_vehicule'] ? 'selected' : '' ?>>
                                        <?= $etat['nom'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <input type="hidden" name="action" value="declarer_un_changement_du_lieu">
                        <input type="hidden" name="Id_vehicule" value="<?= $_GET['Id_vehicule'] ?>">
                        <button type="submit" class="btn btn-bg-color">Déclarer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Form for Updating CT -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Dernier C.T.</h5>
                    <form action="<?= Domain . HOME_URL ?>dashboard/vehicule_detaille" method="post">
                        <input type="hidden" name="action" value="ajouter_C_T">
                        <input type="hidden" name="Id_vehicule" value="<?= $_GET['Id_vehicule'] ?>">
                        <button type="submit" class="btn btn-bg-color">Mettre à jour</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Comment Section -->
    <div class="row mt-4">
        <!-- conducteur Section -->
        <div class="d-flex align-items-baseline gap-5">

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <h5 class="card-title">Commentaire conducteur</h5>
                            <?php if (isset($commentaire['texte'])): ?>
                                <p><?= $commentaire['texte'] ?></p>
                                <p><?= date('d M. Y H:i', strtotime($commentaire['dtc'])) ?></p>
                            <?php else: ?>
                                <p>Aucun commentaire disponible.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- mécanos Section -->

            <div class="col-md-6 mt-4">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <h5 class="card-title">Commentaire mécanos</h5>
                            <?php if (isset($commentaire['texte'])): ?>
                                <p><?= $commentaire['texte'] ?></p>
                                <p><?= date('d M. Y H:i', strtotime($commentaire['dtc'])) ?></p>
                            <?php else: ?>
                                <p>Aucun commentaire disponible.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Ajouter un Commentaire Section -->
        </div>

        <div class="col-md-12 mt-4 my-5">
            <div class="card">
                <div class="card-body">
                    <form action="<?= Domain . HOME_URL ?>dashboard/vehicule_detaille" method="post">
                        <div class="form-group mb-3">
                            <label for="texte">Ajouter un commentaire</label>
                            <textarea name="texte" id="texte" class="form-control" required></textarea>
                        </div>
                        <input type="hidden" name="action" value="ajouter_commentaire">
                        <input type="hidden" name="Id_vehicule" value="<?= $_GET['Id_vehicule'] ?>">
                        <button type="submit" class="btn btn-bg-color">Ajouter Commentaire</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>