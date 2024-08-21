<?php include_once __DIR__ . '/../includes/header.php'; ?>


<p>page personnel detaille</p>


<h1>Personnel Details</h1>

<form action="" method="post">
    <label for="nom">Nom</label>
    <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($personnel['nom']) ?>"><br>
    <label for="prenom">Prénom</label>
    <input type="text" id="prenom" name="prenom" value="<?= htmlspecialchars($personnel['prenom']) ?>"><br>

    <label for="date_arrive">Date d'arrivée</label>
    <input type="date" id="date_arrive" name="date_arrive" value="<?= htmlspecialchars($personnel['date_arrive']) ?>"><br>

    <label for="email">Email</label>
    <input type="email" id="email" name="email" value="<?= htmlspecialchars($personnel['email']) ?>"><br>
    <label for="telephone">Téléphone</label>
    <input type="text" id="telephone" name="telephone" value="<?= htmlspecialchars($personnel['telephone']) ?>"><br>
    
    <button type="submit">Modifier</button>
</form>

<p>Le personnel est actuellement : </p>
<p>Déclarer un changement ?</p>

<form action="">
    <select id="statut" name="statut">
        <option value="">Selectionnez un statut</option>
        <?php foreach ($statuts as $statut) : ?>
            <option value="<?= $statut['Id_statut_personnels'] ?>"><?= $statut['statut_personnels'] ?>
        </option>
        <?php endforeach; ?>
    </select>

    <button onclick="changeStatut(<?= $personnel['Id_personnel'] ?>)">Changer le statut</button>
</form>


<p>Ajouter une évaluation :</p>


<form method="post" action="<?= HOME_URL . 'dashboard/personnel_detaille?Id_personnel=' . $personnel['Id_personnel'] ?>">
    <input type="hidden" name="Id_admin" value="<?= $_SESSION['Id_personnel'] ?>" />
    <input type="hidden" name="Id_personnel" value="<?= $_GET['Id_personnel'] ?>" />
    <input type="hidden" name="action" value="ajouter_evaluation" /> <!-- Hidden action field -->
    <label for="texte">Ajouter une évaluation:</label>
    <input type="text" name="texte" id="texte" />
    <button type="submit">Soumettre</button>
</form>
<p><strong>Last Evaluation:</strong> <?= isset($personnel['evaluation']) ? htmlspecialchars($personnel['evaluation']) : 'No evaluation available' ?></p>

<p>Effacer ce personnel ?</p>
<form action="">
    <button onclick="deletePersonnel(<?= $personnel['Id_personnel'] ?>)"><i class="bi bi-trash"></i></button>
</form>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>
