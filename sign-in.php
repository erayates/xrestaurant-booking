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
if (isset($_GET['unauthorized'])) {
    echo "
    <div class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
    <strong>You don't have permission to show that page. Please login!</strong>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
  </div>";
}
?>

<?php
if (isset($_SESSION['user_email'])) {
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
                                <h2 class="h3">Login</h2>
                                <h3 class="text-secondary m-0">Enter your details to login</h3>
                            </div>
                        </div>
                    </div>
                    <form action="functions.php" method="POST">
                        <div class="row overflow-hidden ">
                            <div class="col-12 mb-4">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" required>
                            </div>

                            <div class="col-12 mb-4">
                                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="password" id="password" value="" required>
                            </div>

                            <div class="col-12">
                                <div class="d-grid">
                                    <button class="btn btn-primary" name="login" type="submit">Login</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-12">
                            <hr class="mt-5 mb-4 border-secondary-subtle">
                            <p class="m-0 text-secondary text-end">Dont you have an account? <a href="sign-up.php" class="link-primary text-decoration-none">Sign Up</a></p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<?php include_once("./includes/templates/footer.php") ?>