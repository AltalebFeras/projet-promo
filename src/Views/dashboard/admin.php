<?php   ?>





<p class="para">page admin</p>

<nav class="d-flex">
   <img class="logo-admin" src="<?= Domain . HOME_URL . 'assets/image/Logo.png'?>" alt="logotype de l'entreprise représentant un tramway et un bus en mouvement"/>
   <a class="btn round-pill" href="<?= Domain . HOME_URL  ?>dashboard/ajouter_personnel">Ajouter personnel</a>
    <div class="tri d-flex ">
        <p>Trier par type: </p>
        <select class="form-select" aria-label="Default select example">
            <option selected>Choisir ici</option>
            <option value="1">Administrateur</option>
            <option value="2">Conducteur</option>
            
            <option value="3">Mécanicien</option> 
        </select>
    </div>
</nav>





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