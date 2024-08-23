<?php include_once __DIR__ . '/../includes/header.php'; ?>

<div class="container-fluid mt-5">
    <div class="d-flex justify-content-end align-items-center mb-4">
        <a href="<?= Domain . HOME_URL ?>deconnexion" class="btn rounded-pill">Déconnexion</a>

    </div>

    <div class="role-content">
        <?php
        if ($_SESSION['role'] === 'admin'):
            include_once __DIR__ . '/admin.php';
        elseif ($_SESSION['role'] === 'conducteur'):
            include_once __DIR__ . '/conducteur.php';
        elseif ($_SESSION['role'] === 'mecanicien'):
            include_once __DIR__ . '/mecanicien.php';
        else:
            echo '<div class="alert alert-warning">Erreur - veuillez vous déconnecter</div>';
        endif;
        ?>
    </div>
</div>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>
