<?php   ?>





<p class="para">page admin</p>

<nav class="d-flex">
   <img class="logo-admin" src="<?= Domain . HOME_URL . 'assets/image/Logo.png'?>" alt="logotype de l'entreprise représentant un tramway et un bus en mouvement"/>
    

</nav>



<a href="<?= Domain . HOME_URL  ?>dashboard/ajouter_personnel">Ajouter_personnel</a>

<div>



<?php foreach ($personnelsWithRolesAndStatus as $personnel) :?>
    <a href="<?= Domain . HOME_URL . 'dashboard/personnel_detaille?Id_personnel=' . $personnel['Id_personnel'] ?>">
        <p>
            <?=$personnel['nom']?> - <?=$personnel['prenom']?> - <?=$personnel['role_name']?> - <?=$personnel['email']?> - <?=$personnel['telephone']?> - <?=$personnel['statut_personnels']?> - 
            <?= isset($personnel['evaluation']) ? htmlspecialchars($personnel['evaluation']) : 'No evaluation' ?>
        </p>
    </a>
<?php endforeach;?>


</div>