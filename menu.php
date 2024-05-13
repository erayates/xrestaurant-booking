<?php include_once("./includes/templates/header.php") ?>
<section class="page-hero">
    <div class="d-flex container flex-column justify-content-center align-items-center">
        <h2 class="h1 font-weight-bold">Menu</h2>
    </div>
</section>

<section class="section--space">
    <div class="container row mx-auto">
        <div class="" style="width: fit-content;">
            <h2 class="h1 font-weight-bold">Our Menu</h2>
            <p class="font-italic h6">Our unique dishes prepared carefully by our chefs</p>
            <div class="bg-warning rounded" style="height: 6px;"></div>
        </div>
</section>

<section id="menu" class="menu section-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 d-flex justify-content-center">
                <ul id="menu-flters">
                    <li data-filter="*" class="filter-active">All</li>
                    <li data-filter=".filter-starters">Starters</li>
                    <li data-filter=".filter-salads">Salads</li>
                    <li data-filter=".filter-specialty">Specialty</li>
                </ul>
            </div>
        </div>

        <div class="row menu-container" data-aos="fade-up" data-aos-delay="200">

            <div class="col-lg-6 menu-item filter-starters">
                <img src="assets/img/menu/lobster-bisque.jpg" class="menu-img" alt="">
                <div class="menu-content">
                    <a href="#">Lobster Bisque</a><span>$5.95</span>
                </div>
                <div class="menu-ingredients">
                    Lorem, deren, trataro, filede, nerada
                </div>
            </div>

            <div class="col-lg-6 menu-item filter-specialty">
                <img src="assets/img/menu/bread-barrel.jpg" class="menu-img" alt="">
                <div class="menu-content">
                    <a href="#">Bread Barrel</a><span>$6.95</span>
                </div>
                <div class="menu-ingredients">
                    Lorem, deren, trataro, filede, nerada
                </div>
            </div>

            <div class="col-lg-6 menu-item filter-starters">
                <img src="assets/img/menu/cake.jpg" class="menu-img" alt="">
                <div class="menu-content">
                    <a href="#">Crab Cake</a><span>$7.95</span>
                </div>
                <div class="menu-ingredients">
                    A delicate crab cake served on a toasted roll with lettuce and tartar sauce
                </div>
            </div>

            <div class="col-lg-6 menu-item filter-salads">
                <img src="assets/img/menu/caesar.jpg" class="menu-img" alt="">
                <div class="menu-content">
                    <a href="#">Caesar Selections</a><span>$8.95</span>
                </div>
                <div class="menu-ingredients">
                    Lorem, deren, trataro, filede, nerada
                </div>
            </div>

            <div class="col-lg-6 menu-item filter-specialty">
                <img src="assets/img/menu/tuscan-grilled.jpg" class="menu-img" alt="">
                <div class="menu-content">
                    <a href="#">Tuscan Grilled</a><span>$9.95</span>
                </div>
                <div class="menu-ingredients">
                    Grilled chicken with provolone, artichoke hearts, and roasted red pesto
                </div>
            </div>

            <div class="col-lg-6 menu-item filter-starters">
                <img src="assets/img/menu/mozzarella.jpg" class="menu-img" alt="">
                <div class="menu-content">
                    <a href="#">Mozzarella Stick</a><span>$4.95</span>
                </div>
                <div class="menu-ingredients">
                    Lorem, deren, trataro, filede, nerada
                </div>
            </div>

            <div class="col-lg-6 menu-item filter-salads">
                <img src="assets/img/menu/greek-salad.jpg" class="menu-img" alt="">
                <div class="menu-content">
                    <a href="#">Greek Salad</a><span>$9.95</span>
                </div>
                <div class="menu-ingredients">
                    Fresh spinach, crisp romaine, tomatoes, and Greek olives
                </div>
            </div>

            <div class="col-lg-6 menu-item filter-salads">
                <img src="assets/img/menu/spinach-salad.jpg" class="menu-img" alt="">
                <div class="menu-content">
                    <a href="#">Spinach Salad</a><span>$9.95</span>
                </div>
                <div class="menu-ingredients">
                    Fresh spinach with mushrooms, hard boiled egg, and warm bacon vinaigrette
                </div>
            </div>

            <div class="col-lg-6 menu-item filter-specialty">
                <img src="assets/img/menu/lobster-roll.jpg" class="menu-img" alt="">
                <div class="menu-content">
                    <a href="#">Lobster Roll</a><span>$12.95</span>
                </div>
                <div class="menu-ingredients">
                    Plump lobster meat, mayo and crisp lettuce on a toasted bulky roll
                </div>
            </div>

        </div>

    </div>
</section>

<?php include_once("./includes/templates/footer.php") ?>