<?php
if (isset($_POST['edit_table'])) {
    $table_name = $_POST['name'];
    $table_description = $_POST['description'];
    $table_capacity = $_POST['capacity'];
    $table_status = $_POST['status'];

    $name = escape($table_name);
    $description = escape($table_description);
    $capacity = escape($table_capacity);
    $status = escape($table_status);

    $query = "UPDATE tables SET ";
    $query .= "name = '{$name}', ";
    $query .= "description = '{$description}', ";
    $query .= "capacity = '{$capacity}', ";
    $query .= "status = '{$status}' ";
    $query .= "WHERE table_id = {$_GET['tid']}";

    $update_client = mysqli_query($conn, $query);
    if (confirmQuery($update_client)) {
        header("Location: tables.php?updateSuccess");
    }
}
?>

<?php
if (isset($_GET['tid'])) {
    $query = "SELECT * FROM tables WHERE table_id = {$_GET['tid']}";
    $get_client = mysqli_query($conn, $query);
    confirmQuery($get_client);
    while ($row = mysqli_fetch_assoc($get_client)) {
        $table_id = htmlspecialchars($row['table_id']);
        $name = htmlspecialchars($row['name']);
        $description = htmlspecialchars($row['description']);
        $capacity = htmlspecialchars($row['capacity']);
        $status = htmlspecialchars($row['status']);

?>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name: <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name" id="name" value=<?php echo $name ?> required>
            </div>

            <div class="form-group">
                <label for="description">Description: <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="description" id="description" value=<?php echo $description ?> required>
            </div>

            <div class="form-group ">
                <label for="capacity">Capacity: <span class="text-danger">*</span></label>
                <select name="capacity" id="capacity" required>
                    <option value=1 <?php if ($capacity == 1) echo "selected" ?>>1</option>
                    <option value=2 <?php if ($capacity == 2) echo "selected" ?>>2</option>
                    <option value=3 <?php if ($capacity == 3) echo "selected" ?>>3</option>
                    <option value=4 <?php if ($capacity == 4) echo "selected" ?>>4</option>
                    <option value=5 <?php if ($capacity == 5) echo "selected" ?>>5</option>
                    <option value=6 <?php if ($capacity == 6) echo "selected" ?>>6</option>
                    <option value=7 <?php if ($capacity == 7) echo "selected" ?>>7</option>
                    <option value=8 <?php if ($capacity == 8) echo "selected" ?>>8</option>
                </select>
            </div>


            <div class="form-group ">
                <label for="status">Status: <span class="text-danger">*</span></label>
                <select name="status" id="status" required>
                    <option value="empty">Empty</option>
                    <option value="full">Full</option>
                </select>
            </div>



            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="edit_table" value="Edit Table">
            </div>

        </form>

<?php }
}
?>