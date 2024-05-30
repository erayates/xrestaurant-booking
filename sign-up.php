<?php include_once("./includes/templates/header.php") ?>

<?php
if (isset($_GET['success'])) {
    echo "
    <div class='alert alert-success alert-dismissible fade show text-center' role='alert'>
    <strong>SUCCESS!</strong> You have registered successfully!
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
  </div>";
}
?>

<?php
if (isset($_SESSION['email'])) {
    header("Location: index.php");
}
?>


<section class="p-3 p-md-4 p-xl-5 section--space ">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 ">


                <div class="d-flex flex-column justify-content-between h-100 p-3 p-md-4 ">
                    <h3 class="m-0">Welcome!</h3>
                    <img class="img-fluid rounded mx-auto my-4 h-100 w-100" loading="lazy" src="assets/images/restaurant-hero-bg.jpg" style="object-fit: cover;">
                </div>
            </div>
            <div class="col-12 col-md-6 ">
                <div class="p-3 p-md-4 ">
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-5">
                                <h2 class="h3">Registration</h2>
                                <h3 class="text-secondary m-0">Enter your details to register</h3>
                            </div>
                            <?php
                            if (isset($_GET['userExists'])) {
                                echo "<span class='text-danger mb-4'>Email already in used.</span>";
                            }
                            ?>
                        </div>
                    </div>
                    <form action="functions.php" method="POST">
                        <div class="row overflow-hidden ">
                            <div class="col-12 mb-4">
                                <label for="firstName" class="form-label">First Name: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="firstName" id="firstName" placeholder="First Name" required>
                            </div>
                            <div class="col-12 mb-4">
                                <label for="lastName" class="form-label">Last Name: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Last Name" required>
                            </div>
                            <div class="col-12 mb-4">
                                <label for="email" class="form-label">Email: <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" required>
                            </div>

                            <div class="col-12 mb-4">
                                <label for="phone" class="form-label">Phone: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="phone" id="phone" pattern="[0][0-9]{10}" placeholder="05XXXXXXXXX" required>
                            </div>

                            <div class="col-12 mb-4">
                                <label for="password" class="form-label">Password: <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="password" id="password" value="" required>
                            </div>
                            <div class="col-12 mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" name="iAgree" id="iAgree" required>
                                    <label class="form-check-label text-secondary" for="iAgree">
                                        I agree to the <a href="#!" class="link-primary text-decoration-none">terms and conditions</a>
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-grid">
                                    <button class="btn btn-primary" name="register" type="submit">Sign up</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-12">
                            <hr class="mt-5 mb-4 border-secondary-subtle">
                            <p class="m-0 text-secondary text-end">Already have an account? <a href="sign-in.php" class="link-primary text-decoration-none">Sign in</a></p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<?php include_once("./includes/templates/footer.php") ?>