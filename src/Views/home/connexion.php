  <?php include_once __DIR__ . '/../includes/header.php'; ?>

  <div class="container-fluid">
    <div class="d-flex flex-column justify-content-between sidebar align-items-center p-3">
    </div>
    <div class="main">


      <div id="containerSignIn" class="">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-lg-12 col-xl-11">
            <div class="card text-black">
              <div class="card-body ">
                <div class="row justify-content-center">
                  <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">


                    <!-- div for messages -->
                    <div class="my-3 successAndErrorMessage"></div>

                    <p class="title text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign in</p>
                    <form action="<?= Domain . HOME_URL . 'signIn' ?>" method="POST" id="formConnection" class="mx-1 mx-md-4">
                      <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <div data-mdb-input-init class="form-outline d-flex align-items-center gap-2 flex-fill mb-0">
                          <input type="email" id="emailSignIn" name="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter your email" required autocomplete="email">
                        </div>
                      </div>
                      <div class="d-flex flex-row align-items-center mb-4">
                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                        <div data-mdb-input-init class="form-outline d-flex align-items-center gap-2 flex-fill mb-0">
                          <input type="password" id="passwordSignIn" name="password" class="form-control" required placeholder="Enter your password">
                        </div>
                      </div>
                    
                      <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                        <button id="submissionButtonSignIn" type="submit" class="btn btn-primary btn-lg">Sign in</button>
                      </div>
                    </form>
                   
                  </div>
              
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
  <?php include_once __DIR__ . '/../includes/footer.php'; ?>