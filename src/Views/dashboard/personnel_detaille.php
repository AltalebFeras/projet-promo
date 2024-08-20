    <p>page personnel detaille</p>

 
    <h1>Personnel Details</h1>
    <p><strong>Name:</strong> <?= htmlspecialchars($personnel['nom']) ?> <?= htmlspecialchars($personnel['prenom']) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($personnel['email']) ?></p>
    <p><strong>Telephone:</strong> <?= htmlspecialchars($personnel['telephone']) ?></p>
    <p><strong>Role:</strong> <?= htmlspecialchars($personnel['role_name']) ?></p>
    <p><strong>Status:</strong> <?= htmlspecialchars($personnel['statut_personnels']) ?></p>
    <p><strong>Last Evaluation:</strong> <?= isset($personnel['evaluation']) ? htmlspecialchars($personnel['evaluation']) : 'No evaluation available' ?></p>

    <form method="post" action="<?= HOME_URL . 'dashboard/personnel_detaille?Id_personnel=' . $personnel['Id_personnel'] ?>">
    <input type="hidden" name="Id_admin" value="<?= $_SESSION['Id_personnel'] ?>"/>
    <input type="hidden" name="Id_personnel" value="<?= $_GET['Id_personnel'] ?>"/>
    <input type="hidden" name="action" value="ajouter_evaluation"/> <!-- Hidden action field -->
    <label for="texte">Ajouter une évaluation:</label>
    <input type="text" name="texte" id="texte"/>
    <button type="submit">Soumettre</button>
</form>

