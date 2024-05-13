<?php include_once("includes/templates/header.php") ?>



<div id="wrapper">
    <?php include("includes/templates/navigation.php") ?>
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Menu
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa-solid fa-menorah"></i> Menu
                        </li>
                    </ol>



                    <?php
                    if (isset($_GET['source'])) {
                        $source = $_GET['source'];
                    } else {
                        $source = '';
                    }
                    switch ($source) {
                        case 'add_menu_item':
                            include './includes/templates/menu/add_menu_item.php';
                            break;
                        case 'edit_menu_item':
                            include './includes/templates/menu/edit_menu_item.php';
                            break;
                        default:
                            include './includes/templates/menu/view_all_menu.php';
                            break;
                    }
                    ?>
                </div>
            </div>

        </div>

    </div>

</div>

<?php include_once("includes/templates/footer.php") ?>