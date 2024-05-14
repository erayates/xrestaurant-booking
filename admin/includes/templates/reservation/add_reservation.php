<form action="functions.php" method="POST">
    <div class="row container-fluid">
        <div class="col-12 mb-4">
            <label for="client">Select A Client: <span class="text-danger">*</span></label>
            <select name="client" id="client" required>
                <?php
                $query = "SELECT * FROM clients";
                $get_all_clients = mysqli_query($conn, $query);
                confirmQuery($get_all_clients);

                while ($row = mysqli_fetch_assoc($get_all_clients)) {
                    $client_id = htmlspecialchars($row['client_id']);
                    $firstName = htmlspecialchars($row['firstName']);
                    $lastName = htmlspecialchars($row['lastName']);
                ?>
                    <option value="<?php echo $client_id ?>"><?php echo $firstName . " " . $lastName ?></option>
                <?php } ?>
            </select>
        </div>

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
                    <option value="<?php echo $table_id ?>" <?php if ($status === "full") echo "disabled" ?>><?php echo $name ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="col-12 mb-4">
            <label for="num_guests">Pick # of Guests: <span class="text-danger">*</span></label>
            <input type="radio" name="num_guests" value="1" required /> 1
            <input type="radio" name="num_guests" value="2" /> 2
            <input type="radio" name="num_guests" value="3" /> 3
            <input type="radio" name="num_guests" value="4" /> 4
            <input type="radio" name="num_guests" value="5" /> 5
            <input type="radio" name="num_guests" value="6" /> 6
            <input type="radio" name="num_guests" value="7" /> 7
            <input type="radio" name="num_guests" value="8" /> 8
        </div>

        <div class="col-12 mb-4">
            <small class="text-danger">Please don't make inappropriate selections. Before submitting the form, please check the status of the table. Otherwise, your reservation will be rejected.</small>
        </div>

        <div class="col-12 mb-4">
            <label for="date" class="form-label">Pick A Date: <span class="text-danger">*</span></label>
            <input type="date" class="form-control" name="date" id="date" required />
        </div>

        <div class="col-12 mb-4">
            <label for="time" class="form-label">Pick A Time: <span class="text-danger">*</span></label>
            <input type="time" class="form-control" name="time" id="time" min="10:00" required />
        </div>

        <div class="col-12 mb-4">
            <label for="status" class="form-label">Status: <span class="text-danger">*</span></label>
            <select name="status" id="status" required>
                <option value="pending">Pending</option>
                <option value="approved">Approved</option>
                <option value="denied">Denied</option>
            </select>
        </div>

        <div class="col-12 mb-4">
            <label for="message" class="form-label">Enter Your Message: <span class="text-danger">*</span></label>
            <textarea name="message" rows="5" style="resize: none;" class="form-control" id="message" required></textarea>
        </div>

        <div class="col-12">
            <div class="d-grid">
                <button class="btn btn-primary" name="create_reservation" type="submit">Add Reservation</button>
            </div>
        </div>
    </div>
</form>