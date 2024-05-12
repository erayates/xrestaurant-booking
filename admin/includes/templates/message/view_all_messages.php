<?php
if (isset($_GET['deleteSuccess'])) { ?>
    <div class="alert alert-danger col-xs-12" role="alert">
        <strong>SUCCESSFULL!</strong> You have deleted a message successfully.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true" style="color:red;">&times;</span>
        </button>
    </div>
<?php }
?>

<div class="col-xs-12" style="overflow-x: auto;">
    <table class="table ">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Firstname</th>
                <th scope="col">Lastname</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Message</th>
                <th scope="col"></th>
            </tr>
        </thead>

        <tbody>
            <?php
            $query = "SELECT * FROM messages";
            $get_all_tables = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($get_all_tables)) {
                $message_id = htmlspecialchars($row['message_id']);
                $firstName = htmlspecialchars($row['firstName']);
                $lastName = htmlspecialchars($row['lastName']);
                $email = htmlspecialchars($row['email']);
                $phone = htmlspecialchars($row['phone']);
                $message = htmlspecialchars($row['message']);
            ?>


                <tr>
                    <th scope="row"><?php echo $message_id ?></th>
                    <td><?php echo $firstName ?></td>
                    <td><?php echo $lastName ?></td>
                    <td><?php echo $email ?></td>
                    <td><?php echo $phone ?></td>
                    <td><?php echo $message ?></td>
                    <td>
                        <a href="messages.php?delete=<?php echo $message_id ?>" class="btn btn-danger">Delete</a>
                    </td>


                </tr>
            <?php }
            ?>

            <?php
            if (isset($_GET['delete'])) {
                // isAdmin kontrolü tekrar eklenmeli
                $deleted_message_id = $_GET['delete'];
                $query = "DELETE FROM messages WHERE message_id = {$deleted_message_id}";
                $delete_query = mysqli_query($conn, $query);
                if ($delete_query) {
                    header("Location: messages.php?deleteSuccess");
                }
            }

            ?>

        </tbody>

    </table>
</div>