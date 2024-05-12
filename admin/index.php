<?php include_once("includes/templates/header.php") ?>



<div id="wrapper">
    <?php include("includes/templates/navigation.php") ?>

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Dashboard
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> <a href="index.html">Dashboard</a>
                        </li>

                    </ol>
                </div>
            </div>
            <?php include("includes/templates/dashboard_widget.php") ?>
        </div>
    </div>
</div>
<?php include_once("includes/templates/footer.php") ?>