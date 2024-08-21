<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <img class="logo-admin" src="<?= Domain . HOME_URL . 'assets/image/Logo.png'?>" alt="Logo de l'entreprise" />
        <a class="btn btn-success rounded-pill" href="<?= Domain . HOME_URL ?>dashboard/ajouter_personnel">Ajouter Personnel</a>
    </div>

    <div class="alert-container">
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($_GET['error']); ?></div>
        <?php endif; ?>
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($_GET['success']); ?></div>
        <?php endif; ?>
    </div>

    <div class="d-flex mb-4">
        <p class="mb-0 me-2">Trier par type:</p>
        <select class="form-select w-auto">
            <option selected>Choisir ici</option>
            <option value="1">Administrateur</option>
            <option value="2">Conducteur</option>
            <option value="3">Mécanicien</option>
        </select>
    </div>

    <div class="row">
        <?php foreach ($personnels as $personnel) : ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($personnel['nom']) . ' ' . htmlspecialchars($personnel['prenom']) ?></h5>
                        <p class="card-text"><strong>Rôle:</strong> <?= htmlspecialchars($personnel['role_name']) ?></p>
                        <p class="card-text"><strong>Email:</strong> <?= htmlspecialchars($personnel['email']) ?></p>
                        <p class="card-text"><strong>Téléphone:</strong> <?= htmlspecialchars($personnel['telephone']) ?></p>
                        <p class="card-text"><strong>Évaluation:</strong> <?= isset($personnel['last_evaluation']) ? htmlspecialchars($personnel['last_evaluation']) : 'Aucune évaluation' ?></p>
                        <a href="<?= Domain . HOME_URL . 'dashboard/personnel_detaille?Id_personnel=' . $personnel['Id_personnel'] ?>" class="btn btn-primary">Détails</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
