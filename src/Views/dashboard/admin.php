<div class="container">
    <div class="row align-items-center mb-5">
        
        <div class="col-md-3">
            <img class="logo-admin" src="<?= Domain . HOME_URL . 'assets/image/Logo.png'?>" alt="Logo de l'entreprise" />
        </div>

        <div class="col-sm-3 ">
            <a class="btn btn-bg-color rounded-pill" href="<?= Domain . HOME_URL ?>dashboard/ajouter_personnel">Ajouter Personnel</a>
        </div>

        <div class="col-sm-3 ">
            <div class="d-flex">
                <p class="mb-0 me-2">Trier par type:</p>
                <select class="form-select w-auto">
                    <option selected class="bg-warning">Choisir ici</option>
                    <option value="1">Administrateur</option>
                    <option value="2">Conducteur</option>
                    <option value="3">Mécanicien</option>
                </select>
            </div>
        </div>

        <div class="col-sm-3 ">
            <div class="d-flex">
                <p class="mb-0 me-2">Trier par type:</p>
                <select class="form-select w-auto">
                    <option selected>Choisir ici</option>
                    <option value="1">Administrateur</option>
                    <option value="2">Conducteur</option>
                    <option value="3">Mécanicien</option>
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

    <!-- Section for the logged-in user's card -->
    <?php foreach ($allPersonnelsWithStatus as $personnel) : ?>
        <?php if ($_SESSION['Id_personnel'] == $personnel['Id_personnel']) : ?>
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-info">Mon Compte: <?= htmlspecialchars($personnel['nom']) . ' ' . htmlspecialchars($personnel['prenom']) ?></h5>
                            <p class="card-text"><strong>Rôle:</strong> <?= htmlspecialchars($personnel['role_name']) ?></p>
                            <p class="card-text"><strong>Email:</strong> <?= htmlspecialchars($personnel['email']) ?></p>
                            <p class="card-text"><strong>Téléphone:</strong> <?= htmlspecialchars($personnel['telephone']) ?></p>
                            <p><strong>Statut du personnel:</strong> <?= htmlspecialchars($personnel['status_name']) ?></p>
                            <p class="card-text"><strong>Évaluation:</strong> <?= isset($personnel['last_evaluation']) ? htmlspecialchars($personnel['last_evaluation']) : 'Aucune évaluation' ?></p>
                            <a href="<?= Domain . HOME_URL . 'dashboard/personnel_detaille?Id_personnel=' . $personnel['Id_personnel'] ?>" class="btn btn-primary">Détails</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>

    <!-- Section for all other personnel -->
    <div class="row">
        <?php foreach ($allPersonnelsWithStatus  as $personnel) : ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= $personnel['nom'] . ' ' . $personnel['prenom'] ?></h5>
                        <p class="card-text"><strong>Rôle:</strong> <?= $personnel['role_name'] ?></p>
                        <p class="card-text"><strong>Email:</strong> <?= $personnel['email'] ?></p>
                        <p class="card-text"><strong>Téléphone:</strong> <?= $personnel['telephone'] ?></p>
                        <p><strong>Statut du personnel:</strong> <?= $personnel['status_name'] ?> </p>
                        <p class="card-text"><strong>Évaluation:</strong> <?= isset($personnel['last_evaluation']) ? $personnel['last_evaluation'] : 'Aucune évaluation' ?></p>
                        <a href="<?= Domain . HOME_URL . 'dashboard/personnel_detaille?Id_personnel=' . $personnel['Id_personnel'] ?>" class="btn btn-primary">Détails</a>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>
