<?php include_once("includes/templates/header.php") ?>

<div id="wrapper">
    <?php include("includes/templates/navigation.php") ?>
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Clients
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa-solid fa-user"></i> Clients
                        </li>
                    </ol>
                    <?php
                    if (isset($_GET['source'])) {
                        $source = $_GET['source'];
                    } else {
                        $source = '';
                    }
                    switch ($source) {
                        case 'add_client':
                            include './includes/templates/client/add_client.php';
                            break;
                        case 'edit_client':
                            include './includes/templates/client/edit_client.php';
                            break;
                        default:
                            include './includes/templates/client/view_all_clients.php';
                            break;
                    }
                    ?>
                </div>
            </div>

        </div>

    </div>

</div>

<?php include_once("includes/templates/footer.php") ?>