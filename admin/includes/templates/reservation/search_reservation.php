<div class="col-xs-12" style="overflow-x: auto;">
    <h3 class="h3">Search Reservation</h3>

    <form action="" method="post">
        <div class="form-group">
            <label for="client">Select A Client: <span class="text-danger">*</span></label>
            <select name="client" id="client" required>
                <?php
                $query = "SELECT * FROM clients";
                $get_all_tables = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($get_all_tables)) {
                    $client_id = htmlspecialchars($row['client_id']);
                    $firstname = htmlspecialchars($row['firstName']);
                    $lastname = htmlspecialchars($row['lastName']);
                ?>
                    <option value="<?php echo $client_id ?>"><?php echo $firstname . " " . $lastname ?></option>
                <?php } ?>

            </select>
        </div>
        <div class="form-group">
            <label for=" start_date">Start Date: <span class="text-danger">*</span></label>
            <input type="date" class="form-control" id="start_date" name="start_date" />
        </div>
        <div class="form-group">
            <label for="End Date:">End Date: <span class="text-danger">*</span></label>
            <input type="date" class="form-control" id="End Date:" name="end_date" />
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary" name="search_reservation">Search</button>
        </div>
    </form>


    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Client Name</th>
                <th scope="col">Table Name</th>
                <th scope="col"># of Guests</th>
                <th scope="col">Message</th>
                <th scope="col">Status</th>
                <th scope="col">Date</th>
                <th scope="col">Time</th>
                <th scope="col"></th>
            </tr>
        </thead>

        <tbody>
            <?php
            if (isset($_POST['search_reservation'])) {
                $client = escape($_POST['client']);
                $start_date = escape($_POST['start_date']);
                $end_date = escape($_POST['end_date']);

                $query = "CALL GetClientReservations('$client', '$start_date', '$end_date')";
                $get_reservations = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($get_reservations)) {
                    $table_name = htmlspecialchars($row['table_name']);
                    $client_id = htmlspecialchars($row['client_name']);
                    $reservation_id = htmlspecialchars($row['reservation_id']);
                    $num_guests =  htmlspecialchars($row['num_guests']);
                    $message = htmlspecialchars($row['message']);
                    $status = htmlspecialchars($row['status']);
                    $date = htmlspecialchars($row['date']);
                    $time = htmlspecialchars($row['time']);
                }
            ?>
                <tr>
                    <th scope="row"><?php echo $reservation_id ?></th>
                    <td><?php echo $client_id ?></td>
                    <td><?php echo $table_name   ?></td>
                    <td><?php echo $num_guests ?></td>
                    <td><?php echo $message ?></td>
                    <td><?php if ($status === "pending") { ?>
                            <span class='badge' style="background-color: blue;">Pending</span>
                        <?php } elseif ($status === "approved") { ?>
                            <span class='badge' style="background-color: green;">Approved</span>
                        <?php } elseif ($status === "denied") { ?>
                            <span class='badge' style="background-color: red;">Denied</span>
                        <?php }
                        ?>
                    </td>
                    <td><?php echo $date ?></td>
                    <td><?php echo $time ?></td>

                    <td>
                        <a href="reservations.php?source=edit_reservation&rid=<?php echo $reservation_id ?>" class="btn btn-primary">Edit</a>
                        <a href="reservations.php?delete=<?php echo $reservation_id ?>" class="btn btn-danger" class="user_delete">Delete</a>
                        <a href="#" data-toggle="collapse" data-target="#row_<?php echo "{$table_id}" ?>" class="btn btn-warning"><i class="fa-solid fa-eye"></i></a>
                    </td>

                <tr>
                    <td colspan="12" class="col-12">
                        <div id="row_<?php echo $table_id ?>" class="collapse">
                            <div>
                                <h3 class="h5"><strong>Client Details: </strong></h3>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Firstname</th>
                                            <th scope="col">Lastname</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Email</th>
                                        </tr>
                                    </thead>
                                    <tody>
                                        <?php
                                        $query = "SELECT * FROM clients WHERE client_id = $client_id";
                                        $get_all_tables = mysqli_query($conn, $query);
                                        while ($row = mysqli_fetch_assoc($get_all_tables)) {
                                            $firstname = htmlspecialchars($row['firstName']);
                                            $lastname = htmlspecialchars($row['lastName']);
                                            $phone = htmlspecialchars($row['phone']);
                                            $email = htmlspecialchars($row['email']);
                                        ?>
                                            <tr>
                                                <td><?php echo $firstname ?></td>
                                                <td><?php echo $lastname ?></td>
                                                <td><?php echo $phone ?></td>
                                                <td><?php echo $email ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tody>
                                </table>
                            </div>
                            <div>
                                <h3 class="h5"><strong>Table Details: </strong></h3>
                                <table class="table  table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Name</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Capacity</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tody>
                                        <?php
                                        $query = "SELECT * FROM tables WHERE table_id = $table_id";
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
                                                <td><?php echo $status ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tody>
                                </table>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php }
            ?>

            <?php
            if (isset($_GET['delete'])) {
                if (isAdmin()) {
                    $deleted_reservation_id = $_GET['delete'];
                    $query = "DELETE FROM reservations WHERE reservation_id = {$deleted_reservation_id}";
                    $delete_query = mysqli_query($conn, $query);
                    if (confirmQuery($delete_query)) {
                        header("Location: reservations.php?deleteSuccess");
                        exit();
                    }
                }
            }
            ?>

        </tbody>

    </table>
</div>