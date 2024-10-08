<div class="container">
    <div class="row nav-mobile align-items-center mb-4">
        <div class="col-lg-3 col-md-6 mobile-center nav-ipad">
            <img class="logo-admin" src="<?= Domain . HOME_URL . 'assets/image/logo.png'; ?>" alt="Logo de l'entreprise" />
        </div>

        <div class="col-lg-3 col-md-6 mobile-center">
            <a class="btn rounded-pill" href="<?= Domain . HOME_URL ?>dashboard/ajouter_personnel">Ajouter Personnel</a>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="d-flex gap-1 mob-center">
                <p class="mb-0">Trier par type:</p>
                <select class="form-select w-auto p-0">
                    <option selected class="bg">Choisir ici</option>
                    <option value="1">Administrateur</option>
                    <option value="2">Conducteur</option>
                    <option value="3">Mécanicien</option>
                </select>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="d-flex gap-1 mob-center">
                <p class="mb-0">Trier par type:</p>
                <select class="form-select w-auto p-0">
                    <option selected>Choisir ici</option>
                    <option value="1">Administrateur</option>
                    <option value="2">Conducteur</option>
                    <option value="3">Mécanicien</option>
                </select>
            </div>
        </div>
    </div>

    <div class="alert-container">
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger"><?php echo $_GET['error']; ?></div>
        <?php endif; ?>
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success"><?php echo $_GET['success']; ?></div>
        <?php endif; ?>
    </div>


    <!-- Section for all personnel including the logged-in user -->
    <div class="row">
        <!-- Display the card for the logged-in user first -->
        <?php foreach ($allPersonnelsWithStatus as $personnel) : ?>
            <?php if ($_SESSION['Id_personnel'] == $personnel['Id_personnel']) : ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card">
                        <div class="p-5 card-body">
                            <h5 class="card-title text-info">Mon Compte: <?= $personnel['nom'] . ' ' . $personnel['prenom'] ?></h5>
                            <p class="card-text"><strong>Rôle:</strong> <?= $personnel['role_name'] ?></p>
                            <p class="card-text"><strong>Email:</strong> <?= $personnel['email'] ?></p>
                            <p class="card-text"><strong>Téléphone:</strong> <?= $personnel['telephone'] ?></p>
                            <p><strong>Statut du personnel:</strong> <?= $personnel['status_name'] ?></p>

                            <div class="eval p-4 my-4">
                                <p class="card-text"><strong>Dernière évaluation:</strong> <br><?= isset($personnel['last_evaluation']) ? $personnel['last_evaluation'] : 'Aucune évaluation' ?></p>
                            </div>
                            <a href="<?= Domain . HOME_URL . 'dashboard/personnel_detaille?Id_personnel=' . $personnel['Id_personnel'] ?>" class="btn rounded-pill">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>

        <!-- Display the cards for all other personnel -->
        <?php foreach ($allPersonnelsWithStatus as $personnel) : ?>
            <?php if ($_SESSION['Id_personnel'] != $personnel['Id_personnel']) : ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card">
                        <div class="p-5 card-body">
                            <h5 class="card-title"><?= $personnel['nom'] . ' ' . $personnel['prenom'] ?></h5>
                            <p class="card-text"><strong>Rôle:</strong> <?= $personnel['role_name'] ?></p>
                            <p class="card-text"><strong>Email:</strong> <?= $personnel['email'] ?></p>
                            <p class="card-text"><strong>Téléphone:</strong> <?= $personnel['telephone'] ?></p>
                            <p><strong>Statut du personnel:</strong> <?= $personnel['status_name'] ?></p>

                            <div class="eval p-4 my-4">
                                <p class="card-text"><strong>Dernière évaluation:</strong><br>
                                    <?php if (!empty($personnel['evaluations'])): ?>
                                        <?php
                                        // Extract the evaluation date and format it
                                        $evaluationDate = new DateTime($personnel['evaluations'][0]['dtc']);
                                        $formattedDate = $evaluationDate->format('d M. Y H:i');
                                        ?>
                                        <span><?= $personnel['evaluations'][0]['texte'] ?></span><br>
                                        <small class="text-muted"><?= $formattedDate ?></small>
                                    <?php else: ?>
                                        <span>Aucune évaluation</span>
                                    <?php endif; ?>
                                </p>
                            </div>


                            <a href="<?= Domain . HOME_URL . 'dashboard/personnel_detaille?Id_personnel=' . $personnel['Id_personnel'] ?>" class="btn rounded-pill">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

</div>