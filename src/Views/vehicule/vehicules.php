<div class="container">
    <div class="row align-items-center mb-5">
        <div class="col-md-3">
            <img class="logo-admin" src="<?= Domain . HOME_URL . 'assets/image/Logo.png' ?>" alt="Logo de l'entreprise" />
        </div>

        <div class="col-sm-3">
            <a class="btn btn-bg-color rounded-pill" href="<?= Domain . HOME_URL ?>dashboard/ajouter_vehicule">Ajouter Véhicule</a>
        </div>

        <div class="col-sm-3">
            <div class="d-flex">
                <p class="mb-0 me-2">Trier par type:</p>
                <select class="form-select w-auto" onchange="location = this.value;">
                    <option selected class="bg-warning">Choisir ici</option>
                    <option value="<?= Domain . HOME_URL ?>dashboard/vehicules?type=bus">Bus</option>
                    <option value="<?= Domain . HOME_URL ?>dashboard/vehicules?type=tram">Tram</option>
                </select>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="d-flex">
                <p class="mb-0 me-2">Trier par état:</p>
                <select class="form-select w-auto" onchange="location = this.value;">
                    <option selected>Choisir ici</option>
                    <option value="<?= Domain . HOME_URL ?>dashboard/vehicules?etat=circulation">Circulation</option>
                    <option value="<?= Domain . HOME_URL ?>dashboard/vehicules?etat=parking">Parking</option>
                    <option value="<?= Domain . HOME_URL ?>dashboard/vehicules?etat=garage">Garage</option>
                </select>
            </div>
        </div>
    </div>

    <div class="alert-container">
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($_GET['error']); ?></div>
        <?php endif; ?>
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($_GET['success']); ?></div>
        <?php endif; ?>
    </div>

    <!-- Section for all vehicles -->
    <div class="row">
        <?php foreach ($allVehicules as $vehicule) : ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($vehicule['numero']) ?></h5>
                        <p class="card-text"><strong>Type:</strong> <?= htmlspecialchars($vehicule['type']) ?></p>
                        <p class="card-text"><strong>Date de CT:</strong> <?= htmlspecialchars($vehicule['date_ct']) ?></p>
                        <p class="card-text"><strong>Kilométrage:</strong> <?= htmlspecialchars($vehicule['km']) ?> km</p>
                        <p><strong>État du véhicule:</strong> <?= htmlspecialchars($vehicule['etat']) ?></p>
                        <a href="<?= Domain . HOME_URL . 'dashboard/vehicule_detaille?Id_vehicule=' . $vehicule['Id_vehicule'] ?>" class="btn rounded-pill">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
