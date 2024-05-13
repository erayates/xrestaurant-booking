<?php include_once("./includes/templates/header.php") ?>
<section class="page-hero">
    <div class="d-flex container flex-column justify-content-center align-items-center">
        <h2 class="h1 font-weight-bold">Menu</h2>
    </div>
</section>

<section class="section--space">
    <section class="">
        <div class="container row mx-auto">
            <div class="" style="width: fit-content;">
                <h2 class="h1 font-weight-bold">Our Menu</h2>
                <p class="font-italic h6">Our unique dishes prepared carefully by our chefs</p>
                <div class="bg-warning rounded" style="height: 6px;"></div>
            </div>
    </section>

    <section id="menu" class="menu section-bg mt-5">
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

            <div class="row menu-container">
                <?php
                $query = "SELECT * FROM menu";
                $get_menu_starters = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($get_menu_starters)) {
                    $item_name = htmlspecialchars($row['name']);
                    $item_description = htmlspecialchars($row['description']);
                    $item_price = htmlspecialchars($row['price']);
                    $item_image = htmlspecialchars($row['image']);
                    $item_category = htmlspecialchars($row["category"])
                ?>
                    <div class="col-lg-6 menu-item filter-<?php echo $item_category ?>">
                        <img src="assets/images/menu/<?php echo $item_image ?>" class="menu-img" alt="">
                        <div class="menu-content">
                            <a href="#"><?php echo $item_name ?></a><span><?php echo $item_price ?></span>
                        </div>
                        <div class="menu-ingredients">
                            <?php echo $item_description ?>
                        </div>
                    </div>
                <?php }
                ?>
            </div>
        </div>
    </section>
</section>

<?php include_once("./includes/templates/footer.php") ?>