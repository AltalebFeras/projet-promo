<?php include_once __DIR__ . '/../includes/header.php'; ?>

<div class="container-fluid">

    <p>Hello from dashboard</p>
    <?php //var_dump($_SESSION); ?>
    <p>Bonjour <?php echo $_SESSION['nom'] ?></p>
        <a href="<?= Domain . HOME_URL  ?>deconnexion">deconnexion</a>
    <?php
    if ($_SESSION['role'] === 'admin'):

        include_once __DIR__ . '/admin.php';

    elseif ($_SESSION['role'] === 'conducteur'):

        include_once __DIR__ . '/conducteur.php';

    elseif ($_SESSION['role'] === 'mecanicien'):

        include_once __DIR__ . '/mecanicien.php';

    else:
    echo 'Error - Please sign out';
    endif;
    ?>


</div>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>