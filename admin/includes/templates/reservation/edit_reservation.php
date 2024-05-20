<?php
if (isset($_POST['edit_reservation'])) {
    $reservation_id = $_GET['rid'];
    $new_table_id = "";
    $num_guests = $_POST['num_guests'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $message = $_POST['message'];
    $status = $_POST['status'];

    $num_guests = escape($num_guests);
    $date = escape($date);
    $time = escape($time);
    $message = escape($message);
    $status = escape($status);

    // Önceki masayı belirlemek için mevcut rezervasyonu al
    $query = "SELECT table_id FROM reservations WHERE reservation_id = {$reservation_id}";
    $result = mysqli_query($conn, $query);
    confirmQuery($result);

    $old_table_id = "";
    if ($row = mysqli_fetch_assoc($result)) {
        $old_table_id = $row['table_id'];
    }

    if ($_POST['table']) {
        $new_table_id = escape($_POST['table']);
    } else {
        $new_table_id = $old_table_id;
    }

    // Rezervasyonu güncelle
    $query = "UPDATE reservations SET ";
    $query .= "table_id = '{$new_table_id}', ";
    $query .= "num_guests = '{$num_guests}', ";
    $query .= "date = '{$date}', ";
    $query .= "time = '{$time}', ";
    $query .= "message = '{$message}', ";
    $query .= "status = '{$status}' ";
    $query .= "WHERE reservation_id = {$reservation_id}";

    $update_reservation = mysqli_query($conn, $query);
    if (confirmQuery($update_reservation)) {
        header("Location: reservations.php?updateSuccess");
        exit();
    }

    // Below code pieces marked as deprecated because of the reason adding new trigger to the database about updating the reservation.

    // // Önceki masa farklı ise durumu 'empty' olarak güncelle
    // if ($old_table_id !== $new_table_id) {
    //     $table_query = "UPDATE tables SET status = 'empty' WHERE table_id = {$old_table_id}";
    //     $update_old_table_status = mysqli_query($conn, $table_query);
    //     confirmQuery($update_old_table_status);
    // }

    // // Yeni masanın durumunu güncelle
    // if ($status == 'approved' || $status == 'pending') {
    //     $table_status = 'full';
    // } else {
    //     $table_status = 'empty';
    // }

    // $table_query = "UPDATE tables SET status = '{$table_status}' WHERE table_id = {$new_table_id}";
    // $update_table_status = mysqli_query($conn, $table_query);
    // confirmQuery($update_table_status);

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