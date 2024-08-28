  <?php include_once __DIR__ . '/../includes/header.php'; ?>

  <div class="container">

    <!-- div for messages -->
    <div class="my-3 successAndErrorMessage">

      <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger"><?php echo $_GET['error']; ?></div>
      <?php endif; ?>
      <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success"><?php echo $_GET['success']; ?></div>
      <?php endif; ?>
    </div>


    <div class="d-flex  flex-column justify-content-center align-items-center gap-4">
      <img class="logo-connexion" src="<?= Domain . HOME_URL . 'assets/image/logo.png'; ?>" alt="logo" />


      <form action="<?= Domain . HOME_URL  ?>" method="POST" id="formConnexion" class="form-connexion">

        <input type="email" id="emailSignIn" name="email" class="mb-3 form-control email-connexion" aria-describedby="emailHelp" placeholder="Enter your email" required autocomplete="email" />

        <input type="password" id="mdp" name="mdp" class="mb-3 form-control mdp-connexion" required placeholder="Enter your password" />

        <div class="btn-connexion d-flex flex-column justify-content-center">
          <button id="submissionButtonSignIn" type="submit" class="btn rounded-pill">Connexion</button>
        </div>
      </form>
    </div>
  </div>
  <?php include_once __DIR__ . '/../includes/footer.php'; ?>