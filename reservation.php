<?php include_once("./includes/templates/header.php") ?>

<?php
if (!isset($_SESSION['user_email'])) {
    header("Location: sign-in.php?unauthorized");
    exit();
}
?>

<section class="page-hero">
    <div class="d-flex container flex-column justify-content-center align-items-center">
        <h2 class="h1 font-weight-bold">Reservation</h2>
    </div>
</section>

<section class="section--space">
    <div class="container row mx-auto">
        <?php
        if (isset($_GET['reservationSuccess'])) {
            echo "
                <div class='alert alert-success alert-dismissible fade show text-center col-12' role='alert'>
                    <strong>SUCCESS!</strong> You have booked a table successfully!
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button>
            </div>";
        }
        ?>
        <div class="col-12 col-lg-6 ">
            <div>
                <h3 class="h3 font-weight-bold">Tables</h3>
                <p>You can see all our tables in the photo below.</p>
                <div class="w-100">
                    <img src="assets/images/floorplan.png" class="w-100" alt="Table Floor Plan" />
                </div>
            </div>

            <div class="mt-5">
                <h3 class="h3 font-weight-bold">Reservation Form</h3>
                <p>Please fill the form correctly.</p>
                <form action="functions.php" method="POST">
                    <div class="row overflow-hidden ">
                        <div class="col-12 mb-4">
                            <label for="role">Select A Table: <span class="text-danger">*</span></label>
                            <select name="table" id="table" required>
                                <?php
                                $query = "SELECT * FROM tables";
                                $get_all_tables = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_assoc($get_all_tables)) {
                                    $table_id = htmlspecialchars($row['table_id']);
                                    $name = htmlspecialchars($row['name']);
                                    $status = htmlspecialchars($row['status']);
                                ?>
                                    <option value="<?php echo $table_id ?>" <?php if ($status === "full") echo "disabled" ?>><?php echo $name ?></option>
                                <?php } ?>

                            </select>
                        </div>

                        <div class="col-12">
                            <label for="role">Pick # of Guests: <span class="text-danger">*</span></label>
                            <input type="radio" name="num_guests" value=1 required /> 1
                            <input type="radio" name="num_guests" value=2 /> 2
                            <input type="radio" name="num_guests" value=3 /> 3
                            <input type="radio" name="num_guests" value=4 /> 4
                            <input type="radio" name="num_guests" value=5 /> 5
                            <input type="radio" name="num_guests" value=6 /> 6
                            <input type="radio" name="num_guests" value=7 /> 7
                            <input type="radio" name="num_guests" value=8 /> 8
                        </div>
                        <div class="col-12  mb-4">
                            <small class="text-danger">Please dont do unappropriate selection. Before send the form please check the Status of Table. Otherwise your reservation will be rejected.</small>
                        </div>

                        <div class="col-12 mb-4">
                            <label for="reservation_date" class="form-label">Pick A Date: <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="reservation_date" id="reservation_date" value="" on required />
                        </div>

                        <div class="col-12 mb-4">
                            <label for="reservation_time" class="form-label">Pick A Time: <span class="text-danger">*</span></label>
                            <input type="time" class="form-control" name="reservation_time" id="reservation_time" value="" min="10:00" required />
                        </div>

                        <div class="col-12 mb-4">
                            <label for="message" class="form-label">Enter Your Message: <span class="text-danger">*</span></label>
                            <textarea name="message" rows="5" style="resize: none;" class="form-control" id="message" required></textarea>
                        </div>

                        <div class="col-12 mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" name="iAgree" id="iAgree" required>
                                <label class="form-check-label text-secondary" for="iAgree">
                                    I know and accept my obligations when I cancel my reservation.
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-grid">
                                <button class="btn btn-primary" name="reservation" type="submit">Book A Table</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <h3 class="h3 font-weight-bold">Status of Tables</h3>
            <div style="overflow-x: auto;">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Capacity</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $query = "SELECT * FROM tables";
                        $get_all_tables = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($get_all_tables)) {
                            $name = htmlspecialchars($row['name']);
                            $description = htmlspecialchars($row['description']);
                            $capacity = htmlspecialchars($row['capacity']);
                            $status = htmlspecialchars($row['status']);
                        ?>


                            <tr>
                                <td><?php echo $name ?></td>
                                <td><?php echo $description ?></td>
                                <td><?php echo $capacity ?></td>
                                <td><?php if ($status === "empty") { ?>
                                        <span class='badge' style="background-color: blue; color: #fff">Empty</span>
                                    <?php } elseif ($status === "full") { ?>
                                        <span class='badge' style="background-color: red; color: #fff">Full</span>
                                    <?php }
                                    ?>
                                </td>
                            </tr>
                        <?php }
                        ?>

                    </tbody>

                </table>
            </div>

        </div>
    </div>
</section>


<?php include_once("./includes/templates/footer.php") ?>