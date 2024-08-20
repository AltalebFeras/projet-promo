<?php include_once __DIR__ . '/../includes/header.php'; ?>

<div class="container-fluid">

    <p>Hello from dashboard</p>
    <?php var_dump($_SESSION); ?>
    <p>Bonjour <?php  echo $_SESSION['nom']?></p>
    <?php if ($_SESSION['role'] === 'conducteur'): ?>
    <p>ok</p>
<?php else: ?>
    <p>ko</p>
<?php endif; ?>

</div>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>
