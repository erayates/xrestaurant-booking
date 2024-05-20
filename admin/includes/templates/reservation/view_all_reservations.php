<div class="col-xs-12" style="overflow-x: auto;">
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
            $query = "SELECT r.reservation_id, 
                 CONCAT(c.firstName, ' ', c.lastName) AS client_name,
                 t.name AS table_name,
                 t.status AS table_status,
                 t.table_id,
                 t.description AS table_description,
                 t.capacity AS table_capacity,
                 c.email AS client_email,
                 c.phone AS client_phone,
                 r.num_guests,
                 r.message,
                 r.status,
                 r.date,
                 r.time
          FROM reservations r
          JOIN clients c ON r.client_id = c.client_id
          JOIN tables t ON r.table_id = t.table_id";

            $get_all_reservations = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($get_all_reservations)) {
                $reservation_id = htmlspecialchars($row['reservation_id']);

                // Client
                $client_name = htmlspecialchars($row['client_name']);
                $client_email = htmlspecialchars($row['client_email']);
                $client_phone = htmlspecialchars($row['client_phone']);

                // Table
                $table_id = htmlspecialchars($row['table_id']);
                $table_status = htmlspecialchars($row['table_status']);
                $table_description = htmlspecialchars($row['table_description']);
                $table_capacity = htmlspecialchars($row['table_capacity']);
                $table_name = htmlspecialchars($row['table_name']);

                $num_guests = htmlspecialchars($row['num_guests']);
                $message = htmlspecialchars($row['message']);
                $status = htmlspecialchars($row['status']);
                $date = htmlspecialchars($row['date']);
                $time = htmlspecialchars($row['time']);
            ?>
                <tr>
                    <th scope="row"><?php echo $reservation_id ?></th>
                    <td><?php echo $client_name ?></td>
                    <td><?php echo $table_name ?></td>
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
                                            <th scope="col">Name</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Email</th>
                                        </tr>
                                    </thead>
                                    <tody>
                                        <tr>
                                            <td><?php echo $client_name ?></td>
                                            <td><?php echo $client_phone ?></td>
                                            <td><?php echo $client_email ?></td>
                                        </tr>
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
                                        <tr>
                                            <td><?php echo $table_name ?></td>
                                            <td><?php echo $table_description ?></td>
                                            <td><?php echo $table_capacity ?></td>
                                            <td><?php echo $table_status ?></td>
                                        </tr>
                                    </tody>
                                </table>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php }
            ?>

            <?php
            // Before added trigger to database. These code pieces doesnt need anymore added a new trigger to the database.

            // if (isset($_GET['delete'])) {
            //     if (isAdmin()) {
            //         $res_id = $_GET['delete'];

            //         $reservation_query = "SELECT table_id FROM reservations WHERE reservation_id = {$res_id}";
            //         $reservation_result = mysqli_query($conn, $reservation_query);

            //         if ($reservation_result && mysqli_num_rows($reservation_result) > 0) {
            //             $reservation = mysqli_fetch_assoc($reservation_result);
            //             $table_id = $reservation['table_id'];

            //             $query = "DELETE FROM reservations WHERE reservation_id = {$res_id}";
            //             $delete_query = mysqli_query($conn, $query);

            //             if (confirmQuery($delete_query)) {
            //                 $table_query = "UPDATE tables SET status = 'empty' WHERE table_id = {$table_id}";
            //                 $updated_query = mysqli_query($conn, $table_query);

            //                 if (confirmQuery($updated_query)) {
            //                     header("Location: reservations.php?deleteSuccess");
            //                     exit();
            //                 } else {
            //                     die("Table status update failed: " . mysqli_error($conn));
            //                 }
            //             } else {
            //                 die("Reservation deletion failed: " . mysqli_error($conn));
            //             }
            //         } else {
            //             die("Reservation not found: " . mysqli_error($conn));
            //         }
            //     }
            // }

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