<?php include_once __DIR__ . '/../includes/header.php'; ?>

<div class="container mt-5">
    <h2>Ajouter Personnel</h2>

    <div class="alert-container">
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($_GET['error']); ?></div>
        <?php endif; ?>
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($_GET['success']); ?></div>
        <?php endif; ?>
    </div>

    <form action="<?= Domain . HOME_URL .'dashboard/personnel_detaille' ?>" method="POST" class="mb-4">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" id="nom" name="nom" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" id="prenom" name="prenom" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="date_arrive" class="form-label">Date d'arrivée</label>
            <input type="date" id="date_arrive" name="date_arrive" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="telephone" class="form-label">Téléphone</label>
            <input type="tel" id="telephone" name="telephone" class="form-control" pattern="[0-9]{10}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="mdp" class="form-label">Mot de passe</label>
            <input type="password" id="mdp" name="mdp" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="Id_role" class="form-label">Rôle</label>
            <select id="Id_role" name="Id_role" class="form-select" required>
                <option value="1">Admin</option>
                <option value="2">Mécanicien</option>
                <option value="3">Conducteur</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="Id_statut" class="form-label">Statut</label>
            <select id="Id_statut" name="Id_statut" class="form-select" required>
                <option value="1">Présent</option>
                <option value="2">Vacances</option>
                <option value="3">Maladie</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="date_debut" class="form-label">Date Début Statut</label>
            <input type="date" id="date_debut" name="date_debut" class="form-control">
        </div>

        <div class="mb-3">
            <label for="date_fin" class="form-label">Date Fin Statut</label>
            <input type="date" id="date_fin" name="date_fin" class="form-control">
        </div>

        <input type="hidden" name="action" value="ajout_personnel" />
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>
