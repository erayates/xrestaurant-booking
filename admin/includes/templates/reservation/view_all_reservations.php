<div class="col-xs-12" style="overflow-x: auto;">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Client ID</th>
                <th scope="col">Table ID</th>
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
            $query = "SELECT * FROM reservations";
            $get_all_reservations = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($get_all_reservations)) {
                $table_id = htmlspecialchars($row['table_id']);
                $client_id = htmlspecialchars($row['client_id']);
                $reservation_id = htmlspecialchars($row['reservation_id']);
                $num_guests =  htmlspecialchars($row['num_guests']);
                $message = htmlspecialchars($row['message']);
                $status = htmlspecialchars($row['status']);
                $date = htmlspecialchars($row['date']);
                $time = htmlspecialchars($row['time']);
            ?>
                <tr>
                    <th scope="row"><?php echo $reservation_id ?></th>
                    <td><?php echo $client_id ?></td>
                    <td><?php echo $table_id ?></td>
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
                    $res_id = $_GET['delete'];

                    $reservation_query = "SELECT table_id FROM reservations WHERE reservation_id = {$res_id}";
                    $reservation_result = mysqli_query($conn, $reservation_query);

                    if ($reservation_result && mysqli_num_rows($reservation_result) > 0) {
                        $reservation = mysqli_fetch_assoc($reservation_result);
                        $table_id = $reservation['table_id'];

                        $query = "DELETE FROM reservations WHERE reservation_id = {$res_id}";
                        $delete_query = mysqli_query($conn, $query);

                        if (confirmQuery($delete_query)) {
                            $table_query = "UPDATE tables SET status = 'empty' WHERE table_id = {$table_id}";
                            $updated_query = mysqli_query($conn, $table_query);

                            if (confirmQuery($updated_query)) {
                                header("Location: reservations.php?deleteSuccess");
                                exit();
                            } else {
                                die("Table status update failed: " . mysqli_error($conn));
                            }
                        } else {
                            die("Reservation deletion failed: " . mysqli_error($conn));
                        }
                    } else {
                        die("Reservation not found: " . mysqli_error($conn));
                    }
                }
            }
            ?>

        </tbody>

    </table>
</div>