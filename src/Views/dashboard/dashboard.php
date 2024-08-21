<?php include_once __DIR__ . '/../includes/header.php'; ?>

<div class="container-fluid mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Dashboard</h2>
        <a href="<?= Domain . HOME_URL ?>deconnexion" class="btn btn-outline-danger">Déconnexion</a>
    </div>

    <div class="alert-container">
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($_GET['error']); ?></div>
        <?php endif; ?>
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($_GET['success']); ?></div>
        <?php endif; ?>
    </div>

    <p class="lead">Bonjour, <strong><?php echo $_SESSION['nom'] ?></strong></p>

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
