<?php include_once("includes/templates/header.php") ?>



<div id="wrapper">
    <?php include("includes/templates/navigation.php") ?>
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Reservations
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa-solid fa-eye"></i> Reservations
                        </li>
                    </ol>

                    <?php
                    if (isset($_GET['deleteSuccess'])) { ?>
                        <div class="alert alert-danger col-xs-12" role="alert">
                            <strong>SUCCESSFULL!</strong> You have deleted a reservation successfully.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true" style="color:red;">&times;</span>
                            </button>
                        </div>
                    <?php }
                    ?>

                    <?php
                    if (isset($_GET['updateSuccess'])) { ?>
                        <div class="alert alert-danger col-xs-12" role="alert">
                            <strong>SUCCESSFULL!</strong> You have updated a reservation successfully.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true" style="color:red;">&times;</span>
                            </button>
                        </div>
                    <?php }
                    ?>


                    <?php
                    if (isset($_GET['addSuccess'])) { ?>
                        <div class="alert alert-danger col-xs-12" role="alert">
                            <strong>SUCCESSFULL!</strong> You have added a new reservation successfully.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true" style="color:red;">&times;</span>
                            </button>
                        </div>
                    <?php }
                    ?>

                    <?php
                    if (isset($_GET['source'])) {
                        $source = $_GET['source'];
                    } else {
                        $source = '';
                    }
                    switch ($source) {
                        case 'add_reservation':
                            include './includes/templates/reservation/add_reservation.php';
                            break;
                        case 'edit_reservation':
                            include './includes/templates/reservation/edit_reservation.php';
                            break;
                        default:
                            include './includes/templates/reservation/view_all_reservations.php';
                            break;
                    }
                    ?>
                </div>
            </div>

        </div>

    </div>

</div>

<?php include_once("includes/templates/footer.php") ?>