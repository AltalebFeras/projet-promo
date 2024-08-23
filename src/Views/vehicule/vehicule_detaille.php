<?php include_once __DIR__ . '/../includes/header.php'; ?>


<div class="container mt-5">
    <!-- Vehicle Details Section -->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Détails du Véhicule</h5>
                    <p class="card-text"><strong>Numéro de Véhicule:</strong> <?= htmlspecialchars($vehicule['numero']) ?></p>
                    <p class="card-text"><strong>Type:</strong> <?= htmlspecialchars($vehicule['type']) ?></p>
                    <p class="card-text"><strong>Date de CT:</strong> <?= htmlspecialchars($vehicule['date_ct']) ?></p>
                    <p class="card-text"><strong>Kilométrage:</strong> <?= htmlspecialchars($vehicule['km']) ?> km</p>
                    <p class="card-text"><strong>État du véhicule:</strong> <?= htmlspecialchars($vehicule['etat_nom']) ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Form to Update Kilométrage -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Mettre à Jour le Kilométrage</h5>
                    <form action="<?= Domain . HOME_URL ?>dashboard/update_kilometrage" method="post">
                        <div class="form-group mb-3">
                            <label for="km">Kilométrage Actuel</label>
                            <input type="number" name="km" id="km" class="form-control" required>
                        </div>
                        <input type="hidden" name="Id_vehicule" value="<?= $vehicule['Id_vehicule'] ?>">
                        <button type="submit" class="btn btn-bg-color">Mettre à Jour</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Form for Conducteur Commentaire -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Commentaire du Conducteur</h5>
                    <form action="<?= Domain . HOME_URL ?>dashboard/add_conducteur_commentaire" method="post">
                        <div class="form-group mb-3">
                            <label for="commentaire_conducteur">Commentaire</label>
                            <textarea name="commentaire_conducteur" id="commentaire_conducteur" class="form-control" rows="4" required></textarea>
                        </div>
                        <input type="hidden" name="Id_vehicule" value="<?= $vehicule['Id_vehicule'] ?>">
                        <button type="submit" class="btn btn-bg-color">Ajouter Commentaire</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Form for Mécanicien Commentaire -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Commentaire du Mécanicien</h5>
                    <form action="<?= Domain . HOME_URL ?>dashboard/add_mecanicien_commentaire" method="post">
                        <div class="form-group mb-3">
                            <label for="commentaire_mecanicien">Commentaire</label>
                            <textarea name="commentaire_mecanicien" id="commentaire_mecanicien" class="form-control" rows="4" required></textarea>
                        </div>
                        <input type="hidden" name="Id_vehicule" value="<?= $vehicule['Id_vehicule'] ?>">
                        <button type="submit" class="btn btn-bg-color">Ajouter Commentaire</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once __DIR__ . '/../includes/footer.php'; ?>
