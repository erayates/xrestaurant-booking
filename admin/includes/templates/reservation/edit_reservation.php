<?php
if (isset($_POST['edit_reservation'])) {
    $reservation_table = $_POST['table'];
    $reservation_num_guests = $_POST['num_guests'];
    $reservation_date = $_POST['date'];
    $reservation_time = $_POST['time'];
    $reservation_message = $_POST['message'];
    $reservation_status = $_POST['status'];

    $table = escape($reservation_table);
    $num_guests = escape($reservation_num_guests);
    $date = escape($reservation_date);
    $time = escape($reservation_time);
    $message = escape($reservation_message);
    $status = escape($reservation_status);

    $query = "UPDATE reservations SET ";
    $query .= "table_id = '{$table}', ";
    $query .= "num_guests = '{$num_guests}', ";
    $query .= "date = '{$date}', ";
    $query .= "time = '{$time}', ";
    $query .= "message = '{$message}', ";
    $query .= "status = '{$status}' ";
    $query .= "WHERE reservation_id = {$_GET['rid']}";

    $update_reservation = mysqli_query($conn, $query);
    if (!$update_reservation) {
        die("QUERY FAILED: " . mysqli_error($conn));
    }

    if (confirmQuery($update_reservation)) {
        header("Location: reservations.php?updateSuccess");
    }
}

if (isset($_GET['rid'])) {
    $query = "SELECT * FROM reservations WHERE reservation_id = {$_GET['rid']}";
    $get_reservation = mysqli_query($conn, $query);
    confirmQuery($get_reservation);

    while ($row = mysqli_fetch_assoc($get_reservation)) {
        $r_client_id = htmlspecialchars($row['client_id']);
        $r_table_id = htmlspecialchars($row['table_id']);
        $num_guests = htmlspecialchars($row['num_guests']);
        $message = htmlspecialchars($row['message']);
        $status = htmlspecialchars($row['status']);
        $date = htmlspecialchars($row['date']);
        $time = htmlspecialchars($row['time']);
?>
        <form action="" method="POST">
            <div class="row container-fluid">
                <div class="col-12 mb-4">
                    <label for="table">Select A Table: <span class="text-danger">*</span></label>
                    <select name="table" id="table" required>
                        <?php
                        $query = "SELECT * FROM tables";
                        $get_all_tables = mysqli_query($conn, $query);
                        confirmQuery($get_all_tables);

                        while ($row = mysqli_fetch_assoc($get_all_tables)) {
                            $table_id = htmlspecialchars($row['table_id']);
                            $name = htmlspecialchars($row['name']);
                            $status = htmlspecialchars($row['status']);
                        ?>
                            <option value="<?php echo $table_id ?>" <?php if ($status === "full") echo "disabled" ?> <?php if ($table_id === $r_table_id) echo "selected" ?>><?php echo $name ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="col-12 mb-4">
                    <label for="num_guests">Pick # of Guests: <span class="text-danger">*</span></label>
                    <input type="radio" name="num_guests" value="1" <?php if ($num_guests == 1) echo 'checked'; ?> required /> 1
                    <input type="radio" name="num_guests" value="2" <?php if ($num_guests == 2) echo 'checked'; ?> /> 2
                    <input type="radio" name="num_guests" value="3" <?php if ($num_guests == 3) echo 'checked'; ?> /> 3
                    <input type="radio" name="num_guests" value="4" <?php if ($num_guests == 4) echo 'checked'; ?> /> 4
                    <input type="radio" name="num_guests" value="5" <?php if ($num_guests == 5) echo 'checked'; ?> /> 5
                    <input type="radio" name="num_guests" value="6" <?php if ($num_guests == 6) echo 'checked'; ?> /> 6
                    <input type="radio" name="num_guests" value="7" <?php if ($num_guests == 7) echo 'checked'; ?> /> 7
                    <input type="radio" name="num_guests" value="8" <?php if ($num_guests == 8) echo 'checked'; ?> /> 8
                </div>

                <div class="col-12 mb-4">
                    <small class="text-danger">Please don't make inappropriate selections. Before submitting the form, please check the status of the table. Otherwise, your reservation will be rejected.</small>
                </div>

                <div class="col-12 mb-4">
                    <label for="date" class="form-label">Pick A Date: <span class="text-danger">*</span></label>
                    <input type="date" class="form-control" name="date" id="date" value="<?php echo $date ?>" required />
                </div>

                <div class="col-12 mb-4">
                    <label for="time" class="form-label">Pick A Time: <span class="text-danger">*</span></label>
                    <input type="time" class="form-control" name="time" id="time" value="<?php echo $time ?>" min="10:00" required />
                </div>

                <div class="col-12 mb-4">
                    <label for="status" class="form-label">Status: <span class="text-danger">*</span></label>
                    <select name="status" id="status" required>
                        <option value="pending" <?php if ($status === "pending") echo "selected" ?>>Pending</option>
                        <option value="approved" <?php if ($status === "approved") echo "selected" ?>>Approved</option>
                        <option value="denied" <?php if ($status === "denied") echo "selected" ?>>Denied</option>
                    </select>
                </div>

                <div class="col-12 mb-4">
                    <label for="message" class="form-label">Enter Your Message: <span class="text-danger">*</span></label>
                    <textarea name="message" rows="5" style="resize: none;" class="form-control" id="message" required><?php echo $message ?></textarea>
                </div>

                <div class="col-12">
                    <div class="d-grid">
                        <button class="btn btn-primary" name="edit_reservation" type="submit">Edit Reservation</button>
                    </div>
                </div>
            </div>
        </form>
        </div>
<?php }
} else {
    header("Location: reservations.php");
    exit();
}
?>