<?php include_once("includes/templates/header.php") ?>
<div id="wrapper">
    <?php include("includes/templates/navigation.php") ?>
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Messages
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                        </li>
                        <li class="active">
                            <i class="fa-solid fa-message"></i> Messages
                        </li>
                    </ol>
                    <?php
                    include './includes/templates/message/view_all_messages.php';
                    ?>
                </div>
            </div>

        </div>

    </div>

</div>

<?php include_once("includes/templates/footer.php") ?>