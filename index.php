<?php include_once("./includes/templates/header.php") ?>

<?php
if (isset($_GET['loginSuccess'])) {
    echo "
    <div class='alert alert-success alert-dismissible fade show text-center' role='alert'>
    <strong>SUCCESS!</strong> You have logged in successfully!
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
  </div>";
}
?>

<?php
if (isset($_GET['logoutSuccess'])) {
    echo "
    <div class='alert alert-success alert-dismissible fade show text-center' role='alert'>
    You have logged out!
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
  </div>";
}
?>

<?php
if (isset($_GET['permissionDenied'])) {
    echo "
    <div class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
    <strong>You don't have permission to show that page!</strong>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
    </button>
  </div>";
}
?>

<section class="hero px-3" style="background-image: url('assets/images/restaurant-hero-bg.jpg');">
    <div class="container h-100">
        <div class="row h-100 justify-content-md-center align-items-md-center">
            <div class="col-12 col-md-11 col-lg-9 col-xl-7 col-xxl-6 d-flex flex-column justify-content-center text-center text-white ">
                <h1 class="display-3 font-weight-bold text-uppercase mb-3">XRESTO</h1>
                <p class="lead mb-5 font-italic">We are sure you have never tasted these flavors anywhere before! Make a reservation now and taste these unique flavors!</p>
                <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                    <button type="button" class="btn btn-light py-2 px-4 font-weight-bold text-uppercase">Get A Reservation <i class="bi bi-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="w-100 text-center mt-n3">
        <a href="#our-favorite-dishes" class="w-100 text-center h1 text-white bg-warning rounded-circle px-3 py-2"><i class="bi bi-arrow-down"></i></a>
    </div>
</section>


<section id="our-favorite-dishes" class="container section--space">
    <div class="" style="width: fit-content;">
        <h2 class="h1 font-weight-bold">Our Favorite Dishes</h2>
        <p class="font-italic h6">These are our dishes that are most liked by our customers and whose taste they cannot give up.</p>
        <div class="bg-warning rounded" style="height: 6px;"></div>
    </div>
    <div class="mt-4 row">
        <div class="col-12 col-md-6 col-lg-3 w-100">
            <div class="card">
                <img class="card-img-top" src="assets/images/restaurant-hero-bg.jpg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card">
                <img class="card-img-top" src="assets/images/restaurant-hero-bg.jpg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <div class="card">
                <img class="card-img-top" src="assets/images/restaurant-hero-bg.jpg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <div class="card">
                <img class="card-img-top" src="assets/images/restaurant-hero-bg.jpg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        </div>

    </div>

</section>

<section id="testimonial" class="mt-5" style="background-color: #1c2331;">
    <div class="container py-5">
        <div class="text-white d-flex align-items-end flex-column w-100 text-right">
            <div style=" width: fit-content;">
                <h2 class="h1 font-weight-bold">Reviews From Our Customers</h2>
                <p class="font-italic h6">Opinions of our customers who tried our unique flavors</p>
                <div class="bg-warning rounded" style="height: 6px;"></div>
            </div>
        </div>
        <div id="testimonialCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner text-white">
                <div class="carousel-item active">
                    <p class="testimonial--text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Facilis veniam dolore placeat reiciendis aspernatur natus, excepturi laudantium quam corrupti quis totam eum earum. Fugit, rem quod distinctio unde ea perspiciatis odit eos tenetur, expedita, sit voluptas eveniet nobis. Nesciunt, minus.</p>
                    <div class="d-flex flex-column align-items-center">
                        <img class="testimonial--avatar" src="assets/images/avatars/avatar-1.jpg" alt="Adam+John" />
                        <p>Adam John</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <p class="testimonial--text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nisi saepe impedit consectetur totam sed velit. Facilis, veritatis expedita omnis asperiores laborum modi exercitationem ipsa quia tempora odit rem provident sunt!</p>
                    <div class="d-flex flex-column align-items-center">
                        <img class="testimonial--avatar" src="assets/images/avatars/avatar-2.jpg" alt="Adam+John" />
                        <p>John Doe</p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#testimonialCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#testimonialCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

</section>

<section id="our-favorite-dishes" class="container section--space">
    <div class="" style="width: fit-content;">
        <h2 class="h1 font-weight-bold">Photos From Our Restaurant</h2>
        <p class="font-italic h6">Indoor and outdoor photos of our stylish and elegant restaurant</p>
        <div class="bg-warning rounded" style="height: 6px;"></div>
    </div>
    
    <div class="row mt-5">
        <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
            <img src="assets/images/restaurant-indoor.jpeg" class="w-100 shadow-1-strong rounded mb-4" alt="Boat on Calm Water" />
            <img src="assets/images/restaurant-hero-bg.jpg" class="w-100 shadow-1-strong rounded mb-4" alt="Wintry Mountain Landscape" />
        </div>

        <div class="col-lg-4 mb-4 mb-lg-0">
            <img src="assets/images/restaurant-outdoor.jpg" class="w-100 shadow-1-strong rounded mb-4" alt="Mountains in the Clouds" />
            <img src="assets/images/restaurant-outdoor-2.jpg" class="w-100 shadow-1-strong rounded mb-4" alt="Boat on Calm Water" />
        </div>

        <div class="col-lg-4 mb-4 mb-lg-0">
            <img src="assets/images/restaurant-outdoor-3.jpg" class="w-100 shadow-1-strong rounded mb-4" alt="Waves at Sea" />
            <img src="assets/images/restaurant-indoor.jpeg" class="w-100 shadow-1-strong rounded mb-4" alt="Yosemite National Park" />
        </div>
    </div>

</section>

<?php include("./includes/templates/cta.php") ?>

</section>
<?php include_once("./includes/templates/footer.php") ?>