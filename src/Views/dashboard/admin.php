<?php   ?>

<p>page admin</p>
<a href="<?= Domain . HOME_URL  ?>dashboard/ajouter_personnel">Ajouter_personnel</a>

<div>



<?php foreach ($personnelsWithRolesAndStatus as $personnel) :?>
    <a href="<?= Domain . HOME_URL . 'dashboard/personnel_detaille?Id_personnel=' . $personnel['Id_personnel'] ?>">
        <p>
            <?=$personnel['nom']?> - <?=$personnel['prenom']?> - <?=$personnel['role_name']?> - <?=$personnel['email']?> - <?=$personnel['telephone']?>  - 
            <?= isset($personnel['evaluation']) ? htmlspecialchars($personnel['evaluation']) : 'No evaluation' ?>
        </p>
    </a>
<?php endforeach;?>


</div>