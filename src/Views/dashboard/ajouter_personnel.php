<?php include_once __DIR__ . '/../includes/header.php'; ?>
<?php if ($_SESSION['role'] === 'admin'): ?>
    <div class="container-fluid">

        <p>Hello from Crud admin</p>
        <p>Bonjour <?php echo $_SESSION['nom'] ?></p>
        <a href="<?= Domain . HOME_URL  ?>deconnexion">deconnexion</a>

 
    <h1>Ajouter Personnel</h1>
    <form action="your_php_processing_script.php" method="POST">
        <label for="nom">Nom:</label><br>
        <input type="text" id="nom" name="nom" required><br><br>

        <label for="prenom">Prénom:</label><br>
        <input type="text" id="prenom" name="prenom" required><br><br>

        <label for="date_arrive">Date d'arrivée:</label><br>
        <input type="date" id="date_arrive" name="date_arrive" required><br><br>

        <label for="telephone">Téléphone:</label><br>
        <input type="tel" id="telephone" name="telephone" pattern="[0-9]{10}" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="mdp">Mot de passe:</label><br>
        <input type="password" id="mdp" name="mdp" required><br><br>

        <label for="Id_role">Rôle:</label><br>
        <select id="Id_role" name="Id_role" required>
            <option value="1">Admin</option>
            <option value="2">Mécanicien</option>
            <option value="3">Conducteur</option>
        </select><br><br>

        <label for="Id_statut">Statut:</label><br>
        <select id="Id_statut" name="Id_statut" required>
            <option value="1">Présent</option>
            <option value="2">Vacances</option>
            <option value="3">Maladie</option>
        </select><br><br>

        <label for="date_debut">Date Début Statut:</label><br>
        <input type="date" id="date_debut" name="date_debut"><br><br>

        <label for="date_fin">Date Fin Statut:</label><br>
        <input type="date" id="date_fin" name="date_fin"><br><br>

        <button type="submit">Ajouter</button>
    </form>
 


    </div>
<?php else:
    echo 'Erreur - vous devez vous désinscrire'; ?>
    <a href="<?= Domain . HOME_URL  ?>deconnexion">deconnexion</a>
<?php
endif;
?>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>