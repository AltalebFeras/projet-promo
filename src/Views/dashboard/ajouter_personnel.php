<?php include_once __DIR__ . '/../includes/header.php'; ?>
<?php if ($_SESSION['role'] === 'admin'): ?>
    <div class="container-fluid">

        <p>Hello from Crud admin</p>
        <p>Bonjour <?php echo $_SESSION['nom'] ?></p>
        <a href="<?= Domain . HOME_URL  ?>deconnexion">deconnexion</a>

        <p>ici l'daimin fait le crud</p>

    </div>
<?php else:
    echo 'Erreur - vous devez vous désinscrire'; ?>
    <a href="<?= Domain . HOME_URL  ?>deconnexion">deconnexion</a>
<?php
endif;
?>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>