<div class="container">
    <div class="row nav-mobile align-items-center mb-5">
        <div class="col-lg-3 col-md-6 mobile-center">
            <img class="logo-admin" src="<?= Domain . HOME_URL . 'assets/image/Logo.png' ?>" alt="Logo de l'entreprise" />
        </div>

       

        <div class="col-lg-3 col-md-6">
            <div class="d-flex gap-1 mob-center">
                <p class="mb-0">Trier par type:</p>
                <select class="form-select w-auto p-0" onchange="location = this.value;">
                    <option selected class="bg-warning">Choisir ici</option>
                    <option value="<?= Domain . HOME_URL ?>dashboard?vehicules_type=bus">Bus</option>
                    <option value="<?= Domain . HOME_URL ?>dashboard?vehicules_type=tram">Tram</option>
                </select>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="d-flex gap-1 mob-center">
                <p class="mb-0">Trier par état:</p>
                <select class="form-select w-auto p-0" onchange="location = this.value;">
                    <option selected>Choisir ici</option>
                    <option value="<?= Domain . HOME_URL ?>dashboard?vehicules_etat=circulation">Circulation</option>
                    <option value="<?= Domain . HOME_URL ?>dashboard?vehicules_etat=parking">Parking</option>
                    <option value="<?= Domain . HOME_URL ?>dashboard?vehicules_etat=garage">Garage</option>
                </select>
            </div>
        </div>
    </div>

    <div class="alert-container">
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger"><?php echo $_GET['error']; ?></div>
        <?php endif; ?>
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success"><?php echo $_GET['success']; ?></div>
        <?php endif; ?>
    </div>

    <!-- Section for all vehicles -->
    <div class="row">
        <?php foreach ($vehicules as $vehicule) : ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="p-5 card-body">
                        <h5 class="card-title"><?= htmlspecialchars($vehicule['numero']) ?></h5>
                        <p class="card-text"><strong>Type:</strong> <?= htmlspecialchars($vehicule['type']) ?></p>
                        <p class="card-text"><strong>Date de CT:</strong> <?= htmlspecialchars($vehicule['date_ct']) ?></p>
                        <p class="card-text"><strong>Kilométrage:</strong> <?= htmlspecialchars($vehicule['km']) ?> km</p>

                        <div class="etat-vehicule">
                        <p><strong>État du véhicule:</strong> <?= htmlspecialchars($vehicule['etat_nom']) ?></p>
                        </div>
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
