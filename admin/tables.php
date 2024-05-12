<?php include_once("includes/templates/header.php") ?>



<div id="wrapper">
    <?php include("includes/templates/navigation.php") ?>
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Tables
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa-solid fa-chair"></i> Tables
                        </li>
                    </ol>
                    
                    <?php
                    if (isset($_GET['deleteSuccess'])) { ?>
                        <div class="alert alert-danger col-xs-12" role="alert">
                            <strong>SUCCESSFULL!</strong> You have deleted a table successfully.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true" style="color:red;">&times;</span>
                            </button>
                        </div>
                    <?php }
                    ?>

                    <?php
                    if (isset($_GET['updateSuccess'])) { ?>
                        <div class="alert alert-danger col-xs-12" role="alert">
                            <strong>SUCCESSFULL!</strong> You have updated a table successfully.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true" style="color:red;">&times;</span>
                            </button>
                        </div>
                    <?php }
                    ?>


                    <?php
                    if (isset($_GET['addSuccess'])) { ?>
                        <div class="alert alert-danger col-xs-12" role="alert">
                            <strong>SUCCESSFULL!</strong> You have added a new table successfully.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true" style="color:red;">&times;</span>
                            </button>
                        </div>
                    <?php }
                    ?>

                    <div class="col-12 row " style="margin-bottom: 4rem;">
                        <div class="col-xs-12 col-lg-6">
                            <img src="assets/images//floorplan.png" alt="XRESTO Floor Plan" width="100%" />

                        </div>

                        <div class="col-xs-12 col-lg-6">
                            <p class="h2"><strong>NOTE!</strong> This restaurant plan has been prepared up to date. This plan will not update with any changes you make. Please update the restaurant plan whenever you add or remove a new table.</p>
                        </div>
                    </div>

                    <?php
                    if (isset($_GET['source'])) {
                        $source = $_GET['source'];
                    } else {
                        $source = '';
                    }
                    switch ($source) {
                        case 'add_table':
                            include './includes/templates/table/add_table.php';
                            break;
                        case 'edit_table':
                            include './includes/templates/table/edit_table.php';
                            break;
                        default:
                            include './includes/templates/table/view_all_tables.php';
                            break;
                    }
                    ?>
                </div>
            </div>

        </div>

    </div>

</div>

<?php include_once("includes/templates/footer.php") ?>