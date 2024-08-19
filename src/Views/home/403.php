    <?php include_once __DIR__ . '/../includes/header.php'; ?>

    <div class="container-fluid">
        <div class="d-flex flex-column justify-content-between sidebar align-items-center p-3">
            <?php include_once __DIR__ . '/../includes/sidebar.php'; ?>
        </div>
        <div class="main">

            <div id="container403" class="">

                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-lg-12 col-xl-11">
                        <div class="card text-black" style="border-radius: 25px;">
                            <div class="card-body p-md-5">
                                <div class="row justify-content-center">
                                    <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                                        <div class="my-3">
                                            <!-- div for messages -->
                                            <div class="my-3 successAndErrorMessage"></div>
                                            <!-- Input field for URL -->
                                            <input type="hidden" class="urlPage" value="<?= htmlspecialchars(HOME_URL . 'dashboard') ?>" />
                                            <p class="error-title">403 Forbidden</p>
                                            <p class="error-message">Access to this page is restricted.</p>
                                            <p class="error-message">We knew you are not admin.</p>
                                            <p class="error-message">Please connect from admin device!</p>
                                            <a href="<?= HOME_URL ?>" class="back-link">Back to Home</a>
                                        </div>
                                    </div>
                                    <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp" class="img-fluid" alt="Sample image">
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